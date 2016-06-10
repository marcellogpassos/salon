var ufs = [
    {id: "11", nome: "ROND\u00d4NIA", sigla: "RO"},
    {id: "12", nome: "ACRE", sigla: "AC"},
    {id: "13", nome: "AMAZONAS", sigla: "AM"},
    {id: "14", nome: "RORAIMA", sigla: "RR"},
    {id: "15", nome: "PAR\u00c1", sigla: "PA"},
    {id: "16", nome: "AMAP\u00c1", sigla: "AP"},
    {id: "17", nome: "TOCANTINS", sigla: "TO"},
    {id: "21", nome: "MARANH\u00c3O", sigla: "MA"},
    {id: "22", nome: "PIAU\u00cd", sigla: "PI"},
    {id: "23", nome: "CEAR\u00c1", sigla: "CE"},
    {id: "24", nome: "RIO GRANDE DO NORTE", sigla: "RN"},
    {id: "25", nome: "PARA\u00cdBA", sigla: "PB"},
    {id: "26", nome: "PERNAMBUCO", sigla: "PE"},
    {id: "27", nome: "ALAGOAS", sigla: "AL"},
    {id: "28", nome: "SERGIPE", sigla: "SE"},
    {id: "29", nome: "BAHIA", sigla: "BA"},
    {id: "31", nome: "MINAS GERAIS", sigla: "MG"},
    {id: "32", nome: "ESP\u00cdRITO SANTO", sigla: "ES"},
    {id: "33", nome: "RIO DE JANEIRO", sigla: "RJ"},
    {id: "35", nome: "S\u00c3O PAULO", sigla: "SP"},
    {id: "41", nome: "PARAN\u00c1", sigla: "PR"},
    {id: "42", nome: "SANTA CATARINA", sigla: "SC"},
    {id: "43", nome: "RIO GRANDE DO SUL", sigla: "RS"},
    {id: "50", nome: "MATO GROSSO DO SUL", sigla: "MS"},
    {id: "51", nome: "MATO GROSSO", sigla: "MT"},
    {id: "52", nome: "GOI\u00c1S", sigla: "GO"},
    {id: "53", nome: "DISTRITO FEDERAL", sigla: "DF"}
];

var initUfs = function (form) {

    console.log(ufs);

};

var resetUf = function (form) {
    $(form + ' .uf').val('');
    $(form + ' .municipio').val('');

    console.log('UF resetado!');
};

var setUfBusy = function (busy, form) {
    $(form + ' .uf').prop('disabled', busy);
    $(form + ' .municipio').prop('disabled', busy);
};

var setUf = function (uf, form) {
    if (!uf)
        resetUf(form);

    else
        console.log('UF: ' + uf);
};

var resetCep = function (form) {
    resetUf(form);
    $(form + ' .cep').val('');
    $(form + ' .logradouro').val('');
    $(form + ' .numero').val('');
    $(form + ' .bairro').val('');
    $(form + ' .complemento').val('');

    console.log('CEP resetado!');
};

var setCepBusy = function (busy, form) {
    setUfBusy(busy, form);
    $(form + ' .cep').prop('disabled', busy);
    $(form + ' .logradouro').prop('disabled', busy);
    $(form + ' .numero').prop('disabled', busy);
    $(form + ' .bairro').prop('disabled', busy);
    $(form + ' .complemento').prop('disabled', busy);
};

var setCep = function (cep, form) {
    cep = cep.replace(/\D/g, '');

    if (!cep)
        resetCep(form);

    else {
        setCepBusy(true, form);

        enderecosService.consultarCep(cep, function (endereco) {
            if (endereco.erro)
                console.log('Falha ao tentar consultar o CEP');
            else {
                $(form + ' .logradouro').val(endereco.logradouro);
                $(form + ' .bairro').val(endereco.bairro);
                $(form + ' .complemento').val(endereco.complemento);
            }
            setCepBusy(false, form);
        }, function (error) {
            console.log('Falha ao tentar consultar o CEP');
            setCepBusy(false, form);
        });

    }
};
