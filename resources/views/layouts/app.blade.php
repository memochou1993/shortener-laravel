<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('includes.head')
    </head>
    
    <body>
        <div id="app">
            @yield('content')
        </div>
    </body>
    
    @include('includes.scripts')
</html>