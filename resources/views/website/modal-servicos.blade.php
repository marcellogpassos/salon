<div id="modal-servicos" class="modal">
    <div class="modal-content">

        <div class="row section-title">
            <div class="col s12">
                <h1>SERVI&Ccedil;OS FORNECIDOS</h1>
                <hr>
            </div>
        </div>

        <div class="row section-body">
            <div class="col s12">

                @foreach($categorias as $categoria)

                    @if(count($categoria->servicos))

                        <div class="row brown lighten-5 categoria-servico">
                            <div class="col s12">

                                <div class="row categoria-servico-title">
                                    <div class="col s12">
                                        <h2>{{ $categoria->descricao }}</h2>
                                    </div>
                                </div>

                                <div class="row servico">

                                    @foreach($categoria->servicos as $servico)

                                        @if($servico->itemVenda->ativo)
                                            <div class="col s12 m6">
                                                <p class="light">{{ $servico->descricao }}</p>
                                            </div>
                                        @endif

                                    @endforeach

                                </div>

                            </div>
                        </div>

                    @endif

                @endforeach

            </div>
        </div>

    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
    </div>
</div>