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
	slotDuration: '00:05:00',
	minTime: '08:00',
	defaultDate: def,
	viewRender: function () {
		viewType = $('#calendar').fullCalendar('getView').type;
		viewMinDate = $('#calendar').fullCalendar('getView').start._d.getTime() / 1000;
		viewMaxDate = $('#calendar').fullCalendar('getView').end._d.getTime() / 1000;

		if (viewType == 'month') {
			$(".fc-today-button").hide();
			$(".fc-prev-button").hide();
			$(".fc-next-button").hide();
		}
		else {
			$(".fc-today-button").show();
			$(".fc-prev-button").show();
			$(".fc-next-button").show();
		}

		if (viewMinDate <= minDate)
			$(".fc-prev-button").hide();
		else
			$(".fc-prev-button").show();

		if (viewMaxDate >= maxDate)
			$(".fc-next-button").hide();
		else
			$(".fc-next-button").show();

		if (!current)
			$(".fc-today-button").hide();
	},
	maxTime: '18:00',
	events: agenda,
	eventClick: function (calEvent, jsEvent, view) {
		detalharAgendamento('#datalharAgendamentoModal', calEvent.id);
	}
});