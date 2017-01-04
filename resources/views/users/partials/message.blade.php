<div id="enviarMensagemModal" class="modal">
    <div class="modal-content">

        <h4 class="nome">Enviar Mensagem</h4>

        <div class="row">
            <div class="col s12 usuario-sem-email">
                <div id="information-alert" class="card card-alert card-alert-information nao-cadastrado">
                    <div class="card-content">
                        <p>Usu&aacute;rio n&atilde;o possui e-mail cadastrado!</p>
                    </div>
                </div>

                <div class="input-field col s12 offset-m2 m8">
                    <a href="#!" class="modal-action modal-close btn btn-block btn-primary">Fechar</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 usuario-com-email">
                <form method="post" action="{{ url('/mensagens') }}" role="form">

                    {!! csrf_field() !!}

                    <div class="input-field col s12">
                        <input value="" id="nomeClienteInput" type="text" class="nome" readonly>
                        <label for="nomeClienteInput" class="active">Cliente *</label>
                    </div>

                    <input type="hidden" name="destinatario_id" class="id" value="" required>

                    <div class="input-field col s12">
                        <input id="emailInput" type="email" class="email" readonly>
                        <label for="emailInput" class="active">Email *</label>
                    </div>

                    <div class="input-field col s12">
                        <input id="assuntoInput" type="text" class="assunto" name="assunto" length="255" required>
                        <label for="assuntoInput">Assunto *</label>
                    </div>

                    <div class="input-field col s12">
                    <textarea id="mensagemInput" type="text" class="materialize-textarea mensagem" name="mensagem"
                              length="2048" required></textarea>
                        <label for="mensagemInput">Mensagem *</label>
                    </div>

                    <div class="input-field col s12 offset-m2 m8">
                        <button type="submit" class="btn btn-block btn-primary">
                            Enviar
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    var urlRecuperarUsuario = '{{ url('/users/:id') }}';
</script>

<script src="{{ asset('js/enviarMensagem.js') }}"></script>