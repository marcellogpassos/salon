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

                <div class="row">
                    <div class="col s6">
                        <a href="{{ url('/agenda?mes=' . $mesAnterior->year . '-' . $mesAnterior->month) }}"
                           class="btn primary">
                            <i class="material-icons left">keyboard_arrow_left</i>
                            {{ traduzirMes( $mesAnterior->format('F \/ Y') ) }}
                        </a>
                    </div>
                    <div class="col s6" style="text-align: right">
                        <a href="{{ url('/agenda?mes=' . $mesSeguinte->year . '-' . $mesSeguinte->month) }}"
                           class="btn primary">
                            {{ traduzirMes( $mesSeguinte->format('F \/ Y') ) }}
                            <i class="material-icons right">keyboard_arrow_right</i>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <h4 class="card-title">Calend&aacute;rio</h4>
                            <div class="card-content">
                                <div id='calendar' class="calendario"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @include('agendamentos.partials.detalhar')

@endsection

@section('scripts')

    <script src="{{ asset('lib/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lib/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('lib/fullcalendar/locale/pt-br.js') }}"></script>

    <script type="application/javascript">
        var agenda = {!! json_encode($agenda) !!};

        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        var def = todayDate;
        var current = true;
        @if($default)
            def = '{!! $default !!}';
            current = false;
        @endif

        var minDate = '{!! $minDate !!}';
        var maxDate = '{!! $maxDate !!}';

    </script>

    <script src="{{ asset('js/agenda.js') }}"></script>

@endsection