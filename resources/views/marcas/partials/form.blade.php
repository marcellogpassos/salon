<div class="card-content gray-text text-darken-4">

        <div class="row">

            <div class="input-field col s12 m6">
                <input id="descricaoMarcaInput" name="descricao" type="text" required maxlength="255" class="validate"
                       value="{{ old('descricao') ? old('descricao') : (isset($marca->descricao)) ? $marca->descricao : '' }}">
                <label for="descricaoMarcaInput">Nome da marca *</label>
            </div>

            <div class="input-field col s12 m6">
                <input id="websiteInput" name="website" type="url" maxlength="255" class="validate"
                       value="{{ old('website') ? old('website') : (isset($marca->website)) ? $marca->website : '' }}">
                <label for="websiteInput">Website da marca*</label>
            </div>

        </div>

    <div class="row">

        <div class="input-field col s12 m4">
            <input id="nomeFornecedorInput" name="nome_fornecedor" type="text" maxlength="255" class="validate"
                   value="{{ old('nome_fornecedor') ? old('nome_fornecedor') : (isset($marca->nome_fornecedor)) ? $marca->nome_fornecedor : '' }}">
            <label for="nomeFornecedorInput">Fornecedor</label>
        </div>

        <div class="input-field col s12 m4">
            <input id="emailFornecedorInput" name="email_fornecedor" type="email" maxlength="255" class="validate"
                   value="{{ old('email_fornecedor') ? old('email_fornecedor') : (isset($marca->email_fornecedor)) ? $marca->email_fornecedor : '' }}">
            <label for="emailFornecedorInput">E-mail do fornecedor</label>
        </div>

        <div class="input-field col s12 m4">
            <input id="telefoneFornecedorInput" name="telefone_fornecedor" type="text" class="validate telefone"
                   value="{{ old('telefone_fornecedor') ? old('telefone_fornecedor') : (isset($marca->telefone_fornecedor)) ? $marca->telefone_fornecedor : '' }}">
            <label for="telefoneFornecedorInput">Telefone do fornecedor</label>
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
