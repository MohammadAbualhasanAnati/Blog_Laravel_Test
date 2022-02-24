<html>

<head>
    @include('layouts.general.head')
    @yield('styles')
</head>

<body>
    <div id="wrapper">
        @include('layouts.general.sidebar')

        <div class="container">
            @yield('content')
        </div>
    </div>
</body>

</html>
