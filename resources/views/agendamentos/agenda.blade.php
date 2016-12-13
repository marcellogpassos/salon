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

    <script type="application/javascript">
        var agenda = {!! json_encode($agenda) !!};

        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        $('#calendar').fullCalendar({
            header: {
                left: 'title',
                center: 'prev,next today',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            allDaySlot: false,
            slotEventOverlap: false,
            editable: false,
            contentHeight: 1000,
            eventLimit: true, // allow "more" link when too many events
            navLinks: true,
            slotDuration: '00:15:00',
            minTime: '08:00',
            maxTime: '18:00',
            events: agenda
        });
    </script>

@endsection