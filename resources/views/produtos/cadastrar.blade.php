@extends('layouts.appm')

@section('title')
    Cadastar produto
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Cadastrar novo produto</h4>

                    <form id="cadastrarProdutoForm" method="POST" action="{{ url('/produtos/cadastrar') }}" role="form">

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