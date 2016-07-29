<div class="card-content gray-text text-darken-4">

    <div class="row">

        <div class="input-field col s12 offset-m2 m2">
            <input id="codigoInput" name="id" type="text" maxlength="16" class="validate"
                   value="{{ old('id') ? old('id') : (isset($servico->id) ? $servico->id : '') }}">
            <label for="codigoInput">C&oacute;digo</label>
        </div>

        <div class="input-field col s12 m6">
            <input id="descricaoInput" name="descricao" type="text" maxlength="255" minlength="3" class="validate"
                   value="{{ old('descricao') ? old('descricao') : (isset($servico->descricao) ? $servico->descricao : '') }}">
            <label for="descricaoInput">Descri&ccedil;&atilde;o do servi&ccedil;o</label>
        </div>

    </div>

    <div class="row">

        <div class="col offset-m2 s12 m4">
            <label for="categoriaServicoInput" class="active">Categoria</label>
            <select id="categoriaServicoInput" name="categoria_id" class="browser-default">
                <option value="" selected></option>

                @foreach($categoriasServicos as $categoria)
                    <option value="{{ $categoria->id }}"
                            {!! ($categoria->id == old('categoria_id') ||
                                (isset($servico->categoria_id) && $categoria->id == $servico->categoria_id)) ?
                                 ' selected' : '' !!}>
                        {{ $categoria->descricao }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input-field col s12 m4">
            <div class="col s6 right">
                <input name="masculino" type="checkbox" id="masculinoInput" value="1"
                        {!! (old('masculino') || (isset($servico->masculino) && $servico->masculino)) ? ' checked' : '' !!}>
                <label for="masculinoInput">Para homens</label>
            </div>
            <div class="col s6 right">
                <input name="feminino" type="checkbox" id="femininoInput" value="1"
                        {!! (old('feminino') || (isset($servico->feminino) && $servico->feminino)) ? ' checked' : '' !!}>
                <label for="femininoInput">Para mulheres</label>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="input-field offset-m2 col s12 m2">
            <input id="valorInput" name="valor" type="text" maxlength="16" class="validate moeda"
                   value="{{ old('valor') ? old('valor') : (isset($servico->itemVenda->valor) ?
                        moneyFormat($servico->itemVenda->valor, false) : '') }}">
            <label for="valorInput">Valor (R$) *</label>
        </div>

        <div class="input-field offset-m2 col s12 m4">
            <div class="col s6 right">
                <input name="ativo" type="radio" id="ativoInput" value="1"
                        {!! (old('ativo') == '1' || (isset($servico->itemVenda->ativo) && $servico->itemVenda->ativo == '1')) ?
                                  ' checked' : '' !!}>
                <label for="ativoInput">Servi&ccedil;o ativo</label>
            </div>
            <div class="col s6 right">
                <input name="ativo" type="radio" id="inativoInput" value="0"
                        {!! (old('ativo') == '0' || (isset($servico->itemVenda->ativo) && $servico->itemVenda->ativo == '0')) ?
                                  ' checked' : '' !!}>
                <label for="inativoInput">Servi&ccedil;o inativo</label>
            </div>
        </div>

    </div>

</div>

<div class="card-action">
    <div class="row">
        <div class="col s12 m4 offset-m4 grid-example">
            <button type="submit" class="btn btn-block waves-effect waves-light primary">
                Salvar
            </button>
        </div>
    </div>
</div>
