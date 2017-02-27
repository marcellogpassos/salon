<!DOCTYPE html>

<html lang="pt-Br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>

    <title>Barbearia Club Man</title>

    @include('partials.favicon')

    <meta name="Description"
          content="A Barbearia Club Man, a barbearia do homem moderno, &eacute; localizada no bairro de Mangabeira. Oferece servi&ccedil;os de barba e cabelo, est&eacute;tica masculina, jogos de sinuca, xadrez, damas e fliperama e camisetas, cervejas artesanais e outros produtos &uacute;teis.">
    <meta name="Keywords"
          content="barbearia, homem, moderno, mangabeira, jo&atilde;o pessoa, jogos, sinuca, cerveja, camisetas">

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
                <a href="{{ url('/agendamentos') }}" class="btn-large waves-effect waves-light call-to-action">Agende um
                    hor&aacute;rio</a>
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
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-92641563-1', 'auto');
    ga('send', 'pageview');

</script>

</body>
</html>
