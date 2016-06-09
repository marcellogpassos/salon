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
                        <li><a href="{{ url('/users/dados') }}">Meus dados</a></li>
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
                                    <li><a href="{{ url('/users/dados') }}">Meus dados</a></li>
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