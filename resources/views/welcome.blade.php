<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="container">
    <main class="p-4">
        <div>
            @if(!auth()->check())
                <div class="row justify-content-center align-content-center">
                    <form method="post" action="{{route('login-button')}}">
                        @csrf
                        <b-button type="submit" variant="primary">Login</b-button>
                    </form>
                </div>
            @elseauth
                <github-token-form></github-token-form>
                <git-hub-stars></git-hub-stars>
            @endauth
        </div>
    </main>
</div>
</body>
</html>
