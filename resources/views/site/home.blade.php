@extends('layouts.app')

@section('content')

<!-- boostrap boilerplate -->

<div class="panel-body">
    <!-- display validation errors -->
    @include('common.errors')
</div>

<!-- home page stuff -->

<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">Work With Facebook Module</h3></div>
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item">
                <a href="/fb/login">Facebook Login</a>
            </li>
            <li class="list-group-item">
                <a href="/fb/lookup">Facebook Lookup</a>
            </li>
        </ul>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">Facebook Reference</h3></div>
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item"><a href="https://developers.facebook.com/docs/graph-api/reference/page" target="_blank">Graph API Page Reference</a></li>
            
        </ul>
    </div>
</div>

<p>
    Laravel version = <?php echo $app_version; ?>
</p>

@endsection
