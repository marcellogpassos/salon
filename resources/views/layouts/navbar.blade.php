<div class="navbar-fixed">
    <nav class="grey darken-4" role="navigation">
        <div class="nav-wrapper container">

            <a id="logo-container" href="{{ url('/') }}" class="brand-logo">
                <img src="{{ asset('/img/index/brand-logo.png') }}">
            </a>

            <ul class="right hide-on-med-and-down">
                @if (Auth::guest())
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><a href="{{ url('/login') }}">Entrar</a></li>
                    <li><a href="{{ url('/register') }}">Cadastre-se</a></li>
                @else
                    @if(count(Auth::user()->roles))
                        <li>
                            <a class="dropdown-button" href="#!" data-beloworigin="true"
                               data-activates="usuariosMenuDropdown">
                                Clientes <i class="material-icons right">arrow_drop_down</i>
                            </a>
                            <ul id="usuariosMenuDropdown" class="dropdown-content">
                                <li><a href="{{ url('/users/buscar') }}">Buscar Clientes / Usu&aacute;rios</a></li>

                                @if(Auth::user()->possuiRole(\App\Role::CAIXA) || Auth::user()->admin())
                                    <li><a href="{{ url('/users/cadastrar') }}">Cadastrar Cliente</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->possuiRole(\App\Role::CAIXA) || Auth::user()->admin())
                        <li>
                            <a class="dropdown-button" href="#!" data-beloworigin="true"
                               data-activates="comprasMenuDropdown">
                                Compras <i class="material-icons right">arrow_drop_down</i>
                            </a>

                            <ul id="comprasMenuDropdown" class="dropdown-content">
                                <li><a href="{{ url('/compras/registrar') }}">Registrar compra</a></li>
                                <li><a href="{{ url('/compras/buscar') }}">Relat&oacute;rio de compras</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(count(Auth::user()->roles))
                        <li>
                            <a class="dropdown-button" href="#!" data-beloworigin="true"
                               data-activates="adminMenuDropdown">
                                Administra&ccedil;&atilde;o <i class="material-icons right">arrow_drop_down</i>
                            </a>

                            <ul id="adminMenuDropdown" class="dropdown-content">
                                <li><a href="{{ url('/marcas') }}">Marcas de Produtos</a></li>
                                <li><a href="{{ url('/produtos/buscar') }}">Produtos</a></li>
                                <li><a href="{{ url('servicos/buscar') }}">Serviços</a></li>

                                @if(Auth::user()->admin())
                                    <li><a href="{{ url('estatisticas') }}">Estat&iacute;sticas</a></li>
                                @endif

                            </ul>
                        </li>
                    @endif

                    @if(count(Auth::user()->roles))
                        <li>
                            <a class="dropdown-button" href="#!" data-beloworigin="true"
                               data-activates="agendaMenuDropdown">
                                Agendamentos <i class="material-icons right">arrow_drop_down</i>
                            </a>

                            <ul id="agendaMenuDropdown" class="dropdown-content">
                                <li><a href="{{ url('/agendamentos') }}">Agendar horário</a></li>
                                <li><a href="{{ url('/agenda') }}">Minha agenda</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ url('/agendamentos') }}">Agendamentos</a></li>
                    @endif

                    <li>
                        <a class="dropdown-button" href="#!" data-beloworigin="true" data-activates="userMenuDropdown">
                            {{ Auth::user()->name }} <i class="material-icons right">arrow_drop_down</i>
                        </a>

                        <ul id="userMenuDropdown" class="dropdown-content">
                            <li><a href="{{ url('/users/dados') }}">Meus dados</a></li>
                            <li><a href="{{ url('/users/excluirConta') }}">Excluir Conta</a></li>
                            <li><a href="{{ url('/users/alterarSenha') }}">Alterar Senha</a></li>
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
                    <li><a href="{{ url('/') }}">Home</a></li>

                    @if(count(Auth::user()->roles))
                        <li class="no-padding">
                            <ul class="collapsible collapsible-accordion">
                                <li>
                                    <a class="collapsible-header waves-effect waves-teal">
                                        Clientes <i class="material-icons left">arrow_drop_down</i>
                                    </a>
                                    <div class="collapsible-body">
                                        <ul>
                                            <li><a href="{{ url('/users/buscar') }}">Buscar Clientes / Usu&aacute;rios</a>
                                            </li>

                                            @if(Auth::user()->possuiRole(\App\Role::CAIXA) || Auth::user()->admin())
                                                <li><a href="{{ url('/users/cadastrar') }}">Cadastrar Cliente</a></li>
                                            @endif

                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->possuiRole(\App\Role::CAIXA) || Auth::user()->admin())
                        <li class="no-padding">
                            <ul class="collapsible collapsible-accordion">
                                <li>
                                    <a class="collapsible-header waves-effect waves-teal">
                                        Compras <i class="material-icons left">arrow_drop_down</i>
                                    </a>
                                    <div class="collapsible-body">
                                        <ul>
                                            <li><a href="{{ url('/compras/registrar') }}">Registrar compra</a></li>
                                            <li><a href="{{ url('/compras/buscar') }}">Relat&oacute;rio de compras</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(count(Auth::user()->roles))
                        <li class="no-padding">
                            <ul class="collapsible collapsible-accordion">
                                <li>
                                    <a class="collapsible-header waves-effect waves-teal">
                                        Administra&ccedil;&atilde;o <i class="material-icons left">arrow_drop_down</i>
                                    </a>
                                    <div class="collapsible-body">
                                        <ul>
                                            <li><a href="{{ url('/marcas') }}">Marcas de Produtos</a></li>
                                            <li><a href="{{ url('/produtos/buscar') }}">Produtos</a></li>
                                            <li><a href="{{ url('servicos/buscar') }}">Serviços</a></li>

                                            @if(Auth::user()->admin())
                                                <li><a href="{{ url('estatisticas') }}">Estat&iacute;sticas</a></li>
                                            @endif

                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(count(Auth::user()->roles))
                        <li class="no-padding">
                            <ul class="collapsible collapsible-accordion">
                                <li>
                                    <a class="collapsible-header waves-effect waves-gray">
                                        Agendamentos <i class="material-icons left">arrow_drop_down</i>
                                    </a>
                                    <div class="collapsible-body">
                                        <ul>
                                            <li><a href="{{ url('/agendamentos') }}">Agendar horário</a></li>
                                            <li><a href="{{ url('/agenda') }}">Minha agenda</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="no-padding"><a href="{{ url('/agendamentos') }}">Agendamentos</a></li>
                    @endif

                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a class="collapsible-header waves-effect waves-brown">
                                    {{ Auth::user()->name }} <i class="material-icons left">arrow_drop_down</i>
                                </a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="{{ url('/users/dados') }}">Meus dados</a></li>
                                        <li><a href="{{ url('/users/excluirConta') }}">Excluir Conta</a></li>
                                        <li><a href="{{ url('/users/alterarSenha') }}">Alterar Senha</a></li>
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
</div>

