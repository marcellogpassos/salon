<div class="card-content gray-text text-darken-4">

    <div class="row">

        <div class="input-field col s12 offset-m2 m2">
            <input id="codigoInput" type="text" maxlength="16"
                   {!! isset($produto) ? ' readonly ' : ' name="id" ' !!}
                   value="{{ old('id') ? old('id') : (isset($produto->id) ? $produto->id : '') }}">
            <label for="codigoInput">C&oacute;digo</label>
        </div>

        <div class="input-field col s12 m6">
            <input id="codigoBarrasInput" name="codigo_barras" type="text" maxlength="13" minlength="8"
                   value="{{ old('codigo_barras') ? old('codigo_barras') : (isset($produto->codigo_barras) ? $produto->codigo_barras : '') }}"
                   class="validate">
            <label for="codigoBarrasInput">C&oacute;digo de barras</label>
        </div>

    </div>

    <div class="row">

        <div class="input-field col s12 offset-m2 m8">
            <input id="descricaoInput" name="descricao" type="text" maxlength="255" minlength="3" class="validate"
                   value="{{ old('descricao') ? old('descricao') : (isset($produto->descricao) ? $produto->descricao : '') }}">
            <label for="descricaoInput">Descri&ccedil;&atilde;o do produto *</label>
        </div>

    </div>

    <div class="row">

        <div class="col offset-m2 s12 m4">
            <label for="categoriaProdutoInput" class="active">Categoria *</label>
            <select id="categoriaProdutoInput" name="categoria_id" class="browser-default">
                <option value="" selected></option>

                @foreach($categoriasProdutos as $categoria)
                    <option value="{{ $categoria->id }}"
                            {!! ($categoria->id == old('categoria_id') ||
                                (isset($produto->categoria_id) && $categoria->id == $produto->categoria_id)) ?
                                 ' selected' : '' !!}>
                        {{ $categoria->descricao }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col s12 m4">
            <label for="marcaProdutoInput" class="active">Marca</label>
            <select id="marcaProdutoInput" name="marca_id" class="browser-default">
                <option value="" selected></option>
                @foreach($marcasProdutos as $marca)
                    <option value="{{ $marca->id }}"
                            {!! ($marca->id == old('marca_id') ||
                                (isset($produto->marca_id) && $marca->id == $produto->marca_id)) ?
                                 ' selected' : '' !!}>
                        {{ $marca->descricao }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="row">

        <div class="input-field offset-m2 col s12 m2">
            <input id="quantidadeInput" name="quantidade" type="text" maxlength="16" class="validate"
                   value="{{ old('quantidade') ? old('quantidade') : (isset($produto->quantidade) ? $produto->quantidade : '') }}">
            <label for="quantidadeInput">Quantidade *</label>
        </div>

        <div class="input-field col s12 m2">
            <i class="material-icons prefix">attach_money</i>
            <input id="valorInput" name="valor" type="text" maxlength="16" class="validate moeda"
                   value="{{ old('valor') ? old('valor') : (isset($produto->itemVenda->valor) ?
                        moneyFormat($produto->itemVenda->valor, false) : '') }}">
            <label for="valorInput">Valor (R$) *</label>
        </div>

        <div class="input-field col s12 m4">
            <div class="col s6 right">
                <input name="ativo" type="radio" id="ativoInput" value="1"
                        {!! (old('ativo') == '1' || (isset($produto->itemVenda->ativo) && $produto->itemVenda->ativo == '1')) ?
                                  ' checked' : '' !!}>
                <label for="ativoInput">Produto ativo</label>
            </div>
            <div class="col s6 right">
                <input name="ativo" type="radio" id="inativoInput" value="0"
                        {!! (old('ativo') == '0' || (isset($produto->itemVenda->ativo) && $produto->itemVenda->ativo == '0')) ?
                                  ' checked' : '' !!}>
                <label for="inativoInput">Produto inativo</label>
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
