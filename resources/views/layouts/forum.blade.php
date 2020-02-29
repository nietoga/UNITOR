<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title','Home Page')</title>
    <!-- Styles - Bootstrap is loaded locally -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/customStyle.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home.index') }}">
                    {{ config('app.name') }}
                </a>
                <a class="navbar-brand" href="{{ route('post.list') }}">
                    Posts
                </a>
                <a class="navbar-brand" href="{{ route('post.create' ) }}">
                    New Post
                </a>
                <button class="navbar-toggler" type="button" data- toggle="collapse" data-target="#navbarSupportedContent" aria- controls="navbarSupportedContent" aria-expanded="false" aria- label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" i d="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <!-- Future Left Side Links -->
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Future authentication Links -->
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<!-- Scripts -->

</html>