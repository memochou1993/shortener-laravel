<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('includes.head')
    </head>
    
    <body class="pushable">
        <div id="app" class="pusher">
            @yield('content')
        </div>
    </body>
    
    @include('includes.scripts')
</html>