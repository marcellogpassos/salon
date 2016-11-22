@extends('layouts.appm')

@section('title')
    Dados do usu&aacute;rio
@endsection

@section('styles')
    <link href="{{ asset('lib/dropify/css/dropify.min.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection"/>
@endsection

@section('content')
    <div class="container">

        @include('layouts.messages')

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Dados do usu&aacute;rio</h4>

                    <form id="userForm" class="form-horizontal" method="POST" action="{{ url('/users/dados') }}"
                          role="form">
                        {{ csrf_field() }}

                        <div class="card-content gray-text text-darken-4">

                            <div class="row">

                                <div class="input-field col s12 m4">
                                    <input id="nameInput" name="name" type="text" required maxlength="255"
                                           class="validate" value="{{ old('name') ? old('name') : $user->name }}">
                                    <label for="nameInput">Nome *</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <input id="surnameInput" name="surname" type="text" required maxlength="255"
                                           class="validate"
                                           value="{{ old('surname') ? old('surname') : $user->surname }}">
                                    <label for="surnameInput">Sobrenome *</label>
                                </div>

                                <div class="input-field horizontal-radio col s12 m4">
                                    <div>
                                        <spam>
                                            <input name="sexo" type="radio" id="femininoInput" value="F"
                                                    {!! ($user->sexo == 'F') ? ' checked' : '' !!}>
                                            <label for="femininoInput">Feminino</label>
                                        </spam>
                                        <spam>
                                            <input name="sexo" type="radio" id="masculinoInput" value="M"
                                                    {!! ($user->sexo == 'M') ? ' checked' : '' !!}>
                                            <label for="masculinoInput">Masculino</label>
                                        </spam>
                                    </div>
                                    <label class="active">Sexo *</label>
                                </div>

                            </div>

                            <div class="row">

                                <div class="input-field col s12 m4">
                                    <input id="cpfInput" name="cpf" type="text" class="validate cpf" required
                                           value="{{ old('cpf') ? old('cpf') : $user->cpf }}">
                                    <label for="cpfInput">CPF *</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <i class="material-icons prefix">date_range</i>
                                    <input id="nascimentoInput" name="data_nascimento" class="data" required
                                           value="{{ $user->data_nascimento ? dateToBrFormat($user->data_nascimento) : '' }}"
                                           type="text">
                                    <label for="nascimentoInput">Data de nascimento *</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="telefoneInput" name="telefone" type="text" class="validate telefone"
                                           value="{{ old('telefone') ? old('telefone') : $user->telefone }}">
                                    <label for="telefoneInput">Telefone</label>
                                </div>

                            </div>

                            <div class="row">

                                <div class="input-field col s12 m4">
                                    <i class="material-icons prefix">location_on</i>
                                    <input id="cepInput" name="cep" type="text" class="cep" required
                                           value="{{ old('cep') ? old('cep') : $user->cep }}"
                                           onchange="setCep(this.value, '#userForm')">
                                    <label for="cepInput">CEP *</label>
                                </div>

                                <div class="col s12 m2">
                                    <label for="ufInput">UF *</label>
                                    <select id="ufInput" name="uf_id" class="browser-default uf" required
                                            onchange="setUf(this.value, null, '#userForm')">
                                        <option value=""></option>
                                        @foreach($ufs as $uf)
                                            <option value="{{$uf->if}}">{{$uf->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col s12 m6">
                                    <label for="municipioInput">Munic&iacute;pio *</label>
                                    <select id="municipioInput" name="municipio" class="browser-default municipio"
                                            required>
                                        <option value=""></option>
                                    </select>
                                </div>

                            </div>

                            <div class="row">

                                <div class="input-field col s12 m8">
                                    <input id="logradouroInput" name="logradouro" type="text"
                                           class="validate logradouro"
                                           value="{{ old('logradouro') ? old('logradouro') : $user->logradouro }}"
                                           maxlength="255" required>
                                    <label for="logradouroInput">Logradouro *</label>
                                </div>

                                <div class="input-field col s12 m4">
                                    <input id="numeroInput" name="numero" type="text" class="validate numero"
                                           value="{{ old('numero') ? old('numero') : $user->numero }}"
                                           maxlength="16" required>
                                    <label for="numeroInput">N&uacute;mero *</label>
                                </div>

                            </div>

                            <div class="row">

                                <div class="input-field col s12 m6">
                                    <input id="bairroInput" name="bairro" type="text" class="validate bairro"
                                           value="{{ old('bairro') ? old('bairro') : $user->bairro }}"
                                           maxlength="255" required>
                                    <label for="bairroInput">Bairro *</label>
                                </div>

                                <div class="input-field col s12 m6">
                                    <input id="complementoInput" name="complemento" type="text"
                                           class="validate complemento"
                                           value="{{ old('complemento') ? old('complemento') : $user->complemento }}"
                                           maxlength="255">
                                    <label for="complementoInput">Complemento</label>
                                </div>

                            </div>

                            <div class="row">
                                <div class="input-field col offset-m3 m6 s12">
                                    <div class="card white">
                                        <h4 class="card-title">Foto do usu&aacute;rio</h4>

                                        <div class="card-content gray-text text-darken-4">

                                            <input type="file" name="foto" class="dropify" data-max-file-size="2M"/>

                                        </div>
                                    </div>
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
                        <!-- End card action -->

                    </form>

                </div>
                <!-- End card -->

            </div>
        </div>
        <!-- End row -->

    </div>

@endsection

@section('scripts')

    @include('layouts.angular')
    <script>
        var urlGetMunicipio = "{{ url('/ufs/:uf/municipios/:municipio') }}";
        var urlListarMunicipios = "{{ url('/ufs/:uf/municipios') }}";
    </script>
    <script src="{{ asset('js/enderecos.js') }}"></script>

    <script>
        $(document).ready(function () {
            setUf(
                    '{{ old('uf') ? old('uf') : $user->uf }}',
                    '{{ old('municipio') ? old('municipio') : $user->municipio }}',
                    '#userForm'
            );
        });
    </script>

    <script src="{{ asset('lib/dropify/js/dropify.min.js') }}"></script>

@endsection