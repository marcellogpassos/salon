app.factory("Enderecos", function (config, $resource) {

    var _consultarCep = function (cep, successFunction, errorFunction) {
        var rest = $resource(config.viaCepUrl, {'cep': ''});
        rest.get({cep: cep}, successFunction, errorFunction);
    };

    var _getUfId = function (ibge) {
        if (!ibge || ibge.length != 7)
            return null;

        return ibge.substr(0, 2);
    };

    var _getMunicipioId = function (ibge) {
        if (!ibge || ibge.length != 7)
            return null;

        return ibge.substr(2, 7);
    };

    var _listarUfs = function (successFunction, errorFunction) {
        var rest = $resource(config.enderecosUrl + '/uf');
        rest.query(successFunction, errorFunction);
    };

    var _listarMunicipios = function (uf, successFunction, errorFunction) {
        var rest = $resource(config.enderecosUrl + '/uf/:ufId/municipios', {'ufId': ''});
        rest.query({ufId: uf}, successFunction, errorFunction);
    };

    return {
        consultarCep: _consultarCep,
        getUfId: _getUfId,
        getMunicipioId: _getMunicipioId,
        listarUfs: _listarUfs,
        listarMunicipios: _listarMunicipios
    };

});