@extends('layouts.appm')

@section('title')
    Cadastar marca de produtos
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Cadastrar nova marca de produtos</h4>

                    <form id="marcasForm" class="form-horizontal" method="POST" action="{{ url('/marcas/cadastrar') }}"
                          role="form">
                        {{ csrf_field() }}

                        <div class="card-content gray-text text-darken-4">

                            <div class="row">

                                <div class="input-field col s12 m6">
                                    <input id="descricaoMarcaInput" name="descricao" type="text" required
                                           maxlength="255"
                                           class="validate" value="{{ old('descricao') ? old('descricao') : '' }}">
                                    <label for="descricaoMarcaInput">Nome da marca *</label>
                                </div>

                                <div class="input-field col s12 m6">
                                    <input id="websiteInput" name="website" type="url" maxlength="255"
                                           class="validate" value="{{ old('website') ? old('website') : '' }}">
                                    <label for="websiteInput">Website *</label>
                                </div>

                            </div>

                            <div class="row">

                                <div class="input-field col s12 m4">
                                    <input id="nomeFornecedorInput" name="nome_fornecedor" type="text" maxlength="255"
                                           value="{{ old('nome_fornecedor') ? old('nome_fornecedor') : '' }}"
                                           class="validate">
                                    <label for="nomeFornecedorInput">Fornecedor</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <input id="emailFornecedorInput" name="email_fornecedor" type="email"
                                           maxlength="255"
                                           value="{{ old('email_fornecedor') ? old('email_fornecedor') : '' }}"
                                           class="validate">
                                    <label for="emailFornecedorInput">E-mail do fornecedor</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <input id="telefoneFornecedorInput" name="telefone_fornecedor" type="text"
                                           value="{{ old('telefone_fornecedor') ? old('telefone_fornecedor') : '' }}"
                                           class="validate telefone">
                                    <label for="telefoneFornecedorInput">Telefone do fornecedor</label>
                                </div>

                            </div>

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m4 offset-m4 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light blue">
                                        Salvar
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')

@endsection