@extends('layouts.appm')

@section('title')
    Marcas de produtos
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Marcas de produtos</h4>

                    <div class="card-content gray-text text-darken-4">

                        <ul class="collapsible popout" data-collapsible="accordion">

                            @foreach($marcas as $marca)
                                <li class="usuario-encontrado">
                                    <div class="collapsible-header{{(count($marcas) == 1) ? ' active' : ''}}">
                                        <i class="fa fa-archive"></i>&nbsp;

                                        <a href="{{ $marca->website }}" target="_blank" class="right">
                                            <i class="material-icons">link</i>
                                        </a>

                                        {{ $marca->descricao }}&nbsp;
                                    </div>
                                    <div class="collapsible-body">

                                        <div class="row">
                                            <div class="col s12">
                                                <div class="col s12 m4">
                                                    <p>
                                                        <strong>Fornecedor:</strong>&nbsp;{{ $marca->nome_fornecedor }}
                                                    </p>
                                                </div>

                                                <div class="col s12 m4">
                                                    <p>
                                                        <strong>E-mail:</strong>&nbsp;{{ $marca->email_fornecedor }}
                                                    </p>
                                                </div>

                                                <div class="col s12 m4">
                                                    <p>
                                                        <strong>Telefone:</strong>&nbsp;
                                                        {{ telefoneFormat($marca->telefone_fornecedor) }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col s12">
                                                <div class="col s12 m4 grid-example{{!Auth::user()->admin() ? ' offset-m4' : ''}}">
                                                    <a class="btn btn-block waves-effect waves-light secondary"
                                                       href="{{ url('/produtos/buscar?marca_id=' . $marca->id) }}">
                                                        Ver produtos
                                                    </a>
                                                </div>

                                                @if(Auth::user()->admin())
                                                    <div class="col s12 m4 grid-example">
                                                        <a class="btn btn-block waves-effect waves-light secondary"
                                                           href="{{ url('/marcas/' . $marca->id . '/editar') }}">
                                                            Editar
                                                        </a>
                                                    </div>
                                                    <div class="col s12 m4 grid-example">
                                                        <a class="btn btn-block waves-effect waves-light secondary"
                                                           href="{{ url('/marcas/' . $marca->id . '/excluir') }}">
                                                            Excluir
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </li>
                            @endforeach

                        </ul>

                    </div>

                    @if(Auth::user()->admin())

                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m4 offset-m4 grid-example">
                                    <a class="btn btn-block waves-effect waves-light primary"
                                       href="{{ url('/marcas/cadastrar') }}">
                                        Cadastrar nova marca
                                    </a>
                                </div>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')

@endsection