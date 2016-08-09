@extends('layouts.appm')

@section('title')
    Editar produto
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Editar produto</h4>

                    <form id="editarProdutoForm" method="POST" action="{{ url('/produtos/' . $produto->id . '/editar') }}"
                          role="form">

                        {{ csrf_field() }}

                        @include('produtos.partials.form')

                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('lib/jquery-maskmoney/jquery.maskMoney.min.js') }}"></script>
    <script src="{{ asset('js/money.js') }}"></script>
@endsection