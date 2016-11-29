@extends('layouts.appm')

@section('title')
    Agendamentos
@endsection

@section('content')

    <div class="container container-lg">

        @include('layouts.messages')

        <div class="row">

            <div class="col m8 s12">
                <div class="card white">

                    <h4 class="card-title">Novo Agendamento</h4>

                    <div class="card-content gray-text text-darken-4">
                        <div class="row">
                            <div class="col s12">

                                <div class="row">

                                    <div class="input-field col s12 offset-m2 m4">
                                        <i class="material-icons prefix">date_range</i>
                                        <input id="dataInput" name="data" class="data data-futura" required type="text">
                                        <label for="dataInput">Data *</label>
                                    </div>

                                    <div class="input-field col s12 m4">
                                        <i class="material-icons prefix">access_time</i>
                                        <input id="horaInput" name="hora" class="hora" required type="text">
                                        <label for="horaInput">Hora *</label>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="input-field col s12 offset-m2 m4">
                                        <input id="tipoServicoInput" name="tipo_servico" required type="text">
                                        <label for="tipoServicoInput">Tipo de Servi&ccedil;o *</label>
                                    </div>

                                    <div class="input-field col s12 m4">
                                        <input id="servicoInput" name="servico" required type="text">
                                        <label for="servicoInput">Servi&ccedil;o *</label>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="input-field col s12 offset-m2 m8">
                                        <input id="profissionalInput" name="profissional" required type="text">
                                        <label for="profissionalInput">Profissional *</label>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-action">
                        <div class="row">
                            <div class="col s12 m4 offset-m4 grid-example">

                                <button type="submit" class="btn btn-block waves-effect waves-light primary">
                                    Agendar
                                </button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col m4 s12">
                <div class="card white">

                    <h4 class="card-title">Agendamentos Futuros</h4>

                    <div class="card-content gray-text text-darken-4">
                        <div class="row">
                            <div class="col s12">

                            </div>
                        </div>
                    </div>

                    <div class="card-action">
                        <div class="row">
                            <div class="col s12">

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection