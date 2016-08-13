@extends('layouts.appm')

@section('title')
    Registrar Compra
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <nav>
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s12">
                        <div class="col s12 m4">
                            <strong>Cliente:</strong> {{ $cliente->name . ' ' . $cliente->surname }}
                        </div>

                        <div class="col s12 m4">
                            {{ dataPorExtenso() }}
                        </div>

                        <div class="col s12 m4">
                            <strong>Usu&aacute;rio:</strong> {{ $caixa->name . ' ' . $cliente->surname }}
                        </div>
                    </div>
                </div>
            </div>
        </nav>


        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Registrar compra</h4>


                </div>

            </div>
        </div>
@endsection
