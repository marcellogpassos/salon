$('.card-alert .close').click(function () {
	var cardAlert = $(this).attr('data-dismiss');
	$(cardAlert).remove();
});