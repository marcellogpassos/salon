var injector;

var enderecosService;

$(document).ready(function () {
    injector = angular.element(document).injector();

    enderecosService = injector.get('Enderecos');
});