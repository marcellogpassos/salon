var injector;

var enderecosService;

var ufs;

$(document).ready(function () {
    injector = angular.element(document).injector();
    enderecosService = injector.get('Enderecos');
});