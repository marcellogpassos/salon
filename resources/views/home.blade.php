@extends('layouts.appm')

@section('title')
    Home
@endsection

@section('content')
<div class="container">

    @include('layouts.messages')

    <div class="row">
        <div class="col s12 m6">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Bem vindo, {{ $user->name }}!</span>
                    <p>Voc&ecirc; est&aacute; autenticado!</p>
                </div>
                <div class="card-action">
                    <a href="#">Saiba mais</a>
                    <a href="#">Entre em contato</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
