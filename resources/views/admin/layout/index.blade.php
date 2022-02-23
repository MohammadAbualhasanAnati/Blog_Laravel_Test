<html>

<head>
    @include('admin.layout.head')
</head>

<body>
    <div id="wrapper">
        @include('admin.layout.sidebar')

        <div class="container">
            @yield('content')
        </div>
    </div>
</body>

</html>
