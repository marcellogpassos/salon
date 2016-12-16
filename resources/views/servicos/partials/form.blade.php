<div class="card-content gray-text text-darken-4">

    <div class="row">

        <div class="input-field col s12 offset-m2 m2">
            <input id="codigoInput" type="text" maxlength="16"
                   {!! isset($servico) ? ' readonly ' : ' name="id" ' !!}
                   value="{{ old('id') ? old('id') : (isset($servico->id) ? $servico->id : '') }}">
            <label for="codigoInput">C&oacute;digo</label>
        </div>

        <div class="input-field col s12 m6">
            <input id="descricaoInput" name="descricao" type="text" maxlength="255" minlength="3" class="validate"
                   value="{{ old('descricao') ? old('descricao') : (isset($servico->descricao) ? $servico->descricao : '') }}">
            <label for="descricaoInput">Descri&ccedil;&atilde;o do servi&ccedil;o *</label>
        </div>

    </div>

    <div class="row">

        <div class="col offset-m1 s12 m4">
            <label for="categoriaServicoInput" class="active">Categoria *</label>
            <select id="categoriaServicoInput" name="categoria_id" class="browser-default">
                <option value="" selected></option>

                @foreach($categoriasServicos as $categoria)
                    <option value="{{ $categoria->id }}"
                            {!! ($categoria->id == old('categoria_id') ||
                                (isset($servico->categoria_id) && $categoria->id == $servico->categoria_id)) ?
                                 ' selected' : '' !!}>
                        {{ $categoria->descricao }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col s12 m3">
            <label for="duracaoInput" class="active">Dura&ccedil;&atilde;o aproximada *</label>
            <select id="duracaoInput" name="duracao" class="browser-default" required>
                <option value="" selected></option>
                <option value="00:15:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '00:15:00') || old('duracao') == '00:15:00') ? ' selected' : '' !!}>
                    0:15
                </option>
                <option value="00:30:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '00:30:00') || old('duracao') == '00:30:00') ? ' selected' : '' !!}>
                    0:30
                </option>
                <option value="00:45:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '00:45:00') || old('duracao') == '00:45:00') ? ' selected' : '' !!}>
                    0:45
                </option>
                <option value="01:00:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '01:00:00') || old('duracao') == '01:00:00') ? ' selected' : '' !!}>
                    1:00
                </option>
                <option value="01:15:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '01:15:00') || old('duracao') == '01:15:00') ? ' selected' : '' !!}>
                    1:15
                </option>
                <option value="01:30:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '01:30:00') || old('duracao') == '01:30:00') ? ' selected' : '' !!}>
                    1:30
                </option>
                <option value="01:45:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '01:45:00') || old('duracao') == '01:45:00') ? ' selected' : '' !!}>
                    1:45
                </option>
                <option value="02:00:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '02:00:00') || old('duracao') == '02:00:00') ? ' selected' : '' !!}>
                    2:00
                </option>
                <option value="02:15:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '02:15:00') || old('duracao') == '02:15:00') ? ' selected' : '' !!}>
                    2:15
                </option>
                <option value="02:30:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '02:30:00') || old('duracao') == '02:30:00') ? ' selected' : '' !!}>
                    2:30
                </option>
                <option value="02:45:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '02:45:00') || old('duracao') == '02:45:00') ? ' selected' : '' !!}>
                    2:45
                </option>
                <option value="03:00:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '03:00:00') || old('duracao') == '03:00:00') ? ' selected' : '' !!}>
                    3:00
                </option>
                <option value="03:15:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '03:15:00') || old('duracao') == '03:15:00') ? ' selected' : '' !!}>
                    3:15
                </option>
                <option value="03:30:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '03:30:00') || old('duracao') == '03:30:00') ? ' selected' : '' !!}>
                    3:30
                </option>
                <option value="03:45:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '03:45:00') || old('duracao') == '03:45:00') ? ' selected' : '' !!}>
                    3:45
                </option>
                <option value="04:00:00"
                        {!! ((isset($servico->duracao) && $servico->duracao == '04:00:00') || old('duracao') == '04:00:00') ? ' selected' : '' !!}>
                    4:00
                </option>
            </select>
        </div>

        <div class="input-field col s12 m3">
            <i class="material-icons prefix">attach_money</i>
            <input id="valorInput" name="valor" type="text" maxlength="16" class="validate moeda"
                   value="{{ old('valor') ? old('valor') : (isset($servico->itemVenda->valor) ?
                        moneyFormat($servico->itemVenda->valor, false) : '') }}">
            <label for="valorInput">Valor (R$) *</label>
        </div>

    </div>

    <div class="row">

        <div class="input-field offset-m1 col s12 m5">
            <div class="col s5">
                <input name="masculino" type="checkbox" id="masculinoInput" value="1"
                        {!! (old('masculino') || (isset($servico->masculino) && $servico->masculino)) ? ' checked' : '' !!}>
                <label for="masculinoInput">Para homens</label>
            </div>
            <div class="col s6">
                <input name="feminino" type="checkbox" id="femininoInput" value="1"
                        {!! (old('feminino') || (isset($servico->feminino) && $servico->feminino)) ? ' checked' : '' !!}>
                <label for="femininoInput">Para mulheres</label>
            </div>
        </div>

        <div class="input-field col s12 m5">
            <div class="col s12 m6">
                <input name="ativo" type="radio" id="ativoInput" value="1"
                        {!! (old('ativo') == '1' || (isset($servico->itemVenda->ativo) && $servico->itemVenda->ativo == '1')) ?
                                  ' checked' : '' !!}>
                <label for="ativoInput">Servi&ccedil;o ativo</label>
            </div>
            <div class="col s12 m6">
                <input name="ativo" type="radio" id="inativoInput" value="0"
                        {!! (old('ativo') == '0' || (isset($servico->itemVenda->ativo) && $servico->itemVenda->ativo == '0')) ?
                                  ' checked' : '' !!}>
                <label for="inativoInput">Servi&ccedil;o inativo</label>
            </div>
        </div>

    </div>

    <div class="row funcionarios-habilitados">
        <div class="col s12 offset-m1 m10">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <div class="collapsible-header">
                        <i class="material-icons">people</i>
                        Funcion&aacute;rios habilitados
                        <i class="material-icons right">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body">
                        <div class="row">
                            <div class="col s12">
                                @foreach($funcionarios as $func)
                                    <div class="col s12 m6">
                                        <p>
                                            <input type="checkbox" name="funcionarios[]" value="{{$func->id}}"
                                                   {!! isset($servico) && funcionarioHabilitado($servico, $func) ? ' checked ' : '' !!}
                                                   id="{{'funcionario-' . $func->id}}"/>
                                            <label for="{{'funcionario-' . $func->id}}">{{$func->name . ' ' . $func->surname}}</label>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
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
