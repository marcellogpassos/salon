@extends('layouts.appm')

@section('title')
    Produtos cadastrados
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Buscar produtos</h4>

                    <form id="produtosForm" class="form-horizontal" method="GET" action="{{ url('produtos/buscar') }}"
                          role="form">

                        <div class="card-content gray-text text-darken-4">

                            <div class="row">

                                <div class="input-field col s12 offset-m2 m2">
                                    <input id="codigoInput" name="id" type="text" maxlength="16"
                                           value="{{

                                                old('id') ?
                                                    old('id') : isset($buscaPrevia['id']) ?
                                                        $buscaPrevia['id'] : ""

                                           }}" class="validate">
                                    <label for="codigoInput">C&oacute;digo</label>
                                </div>

                                <div class="input-field col s12 m6">
                                    <input id="descricaoInput" name="descricao" type="text" maxlength="255"
                                           value="{{

                                                old('descricao') ?
                                                    old('descricao') : isset($buscaPrevia['descricao']) ?
                                                        $buscaPrevia['descricao'] : ""

                                           }}" minlength="3" class="validate">
                                    <label for="descricaoInput">Descri&ccedil;&atilde;o do produto</label>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col offset-m2 s12 m4">
                                    <label for="categoriaProdutoInput" class="active">Categoria</label>
                                    <select id="categoriaProdutoInput" name="categoria_id" class="browser-default">
                                        <option value="" selected></option>
                                        @foreach($categoriasProdutos as $categoria)
                                            <option value="{{ $categoria->id }}"
                                                    {!! (old('categoria_id') == $categoria->id || (isset($buscaPrevia['categoria_id']) && $buscaPrevia['categoria_id'] == $categoria->id)) ? ' selected' : '' !!}>
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
                                                    {!! (old('marca_id') == $marca->id || (isset($buscaPrevia['marca_id']) && $buscaPrevia['marca_id'] == $marca->id)) ? ' selected' : '' !!}>
                                                {{ $marca->descricao }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m4 offset-m4 grid-example">
                                    <button type="submit" class="btn btn-block waves-effect waves-light blue">
                                        Buscar
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>

                @if (isset($produtosEncontrados) && (count($produtosEncontrados) == 0))
                    <div id="information-alert" class="card card-alert card-alert-information">
                        <div class="card-content">
                            <p>Consulta realizada com sucesso! Nenhum resultado encontrado.</p>
                        </div>
                    </div>
                @endif

                @if(isset($produtosEncontrados) && (count($produtosEncontrados) > 0))

                    <div id="information-alert" class="card card-alert card-alert-information">
                        <div class="card-content">
                            <p>Consulta realizada com sucesso! {{ $produtosEncontrados->total()}} resultado(s)
                                encontrado(s).</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">

                            <div class="card white produtos-encontrados">

                                <h4 class="card-title">Produtos encontrados</h4>

                                <div class="card-content gray-text text-darken-4">

                                    <table class="bordered highlight responsive-table">

                                        <thead>
                                        <tr>
                                            <th data-field="id">C&oacute;digo</th>
                                            <th data-field="descricao">Descri&ccedil;&atilde;o</th>
                                            <th data-field="categoria_id">Categoria</th>
                                            <th data-field="marca_id">Marca</th>
                                            <th>Op&ccedil;&otilde;es</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($produtosEncontrados as $produto)
                                            <tr>
                                                <td>{{$produto->id}}</td>
                                                <td>{{$produto->descricao}}</td>
                                                <td>{{$produto->categoria ? $produto->categoria->descricao : '-'}}</td>
                                                <td>{{$produto->marca ? $produto->marca->descricao : '-'}}</td>
                                                <td>
                                                    <a href="#!"><i class="material-icons">mode_edit</i></a>
                                                    &nbsp;
                                                    <a href="{{ url('produtos/' . $produto->id . '/excluir') }}">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>

                                </div>

                                <div class="card-action">
                                    <div class="row">
                                        <div class="col s12">
                                            {!! $produtosEncontrados->appends($buscaPrevia)->render() !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                @endif

            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection