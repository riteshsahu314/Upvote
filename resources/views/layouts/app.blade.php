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
        window.App = @json([
            'user' => Auth::user(),
            'signedIn' => Auth::check(),
            'csrfToken' => csrf_token()
        ]);
    </script>

{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
{{--    ToDo: uncomment --}}
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('layouts.nav')

        <div>
            @yield('content')
        </div>

        @include('partials.flash-messages')
    </div>

    @include('partials.search-model')

    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')

    <script>
        $('#searchBox').on('shown.bs.modal', function () {
            $('#searchInput').trigger('focus')
        })
    </script>
</body>
</html>
