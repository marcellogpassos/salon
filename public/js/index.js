(function($){
    $(function(){

        $('.button-collapse').sideNav();
        $('.parallax').parallax();
        $('.modal').modal();

        $('.scrollspy').scrollSpy({
            scrollOffset: 64
        });

        Materialize.scrollFire([
            {selector: '.sf-one', offset: 100, callback: function(el) { Materialize.fadeInImage($(el)); }},
            {selector: '.sf-two', offset: 200, callback: function(el) { Materialize.fadeInImage($(el)); }},
            {selector: '.sf-three', offset: 320, callback: function(el) { Materialize.fadeInImage($(el)); }},
            {selector: '.sf-four', offset: 360, callback: function(el) { Materialize.fadeInImage($(el)); }},
            {selector: '.sf-five', offset: 400, callback: function(el) { Materialize.fadeInImage($(el)); }},
            {selector: '.sf-six', offset: 400, callback: function(el) { Materialize.fadeInImage($(el)); }}
        ]);

    });
})(jQuery);