<!DOCTYPE html>
<html lang="pt-BR" ng-app="blank">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

    <title>{{ env('NOME_ESTABELECIMENTO') }} :: @yield('title')</title>

    <!-- Fonts  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <script src="https://use.fontawesome.com/46b5b5e60e.js"></script>

    <!-- Styles  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('css/alert.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>

    <link href="{{ asset('lib/pickadate/compressed/themes/default.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection"/>
    <link href="{{ asset('lib/pickadate/compressed/themes/default.time.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection"/>

    <link href="{{ asset('lib/jquery-timepicker-wvega/jquery.timepicker.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection"/>

    @yield('styles')

    <!--  Scripts-->
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body>

@include('layouts.navbar')

<main>
    @yield('content')
</main>

@include('layouts.footer')

<script src="https://code.jquery.com/jquery-2.1.4.min.js"
        integrity="sha256-8WqyJLuWKRBVhxXIL1jBDD7SDxU936oZkCnxQbWwJVw=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
<script src="{{ asset('lib/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>

<script src="{{ asset('lib/pickadate/compressed/picker.js') }}"></script>
<script src="{{ asset('lib/pickadate/compressed/picker.time.js') }}"></script>
<script src="{{ asset('lib/pickadate/compressed/translations/pt_BR.js') }}"></script>

<script src="{{ asset('lib/jquery-timepicker-wvega/jquery.timepicker.js') }}"></script>

<script src="{{ asset('js/messages.js') }}"></script>
<script src="{{ asset('js/util.js') }}"></script>
<script src="{{ asset('js/alert.js') }}"></script>

<script src="{{ asset('js/init.js') }}"></script>

@yield('scripts')

</body>
</html>
