<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App Name -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Vuetify styles -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Stylesheets -->
    @yield('styles')
</head>
<body>

    <v-app id="app">
        <!-- Main Navigation -->
        @include('_includes.nav.toolbar')

        <!-- Content -->
        <v-container fluid>
            @yield('content')
        </v-container>
    </v-app>

    <!-- Default Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Scripts From Blade -->
    @yield('scripts')

</body>
</html>
