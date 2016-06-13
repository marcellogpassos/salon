<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular-resource.min.js"></script>

<script src="{{ asset('js/angular/app.js') }}"></script>
<script src="{{ asset('js/angular/config/configValue.js') }}"></script>
<script src="{{ asset('js/angular/services/enderecoService.js') }}"></script>

<script>

    var injector;

    var enderecosService;

    var ufs;

    $(document).ready(function () {
        injector = angular.element(document).injector();
        enderecosService = injector.get('Enderecos');
    });

</script>