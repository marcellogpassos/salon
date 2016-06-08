<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

    <title>Blank Project</title>

    <!-- Fonts  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <!-- Styles  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body>

<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Blank Project</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="{{ url('/home') }}">Home</a></li>
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Entrar</a></li>
                <li><a href="{{ url('/register') }}">Cadastre-se</a></li>
            @else
                <li>
                    <a class="dropdown-button" href="#!" data-beloworigin="true" data-activates="userMenuDropdown">
                        {{ Auth::user()->name }} <i class="material-icons right">arrow_drop_down</i>
                    </a>

                    <ul id="userMenuDropdown" class="dropdown-content">
                        <li><a href="{{ url('/logout') }}">Sair</a></li>
                    </ul>
                </li>
            @endif
        </ul>

        <ul id="nav-mobile" class="side-nav">
            <li><a href="{{ url('/home') }}">Home</a></li>
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Entrar</a></li>
                <li><a href="{{ url('/register') }}">Cadastre-se</a></li>
            @else
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li>
                            <a class="collapsible-header waves-effect waves-teal">
                                {{ Auth::user()->name }} <i class="material-icons left">arrow_drop_down</i>
                            </a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ url('/logout') }}">Sair</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>

        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>

    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="page-footer orange">
    <div class="container">
        <div class="row">

        </div>
    </div>
    <div class="footer-copyright">
        <div class="container center">
            © Copyright 2016-2016 <a class="orange-text text-lighten-3" href="#!">Marcello Galdino Passos</a>
        </div>
    </div>
</footer>


<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"
        integrity="sha256-8WqyJLuWKRBVhxXIL1jBDD7SDxU936oZkCnxQbWwJVw=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
<script src="{{ asset('js/init.js') }}"></script>

</body>
</html>
