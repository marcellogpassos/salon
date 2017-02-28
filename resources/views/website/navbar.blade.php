<div class="navbar-fixed">
    <nav class="grey darken-4" role="navigation">
        <div class="nav-wrapper container">

            <a id="logo-container" href="{{ url('/index') }}" class="brand-logo">
                <img src="{{ asset('/img/index/brand-logo.png') }}">
            </a>

            <ul class="right hide-on-med-and-down">
                <li><a href="#sobre">Sobre n&oacute;s</a></li>
                <li><a href="#servicos">Servi&ccedil;os</a></li>
                <li><a href="#equipe">Equipe</a></li>
                <li><a href="#contato">Contato</a></li>
                <li><a href="{{ url('/register') }}" class="call-to-action">Cadastre-se</a></li>
                <li><a href="{{ url('/login') }}">Login</a></li>
            </ul>

            <ul id="nav-mobile" class="side-nav">
                <li><a href="#sobre">Sobre n&oacute;s</a></li>
                <li><a href="#servicos">Servi&ccedil;os</a></li>
                <li><a href="#equipe">Equipe</a></li>
                <li><a href="#contato">Contato</a></li>
                <li><a href="{{ url('/register') }}" class="call-to-action">Cadastre-se</a></li>
                <li><a href="{{ url('/login') }}">Login</a></li>
            </ul>

            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>

        </div>
    </nav>
</div>