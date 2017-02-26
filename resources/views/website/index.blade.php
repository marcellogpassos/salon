<!DOCTYPE html>

<html lang="pt-Br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>

    <title>MAKP</title>

    <script src="https://use.fontawesome.com/146bb4f1dc.js"></script>

    <!-- CSS  -->
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    <link href="{{ asset('lib/materialize/css/materialize.min.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection"/>
    <link href="{{ asset('css/index.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body>

@include('website.navbar')

<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
        <div class="container">
        </div>
    </div>
    <div class="parallax"><img src="{{ asset('img/index/09.jpg') }}" alt="Unsplashed background img 1">
    </div>
</div>

@include('website.sobre')

<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 light sf sf-two grey-text text-lighten-5">
                    "Being a barber is about taking care of the people." - Anthony Hamilton
                </h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="{{ asset('img/index/07.jpg') }}" alt="Unsplashed background img 2">
    </div>
</div>

@include('website.servicos')

@include('website.inscreva')

<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <a href="{{ url('/agendamentos') }}" class="btn-large waves-effect waves-light call-to-action">Agende um hor&aacute;rio</a>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="{{ asset('img/index/11.png') }}" alt="Unsplashed background img 3">
    </div>
</div>

@include('website.equipe')

@include('website.contato')

@include('website.footer')

@include('website.modal-servicos')

        <!--  Scripts-->
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="{{ asset('lib/materialize/js/materialize.min.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>

</body>
</html>
