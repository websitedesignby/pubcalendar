<!DOCTYPE html>
<html lang="en">
    @include('common.head')
    <body>
        @include('common.menu')
        
        <div class="container">
        
        <!-- Display Validation Errors -->
        @include('common.errors')
        
        @yield('content')
        </div>
        @include('common.footer')
    </body>
</html>