<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="{{ url('/home') }}" class="brand-logo">{{ env('APP_NAME') }}</a>
        <ul class="right hide-on-med-and-down">
            @if (Auth::guest())
                <li><a href="{{ url('/home') }}">Home</a></li>
                <li><a href="{{ url('/login') }}">Entrar</a></li>
                <li><a href="{{ url('/register') }}">Cadastre-se</a></li>
            @else
                <li><a href="{{ url('/users/buscar') }}">Usu&aacute;rios</a></li>

                <li>
                    <a class="dropdown-button" href="#!" data-beloworigin="true" data-activates="agendaMenuDropdown">
                        Agendamentos <i class="material-icons right">arrow_drop_down</i>
                    </a>

                    <ul id="agendaMenuDropdown" class="dropdown-content">
                        <li><a href="">Agendar horário</a></li>
                        <li><a href="">Meus agendamentos</a></li>
                        <li><a href="">Minha agenda</a></li>
                    </ul>
                </li>

                <li>
                    <a class="dropdown-button" href="#!" data-beloworigin="true" data-activates="adminMenuDropdown">
                        Administra&ccedil;&atilde;o <i class="material-icons right">arrow_drop_down</i>
                    </a>

                    <ul id="adminMenuDropdown" class="dropdown-content">
                        <li><a href="">Categorias de Produtos</a></li>
                        <li><a href="{{ url('marcas/listar') }}">Marcas de Produtos</a></li>
                        <li><a href="">Produtos</a></li>
                        <li><a href="">Categorias de Serviços</a></li>
                        <li><a href="">Serviços</a></li>
                    </ul>
                </li>

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
            @if (Auth::guest())
                <li><a href="{{ url('/home') }}">Home</a></li>
                <li><a href="{{ url('/login') }}">Entrar</a></li>
                <li><a href="{{ url('/register') }}">Cadastre-se</a></li>
            @else
                <li><a href="{{ url('/users/buscar') }}">Usu&aacute;rios</a></li>

                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li>
                            <a class="collapsible-header waves-effect waves-teal">
                                Agendamentos <i class="material-icons left">arrow_drop_down</i>
                            </a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="">Agendar horário</a></li>
                                    <li><a href="">Meus agendamentos</a></li>
                                    <li><a href="">Minha agenda</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>

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

                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li>
                            <a class="collapsible-header waves-effect waves-teal">
                                Administra&ccedil;&atilde;o <i class="material-icons left">arrow_drop_down</i>
                            </a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="">Categorias de Produtos</a></li>
                                    <li><a href="{{ url('marcas/listar') }}">Marcas de Produtos</a></li>
                                    <li><a href="">Produtos</a></li>
                                    <li><a href="">Categorias de Serviços</a></li>
                                    <li><a href="">Serviços</a></li>
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