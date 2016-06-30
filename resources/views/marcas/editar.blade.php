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

                    <h4 class="card-title">Editar marca de produto</h4>

                    <form id="marcasForm" method="POST" action="{{ url('/marcas/'. $marca->id . '/editar') }}"
                          role="form">

                        {{ csrf_field() }}

                        @include('marcas.partials.form')

                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')

@endsection