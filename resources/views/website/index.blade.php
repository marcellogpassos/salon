<!DOCTYPE html>

<html lang="pt-Br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>MAKP</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <link href="{{ asset('css/materialize/materialize.min.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection"/>
    <link href="{{ asset('css/index.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body>

@include('website.navbar')

<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
        <div class="container">
            <br><br>
            <h1 class="header center teal-text text-lighten-2">Parallax Template</h1>
            <div class="row center">
                <h5 class="header col s12 light">A modern responsive front-end framework based on Material
                    Design</h5>
            </div>
            <div class="row center">
                <a href="http://materializecss.com/getting-started.html" id="download-button"
                   class="btn-large waves-effect waves-light teal lighten-1">Get Started</a>
            </div>
            <br><br>

        </div>
    </div>
    <div class="parallax"><img src="{{ asset('img/index/background1.jpg') }}" alt="Unsplashed background img 1">
    </div>
</div>

@include('website.sobre')

<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 light">A modern responsive front-end framework based on Material
                    Design</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="{{ asset('img/index/background2.jpg') }}" alt="Unsplashed background img 2">
    </div>
</div>

@include('website.servicos')

<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 light">A modern responsive front-end framework based on Material
                    Design</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="{{ asset('img/index/background3.jpg') }}" alt="Unsplashed background img 3">
    </div>
</div>

@include('website.footer')

        <!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="{{ asset('js/materialize/materialize.min.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>

</body>
</html>
