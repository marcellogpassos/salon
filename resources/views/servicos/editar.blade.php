@extends('layouts.appm')

@section('title')
    Editar servi&ccedil;o
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Editar novo servi&ccedil;o</h4>

                    <form id="editarServicoForm" method="POST" action="{{ url('/servicos/' . $servico->id . '/editar') }}" role="form">

                        {{ csrf_field() }}

                        @include('servicos.partials.form')

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