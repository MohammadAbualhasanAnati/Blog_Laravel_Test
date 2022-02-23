<html>
    <head>
        @include('admin.layout.head')
    </head>
    <body>
        @include('admin.layout.sidebar')
 
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>