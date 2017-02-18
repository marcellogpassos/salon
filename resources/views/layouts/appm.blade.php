<!DOCTYPE html>
<html lang="pt-BR" ng-app="blank">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

    @include('partials.favicon')

    <title>{{ env('NOME_ESTABELECIMENTO') }} :: @yield('title')</title>

    <!-- Fonts  -->
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <script src="//use.fontawesome.com/46b5b5e60e.js"></script>

    <!-- Styles  -->
    <link href="{{ asset('lib/materialize/css/materialize.min.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection"/>
    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('css/alert.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>

    <link href="{{ asset('lib/pickadate/compressed/themes/default.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection"/>
    <link href="{{ asset('lib/pickadate/compressed/themes/default.time.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection"/>

    @yield('styles')

            <!--  Scripts-->
    <script src='//www.google.com/recaptcha/api.js'></script>

</head>

<body>

@include('layouts.navbar')

<main>
    @yield('content')
</main>

@include('layouts.footer')

        <!-- JQuery -->
<script src="//code.jquery.com/jquery-2.1.4.min.js"
        integrity="sha256-8WqyJLuWKRBVhxXIL1jBDD7SDxU936oZkCnxQbWwJVw=" crossorigin="anonymous"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{ asset('lib/materialize/js/materialize.min.js') }}"></script>
<script src="{{ asset('lib/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('lib/pickadate/compressed/picker.js') }}"></script>
<script src="{{ asset('lib/pickadate/compressed/picker.time.js') }}"></script>
<script src="{{ asset('lib/pickadate/compressed/translations/pt_BR.js') }}"></script>

<script src="{{ asset('js/messages.js') }}"></script>
<script src="{{ asset('js/util.js') }}"></script>
<script src="{{ asset('js/alert.js') }}"></script>

<script src="{{ asset('js/init.js') }}"></script>

@yield('scripts')

</body>
</html>
