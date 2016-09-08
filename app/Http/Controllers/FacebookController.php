<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Facebook;

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class FacebookController extends Controller
{
    
    
    public function login(){
     
        if( ! session_id() ){
            session_start();
        }
        
        $fb = new Facebook\Facebook([
            'app_id' => env('FB_APP_ID'),
            'app_secret' => env('FB_APP_SECRET'),
            'default_graph_version' => 'v2.2',
            'persistent_data_handler'=>'session'
        ]);
        
        $helper = $fb->getRedirectLoginHelper();
        
        $permissions = ['email', 'user_friends', 'public_profile', 'user_location']; // optional
        $loginUrl = $helper->getLoginUrl('http://local.pubcalendar.com/fb/login-callback', $permissions);

        return view('facebook.login',  [
            'loginUrl' => $loginUrl
                
        ]);
        
    }
    
    
    public function loginCallback(Request $request){
     
        if( ! session_id() ){
            session_start();
        }
        
         $fb = new Facebook\Facebook([
            'app_id' => env('FB_APP_ID'),
            'app_secret' => env('FB_APP_SECRET'),
            'default_graph_version' => 'v2.7',
             'persistent_data_handler'=>'session'
        ]);
         
        $helper = $fb->getRedirectLoginHelper();
        
        try {
            $accessToken = $helper->getAccessToken();
          } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }

          if (isset($accessToken)) {
            // Logged in!
            // $_SESSION['facebook_access_token'] = (string) $accessToken;

            $request->session()->put('facebook_access_token', (string) $accessToken);
              
            // Now you can redirect to another page and use the
            // access token from $_SESSION['facebook_access_token']
            
            return view('facebook.login-success');
            
          }
        
    }
    
    // inspect an id
    public function inspect(Request $request, $id){
     
        $fb = new Facebook\Facebook([
            'app_id' => env('FB_APP_ID'),
            'app_secret' => env('FB_APP_SECRET'),
            'default_graph_version' => 'v2.2',
        ]);
        
        
        $accessToken = $request->session()->get('facebook_access_token');
        
        try {
            // Returns a `Facebook\FacebookResponse` object
            // $response = $fb->get('/me?fields=id,name', '{access-token}');
            $response = $fb->get('/' . $id, $accessToken);
            /*
            echo "<pre>";
            print_r($response);
            echo "</pre>";
             * 
             */
            $body_json = $response->getBody();
            echo "<pre>";
            print_r($body_json);
            echo "</pre>";
            $body = json_decode($body_json);
            echo $body->id;
          } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error 2: ' . $e->getMessage();
            exit;
          }

        
    }
    
    
    public function lookup(Request $request){
     
        $body = $url = "";
        
        if( ! empty($request->input('url')) ){
            
            $url = $request->input('url');
            
            
            // remove '/' from end of URL
            $last_char = substr($url, -1);
            if( $last_char == "/" ){
                $url = substr($url, 0, -1);
            }
            
            if( stristr($url, "/") ){
                $url_array = explode("/", $url);
                $id = array_pop( $url_array );
            }else{
                $id = $url;
            }
            
            $fb = new Facebook\Facebook([
                'app_id' => env('FB_APP_ID'),
                'app_secret' => env('FB_APP_SECRET')
            ]);
            
            $accessToken = $request->session()->get('facebook_access_token');
            
            /* 
             * FB Request Object to send to graph... 
             * Page Fields Reference: https://developers.facebook.com/docs/graph-api/reference/page
             * */
            $params = array(
                'fields' => 'name,picture,name_with_location_descriptor,location,phone,place_type,about,cover,current_location,description,emails,fan_count,hours,general_info,link,parking,restaurant_services,restaurant_specialties,events,website'
            );
            $request = $fb->request('GET', '/' . $id, $params );
             
            if( ! empty($accessToken) ){
                $request->setAccessToken($accessToken);
                try {
                    
                    $response = $fb->getClient()->sendRequest($request);
                    $body_json = $response->getBody();
                    $body = json_decode($body_json);
                    
                } catch(Facebook\Exceptions\FacebookResponseException $e) {
                    echo 'Graph returned an error: ' . $e->getMessage();
                    exit;
                }
            }else{
                return redirect()->route('fb-login');
            }
        }
        
        return view('facebook.lookup', [
            'result_body' => $body,
            'url' => $url
        ]);

    }
    
    
    public function lookupSave( Request $request ){
     
        $input = $request->all();
        
        // handle image
        if( ! empty( $input['image'] ) ){
            $path = $input['image'];
            // $filename = basename($path);
            if( ! empty($input['name']) ){ 
                $filename = str_slug($input['name']);
            }else{
                $filename = 'not-provided';
            }
            
            $filename .= "_" . time();
            $filename .= ".jpg";
            
            $permissions = 0755;
            
            $base = 'images';
            $base_path = public_path( $base );
            if( !file_exists($base_path) ){
                // create base path
                mkdir($base_path, $permissions);
            }
            $folder = 'location';
            $folder_path = $base_path . DIRECTORY_SEPARATOR . $folder;
            if( ! file_exists($folder_path) ){
                // create folder path
                mkdir($folder_path, $permissions);
            }
            $year = date('Y');
            $year_path = $folder_path . DIRECTORY_SEPARATOR . $year;
            if( ! file_exists($year_path) ){
                // create year path
                mkdir($year_path, $permissions);
            }
            $month = date('m');
            $month_path = $year_path . DIRECTORY_SEPARATOR . $month;
            if( ! file_exists( $month_path ) ){
                // create month path
                mkdir($month_path, $permissions);
            }
            $filepath = $month_path . DIRECTORY_SEPARATOR . $filename;
            $input['image'] = $base . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $month . DIRECTORY_SEPARATOR . $filename;
            Image::make($path)->save($filepath);
        }
        
        $id = \App\Location::create($input)->id;
        
        return redirect()->route('locations');
        
    }
    
    
}
