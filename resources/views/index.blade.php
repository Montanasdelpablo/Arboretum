<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://unpkg.com/vuetify/dist/vuetify.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/map-icons@3.0.3/dist/css/map-icons.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

        <meta name="theme-color" content="#1976d2">
        <meta name="msapplication-navbutton-color" content="#1976d2">
        <meta name="apple-mobile-web-app-status-bar-style" content="#1976d2">
        <link rel="manifest" href="/manifest.json">

        <title>Laravel</title>
    </head>

    <body>
        <div id="app"></div>

        <script>
			var google_api = '{{ config( 'app.GOOGLE_API' ) }}';
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ config( 'app.GOOGLE_API' ) }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/map-icons@3.0.3/dist/js/map-icons.min.js"></script>
        <script src="{{ asset( '/js/main.js' ) }}"></script>
        {{--<script src="/service-worker.js"></script>--}}
    </body>
</html>