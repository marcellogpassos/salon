app.factory("Enderecos", function (config, $resource) {

	var _consultarCep = function (cep, successFunction, errorFunction) {
		var rest = $resource(config.viaCepUrl, {'cep': ''});
		rest.get({cep: cep}, successFunction, errorFunction);
	};

	var _getUf = function (uf, successFunction, errorFunction) {
		var rest = $resource(config.enderecosUrl + '/uf/:ufId', {'ufId': ''});
		rest.get({ufId: uf}, successFunction, errorFunction);
	};

	var _getUfId = function (ibge) {
		if (!ibge || ibge.length != 7)
			return null;

		return ibge.substr(0, 2);
	};

	var _getMunicipio = function (uf, municipio, successFunction, errorFunction) {
		var rest = $resource(config.enderecosUrl + '/uf/:ufId/municipios/:municipioId', {
			'ufId': '',
			'municipioId': ''
		});
		rest.get({ufId: uf, municipioId: municipio}, successFunction, errorFunction);
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
		getUf: _getUf,
		getUfId: _getUfId,
		getMunicipio: _getMunicipio,
		getMunicipioId: _getMunicipioId,
		listarUfs: _listarUfs,
		listarMunicipios: _listarMunicipios
	};

});