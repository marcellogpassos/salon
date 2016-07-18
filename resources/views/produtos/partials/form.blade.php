<div class="card-content gray-text text-darken-4">

    <div class="row">

        <div class="input-field col s12 offset-m2 m2">
            <input id="codigoInput" name="id" type="text" maxlength="16" class="validate">
            <label for="codigoInput">C&oacute;digo</label>
        </div>

        <div class="input-field col s12 m6">
            <input id="descricaoInput" name="descricao" type="text" maxlength="255" minlength="3" class="validate">
            <label for="descricaoInput">Descri&ccedil;&atilde;o do produto</label>
        </div>

    </div>

    <div class="row">

        <div class="col offset-m2 s12 m4">
            <label for="categoriaProdutoInput" class="active">Categoria</label>
            <select id="categoriaProdutoInput" name="categoria_id" class="browser-default">
                <option value="" selected></option>
                @foreach($categoriasProdutos as $categoria)
                    <option value="{{ $categoria->id }}">
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
                    <option value="{{ $marca->id }}">
                        {{ $marca->descricao }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="row">

        <div class="input-field offset-m2 col s12 m2">
            <input id="quantidadeInput" name="quantidade" type="text" maxlength="16" class="validate">
            <label for="quantidadeInput">Quantidade *</label>
        </div>

        <div class="input-field col s12 m2">
            <input id="valorInput" name="valor" type="text" maxlength="16" class="validate moeda" >
            <label for="valorInput">Valor (R$) *</label>
        </div>

        <div class="input-field col s12 m4">
            <div class="col s6 right">
                <input name="ativo" type="radio" id="ativoInput" value="1" checked>
                <label for="ativoInput">Item ativo</label>
            </div>
            <div class="col s6 right">
                <input name="ativo" type="radio" id="inativoInput" value="0">
                <label for="inativoInput">Item inativo</label>
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
