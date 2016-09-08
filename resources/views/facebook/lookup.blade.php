@extends('layouts.app')

@section('content')

<p>Enter the URL of a Facebook page:</p>
<form name="lookup" action="/fb/lookup">
     <div class="form-group">
        <label for="url">URL</label>
        <input type="text" class="form-control" name="url" value="{{ $url or '' }}" />
     </div>
     <div class="form-group">
        <button type="submit">Lookup</button>
     </div>
</form>

@if( $result_body !== '' )

<div id="result">
    
    <strong>Lookup Results:</strong>
    
    {{ dump( $result_body ) }}
    
    <form name="save_result" class="form-horizontal" action="/fb/lookup/save" method="post">
         {{ csrf_field() }}
         <div class="form-group">
            <label for="fb_id" class="col-sm-2 control-label">fb_id</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="fb_id" value="{{ $result_body->id }}" />
            </div>
         </div>
         <div class="form-group">
            <label for="name" class="col-sm-2 control-label">name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{ $result_body->name }}" />
            </div>
         </div>
         <div class="form-group">
            <label for="name" class="col-sm-2 control-label">picture</label>
            <div class="col-sm-10">
                <a href="https://graph.facebook.com/v2.7/{{ $result_body->id }}/picture/?type=large" target="_blank">https://graph.facebook.com/v2.7/133148053374223/picture/?type=large</a>
                <input type="text" class="form-control" name="image" value="https://graph.facebook.com/v2.7/{{ $result_body->id }}/picture/?type=large" />
            </div>
         </div>
         <div class="form-group">
             <label for="street" class="col-sm-2 control-label">street</label>
             <div class="col-sm-10">
                  <input type="text" class="form-control" name="street" value="{{ $result_body->location->street }}" />
             </div>
         </div>
         <div class="form-group">
             <label for="city" class="col-sm-2 control-label">city</label>
             <div class="col-sm-10">
                  <input type="text" class="form-control" name="city" value="{{ $result_body->location->city }}" />
             </div>
         </div>
         <div class="form-group">
             <label for="state" class="col-sm-2 control-label">state</label>
             <div class="col-sm-10">
                  <input type="text" class="form-control" name="state" value="{{ $result_body->location->state }}" />
             </div>
         </div>
         <div class="form-group">
             <label for="zip" class="col-sm-2 control-label">zip</label>
             <div class="col-sm-10">
                  <input type="text" class="form-control" name="zip" value="{{ $result_body->location->zip }}" />
             </div>
         </div>
          <div class="form-group">
             <label for="country" class="col-sm-2 control-label">country</label>
             <div class="col-sm-10">
                  <input type="text" class="form-control" name="country" value="{{ $result_body->location->country }}" />
             </div>
         </div>
         <div class="form-group">
             <label for="phone" class="col-sm-2 control-label">phone</label>
             <div class="col-sm-10">
                  <input type="text" class="form-control" name="phone" value="{{ $result_body->phone }}" />
             </div>
         </div>
          <div class="form-group">
             <label for="latitude" class="col-sm-2 control-label">latitude</label>
             <div class="col-sm-10">
                  <input type="text" class="form-control" name="latitude" value="{{ $result_body->location->latitude }}" />
             </div>
         </div>
          <div class="form-group">
             <label for="longitude" class="col-sm-2 control-label">longitude</label>
             <div class="col-sm-10">
                  <input type="text" class="form-control" name="longitude" value="{{ $result_body->location->longitude }}" />
             </div>
         </div>
         <div class="form-group">
              <label for="website" class="col-sm-2 control-label">website</label>
             <div class="col-sm-10">
                  <input type="text" class="form-control" name="website" value="{{ $result_body->website }}" />
             </div>
         </div>
         <div class="form-group">
              <label for="email" class="col-sm-2 control-label">emails</label>
             <div class="col-sm-10">
                  <input type="text" class="form-control" name="email" value="@if(!empty($result_body->emails)){{implode(", ",$result_body->emails)}}@endif" />
             </div>
         </div>
         <div class="form-group">
              <label for="fb_url" class="col-sm-2 control-label">fb_url</label>
             <div class="col-sm-10">
                  <input type="text" class="form-control" name="fb_url" value="{{ $result_body->link }}" />
             </div>
         </div>
         <div class="form-group">
             <div class="col-sm-10 col-sm-offset-2">
                <button type="submit" class="btn btn-primary">Save Result</button>
             </div>
         </div>
    </form>
</div>

@endif


@endsection