<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script>
        window.App = {!! json_encode([
            'user' => Auth::user(),
            'signedIn' => Auth::check(),
            'csrfToken' => csrf_token()
        ]) !!};
    </script>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('layouts.nav')

        <main class="py-4">
            @yield('content')
        </main>

        <div class="d-flex flex-column justify-content-end align-items-end position-fixed fixed-bottom">
            <flash :data="{{ json_encode(session('flash')) }}"></flash>
        </div>

        @if(count($errors))
            <div class="d-flex flex-column justify-content-end align-items-end position-fixed fixed-bottom">
                @foreach($errors->all() as $error)
                    <flash :data="{{ json_encode(['message' => $error, 'type' => 'danger']) }}"></flash>
                @endforeach
            </div>
        @endif
    </div>

    @yield('scripts')
</body>
</html>
