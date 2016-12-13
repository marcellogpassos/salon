@extends('layouts.appm')

@section('styles')

    <link href="{{ asset('lib/fullcalendar/fullcalendar.min.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection"/>

@endsection

@section('title')
    Minha Agenda
@endsection

@section('content')

    <div class="container">

        @include('layouts.messages')

        <div class="row">

            <div class="col s12">

                <div id='calendar' class="calendario"></div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')

    <script src="{{ asset('lib/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lib/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('lib/fullcalendar/locale/pt-br.js') }}"></script>

@endsection