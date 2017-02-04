<div id="datalharUsuarioModal" class="modal">
    <div class="modal-content">
        <h4 class="nome"></h4>
        <div class="row">
            <div class="col s12">
                <div id="information-alert" class="card card-alert card-alert-information nao-cadastrado">
                    <div class="card-content">
                        <p>Dados do usu&aacute;rio n&atilde;o fornecidos!</p>
                    </div>
                </div>
                <div class="col s12 m4">
                    <p><img class="foto" src="" height="100%" width="100%" align="middle"></p>
                </div>
                <div class="col s12 m8 dados">

                    <div class="row">
                        <div class="col s12">
                            <p><strong>CPF:</strong>&nbsp;&nbsp;<span class="cpf"></span></p>
                            <p><strong>Sexo:</strong>&nbsp;&nbsp;<span class="sexo"></span>&nbsp;&nbsp;
                                <strong>Data de nascimento:</strong>&nbsp;&nbsp;<span class="dataNascimento"></span>
                            </p>
                            <br>
                            <p><strong>Telefone:</strong>&nbsp;&nbsp;<span class="telefone"></span></p>
                            <p><strong>E-mail:</strong>&nbsp;&nbsp;<span class="email"></span></p>
                            <br>
                            <p class="endereco"><strong>Endere&ccedil;o:</strong></p>
                            <p class="endereco">
                                <span class="logradouro"></span>,&nbsp;
                                <span class="numero"></span>.&nbsp;
                                <span class="bairro"></span>
                                <span class="municipio"></span>&nbsp;-&nbsp;
                                <span class="uf"></span>
                            </p>
                            <p class="endereco">
                                <span class="cep"></span>.&nbsp;
                                <span class="complemento"></span>
                            </p>
                        </div>
                    </div>

                    @if(Auth::user()->possuiRole(\App\Role::CAIXA) || Auth::user()->admin())

                        <div class="row">
                            <div class="col s12 offset-m2 m8">
                                <a class="btn btn-block btn-primary compras" href="" target="_blank">
                                    Ver compras deste usuário
                                </a>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    var urlRecuperarUsuario = '{{ url('/users/:id') }}';
    var urlPublic = '{{ url('/') }}';
    var comprasUsuario = '{{ url('/compras/buscar?cliente=:id') }}';
</script>

<script src="{{ asset('js/detalharUsuario.js') }}"></script>