@extends('layouts.app')

@section('content')

<h1>Locations</h1>

@if(count($locations) > 0)

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Name</td>
            <td>Street</td>
            <td>City</td>
            <td>State</td>
            <td>Zip</td>
            <td>Country</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Website</td>
            <td>Facebook Url</td>
            <td>Longitude</td>
            <td>Latitude</td>
            <td>Image</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>   
        @foreach($locations as $row)
        <tr>
            <td>{{$row->name}}</td>
            <td>{{$row->street}}</td>
            <td>{{$row->city}}</td>
            <td>{{$row->state}}</td>
            <td>{{$row->zip}}</td>
            <td>{{$row->country}}</td>
            <td>{{$row->email}}</td>
            <td>{{$row->phone}}</td>
            <td>@if( $row->website <> '')<a href="{{$row->website}}" target="_blank">{{$row->website}}</a>@endif</td>
            <td>@if( $row->fb_url <> '')<a href="{{$row->fb_url}}" target="_blank">{{$row->fb_url}}</a>@endif</td>
            <td>{{$row->longitude}}</td>
            <td>{{$row->latitude}}</td>
            <td>@if( $row->image <> '' )<img src="{{asset($row->image)}}" />@endif</td>
            <td><a href="/locations/delete/{{$row->id}}" class="btn btn-danger">Delete</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

    {!! $locations->render() !!}

@endif


<a href="/fb/lookup" class="btn btn-default">Facebook Lookup</a>

@endsection