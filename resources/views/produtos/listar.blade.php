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

                    <h4 class="card-title">Produtos cadastrados</h4>

                    <div class="card-content gray-text text-darken-4">

                        <table class="bordered highlight responsive-table">

                            <thead>
                            <tr>
                                <th data-field="id">C&oacute;digo</th>
                                <th data-field="descricao">Descri&ccedil;&atilde;o</th>
                                <th data-field="categoria_id">Categoria</th>
                                <th data-field="marca_id">Marca</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($produtos as $produto)
                                <tr>
                                    <td>{{$produto->id}}</td>
                                    <td>{{$produto->descricao}}</td>
                                    <td>{{$produto->categoria ? $produto->categoria->descricao : '-'}}</td>
                                    <td>{{$produto->marca ? $produto->marca->descricao : '-'}}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>

                    <div class="card-action">
                        <div class="row">
                            <div class="col s12">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')

@endsection