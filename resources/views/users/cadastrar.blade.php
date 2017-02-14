@extends('layouts.appm')

@section('title')
    Cadastrar Cliente
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Cadastrar Cliente</h4>

                    {!! Form::open(
                        array(
                            'id' => 'userForm',
                            'url' => '/users/cadastrar',
                            'method' => 'POST',
                            'class' => 'form-horizontal'
                        )
                    ) !!}

                    {{ csrf_field() }}

                    <div class="card-content gray-text text-darken-4">

                        <div class="row">

                            <div class="input-field col s12 m4">
                                <input id="nameInput" name="name" type="text" required maxlength="255"
                                       class="validate" value="{{ old('name') }}">
                                <label for="nameInput">Nome *</label>
                            </div>

                            <div class="input-field col s12 m4">
                                <input id="surnameInput" name="surname" type="text" required maxlength="255"
                                       class="validate" value="{{ old('surname') }}">
                                <label for="surnameInput">Sobrenome *</label>
                            </div>

                            <div class="input-field horizontal-radio col s12 m4">
                                <div>
                                    <spam>
                                        <input name="sexo" type="radio" id="femininoInput" value="F"
                                                {!! (old('sexo') == 'F') ? ' checked' : '' !!}>
                                        <label for="femininoInput">Feminino</label>
                                    </spam>
                                    <spam>
                                        <input name="sexo" type="radio" id="masculinoInput" value="M"
                                                {!! (old('sexo') == 'M') ? ' checked' : '' !!}>
                                        <label for="masculinoInput">Masculino</label>
                                    </spam>
                                </div>
                                <label class="active">Sexo *</label>
                            </div>

                        </div>

                        <div class="row">

                            <div class="input-field col s12 m4">
                                <i class="material-icons prefix">date_range</i>
                                <input id="nascimentoInput" name="data_nascimento" class="data data-passada"
                                       type="text">
                                <label for="nascimentoInput">Data de nascimento *</label>
                            </div>

                            <div class="input-field col s12 m4">
                                <i class="material-icons prefix">phone</i>
                                <input id="telefoneInput" name="telefone" type="text" class="validate telefone"
                                       value="{{ old('telefone') }}" required>
                                <label for="telefoneInput">Telefone *</label>
                            </div>

                            <div class="input-field col s12 m4">
                                <input id="cpfInput" name="cpf" class="validate cpf" value="{{ old('cpf') }}"
                                       type="text">
                                <label for="cpfInput">CPF</label>
                            </div>

                        </div>

                        <div class="row">

                            <div class="input-field col s12 m4">
                                <i class="material-icons prefix">location_on</i>
                                <input id="cepInput" name="cep" value="{{ old('cep') }}" onchange="setCep(this.value)"
                                       class="cep" type="text">
                                <label for="cepInput">CEP *</label>
                            </div>

                            <div class="col s12 m2">
                                <label for="ufInput">UF *</label>
                                <select id="ufInput" name="uf_id" class="browser-default uf"
                                        onchange="setUf(this.value)">
                                    <option value="">--</option>
                                    @foreach($ufs as $uf)
                                        @if((old('uf_id') && old('uf_id') == $uf->id))
                                            <option value="{{$uf->id}}" selected>
                                                {{$uf->sigla}}
                                            </option>
                                        @else
                                            <option value="{{$uf->id}}">
                                                {{$uf->sigla}}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col s12 m6">
                                <label for="municipioInput">Munic&iacute;pio *</label>
                                <select id="municipioInput" name="municipio_id" class="browser-default municipio">
                                    <option value="">--</option>
                                </select>
                            </div>

                        </div>

                        <div class="row">

                            <div class="input-field col s12 m8">
                                <input id="logradouroInput" name="logradouro" class="validate logradouro"
                                       value="{{ old('logradouro') }}" maxlength="255" type="text">
                                <label for="logradouroInput" class="endereco-label">Logradouro *</label>
                            </div>

                            <div class="input-field col s12 m4">
                                <input id="numeroInput" name="numero" type="text" class="validate numero"
                                       value="{{ old('numero') }}" maxlength="16">
                                <label for="numeroInput" class="endereco-label">N&uacute;mero *</label>
                            </div>

                        </div>

                        <div class="row">

                            <div class="input-field col s12 m6">
                                <input id="bairroInput" name="bairro" type="text" class="validate bairro"
                                       value="{{ old('bairro') }}" maxlength="255">
                                <label for="bairroInput" class="endereco-label">Bairro *</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input id="complementoInput" name="complemento" type="text"
                                       class="validate complemento" value="{{ old('complemento') }}" maxlength="255">
                                <label for="complementoInput" class="endereco-label">Complemento</label>
                            </div>

                        </div>

                        <div class="row">

                            <div class="input-field col s12 offset-m3 m6">
                                <input id="emailInput" name="email" type="email" class="validate email"
                                       value="{{ old('email') }}" maxlength="255">
                                <label for="emailInput">E-mail</label>
                            </div>

                        </div>

                        <div id="information-alert" class="card card-alert card-alert-information mensagem-senha"
                             style="display: none">
                            <div class="card-content">
                                <p style="text-align: center">A senha inicial para o cliente ser&aacute; a sua data de
                                    nascimento no formato:
                                    "ddMMyy".</p>
                                <p style="text-align: center">(Exemplo: se a data de nascimento for 04/05/1990, a senha
                                    será "040590")</p>
                            </div>
                        </div>

                    </div>

                    <div class="card-action">
                        <div class="row">
                            <div class="col s12 m4 offset-m4 grid-example">
                                <button type="submit" class="btn btn-block waves-effect waves-light primary">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>


            </div>
        </div>
        <!-- End row -->

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">

        $('.email').change(function () {
            if ($(this).val())
                $('.mensagem-senha').show();
            else
                $('.mensagem-senha').hide();
        });

    </script>

    <script>
        var urlGetMunicipio = "{{ url('/municipios/:municipio') }}";
        var urlListarMunicipios = "{{ url('/ufs/:uf/municipios') }}";
        var urlConsultarCep = "{{ env('URL_CONSULTAR_CEP') }}";
    </script>

    <script src="{{ asset('js/enderecos.js') }}"></script>

@endsection