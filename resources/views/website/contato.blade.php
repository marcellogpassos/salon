<div class="brown lighten-5">

    <div id="contato" class="container scrollspy">
        <div class="section">

            <div class="row">

                <div class="row section-title">
                    <div class="col s12">
                        <h1 class="center">COMO NOS ENCONTRAR?</h1>
                        <hr>
                    </div>
                </div>
                <!-- End section title -->

                <div class="row section-body">
                    <div class="col s12">

                        <div class="row">

                            <div class="col s12 m5">

                                <hr>

                                <div class="item-contato">
                                    <div class="key">
                                        <h2>Endere&ccedil;o</h2>
                                    </div>
                                    <div class="value">
                                        <p class="light">Av. Epitácio Pessoa, 1234. Bairro dos Estados</p>
                                        <p class="light">58030-001. João Pessoa - PB. Sala 1000.</p>
                                    </div>
                                </div>

                                <hr>

                                <div class="item-contato">
                                    <div class="key">
                                        <h2>Telefones</h2>
                                    </div>
                                    <div class="value">
                                        <ul>
                                            <li class="light">(83) 98765-4321</li>
                                            <li class="light">(83) 3219-8765</li>
                                        </ul>
                                    </div>
                                </div>

                                <hr>

                                <div class="item-contato">
                                    <div class="key">
                                        <h2>E-mail</h2>
                                    </div>
                                    <div class="value">
                                        <p class="light">contato@makp.com.br</p>
                                    </div>
                                </div>

                                <hr>

                                {{--<div class="item-contato">--}}
                                    {{--<div class="key">--}}
                                        {{--<h2>Redes Sociais</h2>--}}
                                    {{--</div>--}}
                                    {{--<div class="value">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col s6 m2 center">--}}
                                                {{--<a href="//www.facebook.com" target="_blank">--}}
                                                    {{--<i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i>--}}
                                                {{--</a>--}}
                                            {{--</div>--}}
                                            {{--<div class="col s6 m2 center">--}}
                                                {{--<a href="//www.instagram.com" target="_blank">--}}
                                                    {{--<i class="fa fa-instagram fa-2x" aria-hidden="true"></i>--}}
                                                {{--</a>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <div class="item-contato">
                                    <div class="key">
                                        <h2>Hor&aacute;rios de Funcionamento</h2>
                                    </div>
                                    <div class="value">
                                        <ul>
                                            <li class="light"><strong>Segunda a sexta-feira:</strong> 8:00 - 12:00 /
                                                14:00 - 18:00
                                            </li>
                                            <li class="light"><strong>S&aacute;bado:</strong> 10:00 - 14:00</li>
                                        </ul>
                                    </div>
                                </div>

                                <hr>

                            </div>

                            <div class="col s12 m7">
                                <div id="map" class="card"></div>
                                <script type="text/javascript">

                                    var map;
                                    function initMap() {

                                        var myLatLng = {lat: -7.1195404, lng: -34.8480169};

                                        var map = new google.maps.Map(document.getElementById('map'), {
                                            zoom: 16,
                                            center: myLatLng
                                        });

                                        var marker = new google.maps.Marker({
                                            position: myLatLng,
                                            map: map,
                                            title: 'Nossa localização'
                                        });

                                    }

                                </script>
                                <script async defer
                                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0OIJmXg-BWg6nPJKmXJvghK3pbOD7aYc&callback=initMap">
                                </script>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- End section body -->

            </div>

        </div>
    </div>

</div>