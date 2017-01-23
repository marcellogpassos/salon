var elementToStars = function (element) {
    if (element.hasClass('star-one')) return 1;
    else if (element.hasClass('star-two')) return 2;
    else if (element.hasClass('star-three')) return 3;
    else if (element.hasClass('star-four')) return 4;
    else if (element.hasClass('star-five')) return 5;
    else return 0;
};

var starToElement = function (star) {
    if (star == 1) return $('.star-rate .star.star-one');
    else if (star == 2) return $('.star-rate .star.star-two');
    else if (star == 3) return $('.star-rate .star.star-three');
    else if (star == 4) return $('.star-rate .star.star-four');
    else if (star == 5) return $('.star-rate .star.star-five');
    else return null
};

var shine = function (star) {
    var element = starToElement(star);
    element.addClass('shine');
};

var rate = function (stars) {
    if (stars > 1)
        rate(stars - 1);
    shine(stars);
};

var clearRate = function () {
    var element = $('.star-rate .star');
    element.removeClass('shine');
};

var updateInput = function (stars) {
    $('input[name=stars]').val(stars);
};

$('.star-rate .star').click(function () {
    var stars = elementToStars($(this));
    clearRate();
    rate(stars);
    updateInput(stars);
});