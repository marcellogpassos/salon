<div id="equipe" class="container scrollspy">
    <div class="section">

        <div class="row section-title">
            <div class="col s12">
                <h1 class="center">CONHE&Ccedil;A NOSSO TIME DE PROFISSIONAIS</h1>
                <hr>
            </div>
        </div>
        <!-- End section title -->

        <div class="row section-body sf sf-six">
            <div class="col s12">

                <div class="row">

                    @foreach($equipe as $profissional)

                        <div class="col s12 m3 profissional">

                            @include('website.profissional', [
                                'nome' => $profissional->name,
                                'foto' => $profissional->foto,
                                'curriculo' => $profissional->curriculo])

                        </div>

                    @endforeach

                </div>

            </div>
        </div>
        <!-- End section body -->

    {{--<div class="row section-footer">--}}
    {{--<div class="col s12">--}}

    {{--</div>--}}
    {{--</div>--}}
    <!-- End section footer -->

    </div>
</div>