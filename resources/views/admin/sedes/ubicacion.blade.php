@extends('layouts.admin')
@section('content')
    <style>
        #map {
            height: 500px;
            width: 100%;
        }

    </style>
    <h5 class="col-12 titulo_general_funcion">Cómo llegar a&nbsp;{{$sede->sede}}</h5>
    <div class="py-2 mt-4 card">
        <div class="card-body">
                {{-- <h4 class="mb-1 text-center "><strong> Cómo llegar: </strong>{{ $sede->sede }}</h4> --}}


            <form class="py-3 form-inline" id="tracer-form">

                <div class="flex-row d-flex">
                    <div class="row col-4">
                        <div class="form-group col-9">
                            <label>Origen</label>
                            <input type="text" class="shadow-sm form-control input-lg" id="origin"
                                placeholder="Ingrese un origen" required>
                        </div>
                        {{-- <div class="mr-4 form-group col-3">
                            <div>{{ $sede->sede }}</div>
                        </div> --}}
                        <div style="margin-left:-10px;"class="form-group col-3">
                            <label>&nbsp;</label>
                            <a type="button" class="shadow btn btn-success" data-toggle="tooltip"
                                data-placement="top" title="Pulse este botón para obtener su dirección actual"
                                onclick="getCurrentPosition()">
                                <i class="fas fa-map-marker-alt"></i>
                            </a>
                        </div>

                    </div>

                    <div class="form-group col-3">
                        <label>Destino</label>
                         <div style="width:100%;" class="form-control">{{$sede->sede}}</div>
                    </div>

                    <div class="form-group col-3">
                        <label>Medio de transporte</label>
                        <select class="form-control" id="travel_mode" name="travel_mode" required>
                            <option value="">Seleccione su tipo de viaje</option>
                            <option value="DRIVING">Auto</option>
                            <option value="WALKING">Caminando</option>
                            <option value="BICYCLING">Bicicleta</option>
                            <option value="TRANSIT">Transporte público</option>
                        </select>
                    </div>

                    <div class="form-group col-2">
                         <button id="submit" class="mt-4 shadow btn btn-success" value="Calcular">Ver ruta</button>
                    </div>
                </div>
            </form>

            <table class="table">
                <tbody>
                    <tr>
                        <th id="in_kilo" scope="row"></th>
                        <td id="duration_text"></td>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div id="map" class="shadow"></div>

        </div>

    </div>

    <div class="flex-row-reverse d-flex">
        <a href="javascript:window.open('','_self').close();" class="shadow btn btn-success align">Salir</a>
    </div>
    <br><br>

    <script>
        document.addEventListener('DOMContentLoaded', function(e) {
            let form = document.querySelector("#tracer-form");
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                var origin = $('#origin').val();
                var destination = sede.direccion;
                var travel_mode = $('#travel_mode').val();
                var directionsDisplay = new google.maps.DirectionsRenderer({
                    'draggable': false
                });
                var directionsService = new google.maps.DirectionsService();
                var coord = {
                    lat: sede.latitude,
                    lng: sede.longitud
                };
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 18,
                    center: coord
                });
                var marker = new google.maps.Marker({
                    position: coord,
                    map: map,
                    //icon: "https://e7.pngegg.com/pngimages/279/307/png-clipart-location-duke-university-logo-computer-icons-map-map-marker-miscellaneous-blue.png",
                });
                displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay, map);
                calculateDistance(travel_mode, origin, destination);
            })
        });

        var sede = {!! json_encode($sede->toArray(), JSON_HEX_TAG) !!};
        var origin, destination, map;

        function initMap() {
            var coord = {
                lat: parseFloat(sede.latitude),
                lng: parseFloat(sede.longitud)
            };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 18,
                center: coord
            });
            var marker = new google.maps.Marker({
                position: coord,
                map: map,
                //icon: "https://e7.pngegg.com/pngimages/279/307/png-clipart-location-duke-university-logo-computer-icons-map-map-marker-miscellaneous-blue.png",
            });

            //info sobre lugar
            const detailWindow = new google.maps.InfoWindow({
                content: '<p>' + sede.sede + '</p>'
            });

            marker.addListener("mouseover", () => {
                detailWindow.open(map, marker);
            })
            //info sobre lugar

        };

        // get current Position
        function getCurrentPosition() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(CurrentPosition);
            } else {
                alert("Tu navegador no soporta esta funcionalidad.")
            }
        }

        // get formated addres and pass to input
        function CurrentPosition(pos) {
            var geocoder = new google.maps.Geocoder();
            var latlng = {
                lat: parseFloat(pos.coords.latitude),
                lng: parseFloat(pos.coords.longitude)
            };
            geocoder.geocode({
                'location': latlng
            }, function(responses) {
                if (responses && responses.length > 0) {
                    $("#origin").val(responses[1].formatted_address);
                    //    console.log(responses[1].formatted_address);
                } else {
                    alert("No podemos encontrar tu ubicación.")
                }
            });
        }

        function displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay, map) {
            directionsService.route({
                origin: origin,
                destination: destination,
                travelMode: travel_mode,
                avoidTolls: true
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setMap(map);
                    directionsDisplay.setDirections(response);
                } else {
                    console.log("NO");
                    directionsDisplay.setMap(null);
                    directionsDisplay.setDirections(null);
                    alert('No es posible desplegar la ruta: ' + status);
                }
            });

        }

        // shows html results
        function appendResults(distance_in_kilo, duration_text) {
            $('#in_kilo').html("Distancia en kilometros:  <span class='badge badge-pill badge-secondary'>" +
                distance_in_kilo
                .toFixed(2) + "</span>");
            $('#duration_text').html("Tiempo de trayecto:  <span class='badge badge-pill badge-success'>" + duration_text +
                "</span>");
        }

        function calculateDistance(travel_mode, origin, destination) {
            var DistanceMatrixService = new google.maps.DistanceMatrixService();
            DistanceMatrixService.getDistanceMatrix({
                origins: [origin],
                destinations: [destination],
                travelMode: google.maps.TravelMode[travel_mode],
                unitSystem: google.maps.UnitSystem.metric,
                avoidHighways: false,
                avoidTolls: false
            }, show_results);
        }

        function show_results(response, status) {
            if (status != google.maps.DistanceMatrixStatus.OK) {
                $('#result').html(err);
            } else {
                var origin = response.originAddresses[0];
                var destination = response.destinationAddresses[0];
                if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
                    $('#result').html("Sorry , not available to use this travel mode between " + origin + " and " +
                        destination);
                } else {
                    var distance = response.rows[0].elements[0].distance;
                    var duration = response.rows[0].elements[0].duration;
                    var distance_in_kilo = distance.value / 1000; // the kilo meter
                    var duration_text = duration.text;
                    appendResults(distance_in_kilo, duration_text);
                }
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMtPStAiDXhsaYws3HhCAqwHa2UbsPIPE&callback=initMap"
        async>
    </script>

@endsection
