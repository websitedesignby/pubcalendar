<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Location;

class LocationController extends Controller
{
    
    public function index(){
        return $this->listLocations();
    }
    
    private function listLocations(){
     
        $per_page = env('DEFAULT_PER_PAGE');
        $items = Location::paginate($per_page);
        return view('location.list', [
            'locations' => $items
        ]);
        
    }
    
    public function delete(Location $location){
        $location->delete();
        return redirect()->route('locations');
    }
    
}
