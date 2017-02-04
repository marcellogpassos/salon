@extends('layouts.appm')

@section('title')
    Servi&ccedil;os cadastrados
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Buscar servi&ccedil;os</h4>

                    <form id="servicosForm" class="form-horizontal" method="GET" action="{{ url('servicos/buscar') }}"
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
                                    <label for="descricaoInput">Descri&ccedil;&atilde;o do servi&ccedil;o</label>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col offset-m2 s12 m4">
                                    <label for="categoriaProdutoInput" class="active">Categoria</label>
                                    <select id="categoriaProdutoInput" name="categoria_id" class="browser-default">
                                        <option value="" selected></option>
                                        @foreach($categoriasServicos as $categoria)
                                            <option value="{{ $categoria->id }}"
                                                    {!! (old('categoria_id') == $categoria->id || (isset($buscaPrevia['categoria_id']) && $buscaPrevia['categoria_id'] == $categoria->id)) ? ' selected' : '' !!}>
                                                {{ $categoria->descricao }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-field col s12 m4">
                                    <div class="col s6 right">
                                        <input name="masculino" type="checkbox" id="masculinoInput" value="1"
                                                {!! (old('masculino') || (isset($buscaPrevia['masculino']) && $buscaPrevia['masculino'])) ? ' checked' : '' !!}>
                                        <label for="masculinoInput">Para homens</label>
                                    </div>
                                    <div class="col s6 right">
                                        <input name="feminino" type="checkbox" id="femininoInput" value="1"
                                                {!! (old('feminino') || (isset($buscaPrevia['feminino']) && $buscaPrevia['feminino'])) ? ' checked' : '' !!}>
                                        <label for="femininoInput">Para mulheres</label>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m4 grid-example{{Auth::user()->admin() ? ' offset-m2' : ' offset-m4'}}">
                                    <button type="submit" class="btn btn-block waves-effect waves-light primary">
                                        Buscar
                                    </button>
                                </div>

                                @if(Auth::user()->admin())
                                    <div class="col s12 m4 grid-example">
                                        <a class="btn btn-block waves-effect waves-light secondary"
                                           href="{{ url('servicos/cadastrar') }}">
                                            Cadastrar servi&ccedil;o
                                        </a>
                                    </div>
                                @endif

                            </div>
                        </div>

                    </form>

                </div>

                @if (isset($servicosEncontrados) && (count($servicosEncontrados) == 0))
                    @include('partials.nenhumResultadoEncontrado')
                @endif

                @if(isset($servicosEncontrados) && (count($servicosEncontrados) > 0))

                    <div id="information-alert" class="card card-alert card-alert-information">
                        <div class="card-content">
                            <p>Consulta realizada com sucesso! {{ $servicosEncontrados->total()}} resultado(s)
                                encontrado(s).</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">

                            <div class="card white itens-encontrados">

                                <h4 class="card-title">Servi&ccedil;os encontrados</h4>

                                <div class="card-content gray-text text-darken-4">

                                    <table class="bordered highlight responsive-table">

                                        <thead>
                                        <tr>
                                            <th data-field="id">C&oacute;d.</th>
                                            <th data-field="descricao">Descri&ccedil;&atilde;o</th>
                                            <th data-field="categoria_id">Categoria</th>
                                            <th data-field="duracao">Dura&ccedil;&atilde;o</th>
                                            <th data-field="valor">Valor</th>
                                            @if(Auth::user()->admin())
                                                <th>Op&ccedil;&otilde;es</th>
                                            @endif
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($servicosEncontrados as $servico)
                                            <tr {!! (!$servico->itemVenda->ativo ? 'class="itemInativo"' : '') !!}}>
                                                <td>{{$servico->id}}</td>
                                                <td>{{$servico->descricao}}</td>
                                                <td>{{$servico->categoria ? $servico->categoria->descricao : '-'}}</td>
                                                <td>
                                                    {{ $servico->duracao }}
                                                </td>
                                                <td>{{moneyFormat($servico->itemVenda->valor)}}</td>
                                                @if(Auth::user()->admin())
                                                    <td>
                                                        <a href="{{ url('servicos/' . $servico->id . '/editar') }}">
                                                            <i class="material-icons">mode_edit</i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="{{ url('servicos/' . $servico->id . '/excluir') }}">
                                                            <i class="material-icons">delete</i>
                                                        </a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>

                                </div>

                                <div class="card-action">
                                    <div class="row">
                                        <div class="col s12">
                                            {!! $servicosEncontrados->appends($buscaPrevia)->render() !!}
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