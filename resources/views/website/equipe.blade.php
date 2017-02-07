<div id="equipe" class="container scrollspy">
    <div class="section">

        <div class="row section-title">
            <div class="col s12">
                <h1 class="center">CONHE&Ccedil;A NOSSO TIME DE PROFISSIONAIS</h1>
                <hr>
            </div>
        </div>
        <!-- End section title -->

        <div class="row section-body">
            <div class="col s12">

                <div class="row">

                    <div class="col s12 m3 profissional">

                        @include('website.profissional', [
                            'nome' => 'José Antônio', 'foto' => 'img/index/equipe/profissional1.png',
                            'curriculo' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In molestie enim eget
                             vehicula aliquam. Mauris pretium leo non lorem pellentesque, id tempor tellus eleifend.'])

                    </div>
                    <!-- End Profissional 1 -->

                    <div class="col s12 m3 profissional">

                        @include('website.profissional', [
                            'nome' => 'Maria José', 'foto' => 'img/index/equipe/profissional2.png',
                            'curriculo' => 'Mauris a ultricies lacus, ultrices vestibulum mi. Donec vitae quam
                            consectetur, iaculis augue a, sodales massa. Donec dapibus est quis tortor pulvinar, ac
                             auctor sem tristique.'])

                    </div>
                    <!-- End Profissional 2 -->

                    <div class="col s12 m3 profissional">

                        @include('website.profissional', [
                            'nome' => 'João Paulo', 'foto' => 'img/index/equipe/profissional3.png',
                            'curriculo' => 'Sed volutpat, risus et convallis viverra, metus erat accumsan tortor, ut
                             imperdiet sapien magna ac ex. Suspendisse vitae lobortis augue, eu ullamcorper eros. Ut eu
                              mi est.'])

                    </div>
                    <!-- End Profissional 3 -->

                    <div class="col s12 m3 profissional">

                        @include('website.profissional', [
                            'nome' => 'Ana Luíza', 'foto' => 'img/index/equipe/profissional4.png',
                            'curriculo' => 'Curabitur nibh ipsum, posuere vel porttitor eget, cursus vitae leo.
                             Phasellus euismod leo et ligula rhoncus pretium. Nam pharetra maximus dapibus.'])

                    </div>
                    <!-- End Profissional 4 -->
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