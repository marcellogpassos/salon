<div class="brown lighten-5">

    <div id="inscreva" class="container scrollspy">
        <div class="section">

            <div class="row section-title">
                <div class="col s12">
                    <h1 class="center">INSCREVA-SE AGORA E RECEBA NOT&Iacute;CIAS E PROMO&Ccedil;&Otilde;ES</h1>
                    <hr>
                </div>
            </div>
            <!-- End section title -->

            <div class="row section-body">

                <form role="form" class="col s12 m8 offset-m2" action="{{ url('/inscreva') }}" method="get">
                    <div class="row">
                        <div class="input-field col s12 m8">
                            <input id="email" type="email" class="validate" name="email">
                            <label for="email" data-error="Email deve estar no formato 'nome@email.com'">E-mail</label>
                        </div>
                        <div class="input-field col s12 m4">
                            <button type="submit" class="btn btn-block call-to-action">Enviar</button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- End section body -->

        </div>
    </div>

</div>
