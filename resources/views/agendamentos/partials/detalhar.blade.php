<div id="datalharAgendamentoModal" class="modal">
    <div class="modal-content">
        <h4 class="servico"></h4>
        <div class="row">
            <div class="col s12">
                <div class="col s12 m8 dados">
                    <p><strong>Data e hora:</strong>&nbsp;&nbsp;<span class="dataHora"></span></p>
                    <p><strong>Dura&ccedil;&atilde;o aproximada:</strong>&nbsp;&nbsp;
                        <span class="duracaoServico"></span></p>
                    <p><strong>Cliente:</strong>&nbsp;&nbsp;<span class="cliente"></span></p>
                    <p><strong>Profissional:</strong>&nbsp;&nbsp;<span class="profissional"></span></p>
                    <p><strong>Status:</strong>&nbsp;&nbsp;<span class="status"></span></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <a class="btn btn-block primary registrarCompra" href="" target="_blank">Registrar Compra</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var urlRecuperarAgendamento = '{!! url('/agendamentos/:id') !!}';
    var urlRegistrarCompra = '{!! url('/users/:id/registrarCompra') !!}';
</script>

<script src="{{ asset('js/detalharAgendamento.js') }}"></script>