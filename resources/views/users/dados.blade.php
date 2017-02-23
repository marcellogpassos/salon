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

        @if(!$user->dados_atualizados)

            <div id="warning-alert" class="card card-alert card-alert-warning">
                <div class="card-content">
                    <a href="#!" class="close" data-dismiss="#warning-alert">&times;</a>
                    <p>{{ getMessage('warning', 0) }}</p>
                </div>
            </div>

        @endif

        <div class="row">
            <div class="col s12">

                <div class="card white">

                    <h4 class="card-title">Dados do usu&aacute;rio</h4>

                    {!! Form::open(
                        array(
                            'id' => 'userForm',
                            'url' => '/users/dados',
                            'method' => 'POST',
                            'class' => 'form-horizontal',
                            'files'=>true
                        )
                    ) !!}

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
                                <i class="material-icons prefix">date_range</i>
                                <input id="nascimentoInput" name="data_nascimento" class="data data-passada" required
                                       value="{{ $user->data_nascimento ? dateToBrFormat($user->data_nascimento) : '' }}"
                                       type="text">
                                <label for="nascimentoInput">Data de nascimento *</label>
                            </div>

                            <div class="input-field col s12 m4">
                                <i class="material-icons prefix">phone</i>
                                <input id="telefoneInput" name="telefone" type="text" class="validate telefone"
                                       value="{{ old('telefone') ? old('telefone') : $user->telefone }}" required>
                                <label for="telefoneInput">Telefone *</label>
                            </div>

                            <div class="input-field col s12 m4">
                                <input id="cpfInput" name="cpf" type="text" class="validate cpf"
                                       value="{{ old('cpf') ? old('cpf') : $user->cpf }}">
                                <label for="cpfInput">CPF</label>
                            </div>

                        </div>

                        <div class="row">

                            <div class="input-field col s12 m4">
                                <i class="material-icons prefix">location_on</i>
                                <input id="cepInput" name="cep" type="text" class="cep" required
                                       value="{{ old('cep') ? old('cep') : $user->cep }}"
                                       onchange="setCep(this.value)">
                                <label for="cepInput">CEP *</label>
                            </div>

                            <div class="col s12 m2">
                                <label for="ufInput">UF *</label>
                                <select id="ufInput" name="uf_id" class="browser-default uf" required
                                        onchange="setUf(this.value)">
                                    <option value="">--</option>
                                    @foreach($ufs as $uf)
                                        @if((old('uf_id') && old('uf_id') == $uf->id) || (isset($user->municipio) && $user->municipio->uf_id == $uf->id))
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
                                <select id="municipioInput" name="municipio_id" class="browser-default municipio"
                                        required>
                                    <option value="">--</option>
                                    @if($municipios)
                                        @foreach($municipios as $municipio)
                                            @if((old('municipio_id') && old('municipio_id') == $municipio->id) || (isset($user->municipio) && $user->municipio->id == $municipio->id))
                                                <option value="{{$municipio->id}}" selected>
                                                    {{$municipio->nome}}
                                                </option>
                                            @else
                                                <option value="{{$municipio->id}}">
                                                    {{$municipio->nome}}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>

                        <div class="row">

                            <div class="input-field col s12 m8">
                                <input id="logradouroInput" name="logradouro" type="text"
                                       class="validate logradouro"
                                       value="{{ old('logradouro') ? old('logradouro') : $user->logradouro }}"
                                       maxlength="255" required>
                                <label for="logradouroInput" class="endereco-label">Logradouro *</label>
                            </div>

                            <div class="input-field col s12 m4">
                                <input id="numeroInput" name="numero" type="text" class="validate numero"
                                       value="{{ old('numero') ? old('numero') : $user->numero }}"
                                       maxlength="16" required>
                                <label for="numeroInput" class="endereco-label">N&uacute;mero *</label>
                            </div>

                        </div>

                        <div class="row">

                            <div class="input-field col s12 m6">
                                <input id="bairroInput" name="bairro" type="text" class="validate bairro"
                                       value="{{ old('bairro') ? old('bairro') : $user->bairro }}"
                                       maxlength="255" required>
                                <label for="bairroInput" class="endereco-label">Bairro *</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <input id="complementoInput" name="complemento" type="text"
                                       class="validate complemento"
                                       value="{{ old('complemento') ? old('complemento') : $user->complemento }}"
                                       maxlength="255">
                                <label for="complementoInput" class="endereco-label">Complemento</label>
                            </div>

                        </div>

                        <div class="row">
                            <div class="input-field col offset-m3 m6 s12">
                                <div class="card white">
                                    <h4 class="card-title">Foto do usu&aacute;rio</h4>

                                    <div class="card-content gray-text text-darken-4">

                                        @if($user->foto)
                                            <input data-default-file="{{ url( $user->foto ) }}" type="file" name="foto"
                                                   data-max-file-size="2M" value="{{ url( $user->foto ) }}"
                                                   class="dropify"/>
                                        @else
                                            <input type="file" name="foto" class="dropify" data-max-file-size="2M"/>
                                        @endif

                                        <input id="fotoApagadaInput" type="hidden" name="foto_apagada" value="0">

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

                    {!! Form::close() !!}

                </div>
                <!-- End card -->

            </div>
        </div>
        <!-- End row -->

    </div>

@endsection

@section('scripts')

    <script>
        var urlGetMunicipio = "{{ url('/municipios/:municipio') }}";
        var urlListarMunicipios = "{{ url('/ufs/:uf/municipios') }}";
        var urlConsultarCep = "{{ env('URL_CONSULTAR_CEP') }}";
    </script>

    <script src="{{ asset('js/enderecos.js') }}"></script>

    <script src="{{ asset('lib/dropify/js/dropify.min.js') }}"></script>

    <script type="text/javascript">
        $('.dropify-clear').click(function () {
            $('#fotoApagadaInput').val('1');
        });
    </script>

@endsection