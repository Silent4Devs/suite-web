@extends('layouts.admin')
@section('content')
    <style>
        #map {
            height: 500px;
            width: 100%;
        }

    </style>

    <div class="mt-4 card py-2">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Ubicación: </strong> Sedes</h3>
        </div>

        <div class="card-body">

            <form class="form-inline py-3" id="tracer-form">
                <div class="form-group mr-4">
                    <a type="button" class="btn btn-success margin-right: 1rem; shadow" data-toggle="tooltip"
                        data-placement="top" title="Pulse este botón para obtener su dirección actual"
                        onclick="getCurrentPosition()">
                        <i class="fas fa-map-marker-alt"></i> Ubicación actual
                    </a>
                </div>
                <div class="form-group mr-4">
                    <input type="text" class="form-control shadow-sm input-lg" id="origin" placeholder="Ingrese un origen"
                        required>
                </div>
                <button id="submit" class="btn btn-success shadow" value="Calcular">Buscar</button>
            </form>

            <div id="map" class="shadow"></div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function(e) {
            let form = document.querySelector("#tracer-form");
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                var origin = $('#origin').val();
                var destination = sede.direccion;
                var travel_mode = "DRIVING";
                //var travel_mode = $('#travel_mode').val();
                var directionsDisplay = new google.maps.DirectionsRenderer({
                    'draggable': false
                });
                var directionsService = new google.maps.DirectionsService();
                console.log("origen:" + origin, "destino:" + sede.direccion);
                displayRoute(travel_mode, origin, destination, directionsService,
                    directionsDisplay);
                calculateDistance(travel_mode, origin, destination);
            })
        });

        var sede = {!! json_encode($sede->toArray(), JSON_HEX_TAG) !!};
        var origin, destination, map;

        console.log(sede);

        function initMap() {
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

            //info
            const detailWindow = new google.maps.InfoWindow({
                content: '<p>' + sede.sede + '</p>'
            });

            marker.addListener("mouseover", () => {
                detailWindow.open(map, marker);
            })

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
                console.log(responses);
                if (responses && responses.length > 0) {
                    $("#origin").val(responses[1].formatted_address);
                    //    console.log(responses[1].formatted_address);
                } else {
                    alert("No podemos encontrar tu ubicación.")
                }
            });
        }

        function displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay) {
            console.log("entro");
            directionsService.route({
                origin: origin,
                destination: destination,
                travelMode: travel_mode,
                avoidTolls: true
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setMap(map);
                    directionsDisplay.setDirections(response);
                    console.log(map);
                } else {
                    console.log("NO");
                    directionsDisplay.setMap(null);
                    directionsDisplay.setDirections(null);
                    alert('Could not display directions due to: ' + status);
                }
            });

        }

        function calculateDistance(travel_mode, origin, destination) {
            var DistanceMatrixService = new google.maps.DistanceMatrixService();
            DistanceMatrixService.getDistanceMatrix({
                origins: [origin],
                destinations: [destination],
                travelMode: google.maps.TravelMode[travel_mode],
                unitSystem: google.maps.UnitSystem.IMPERIAL, // miles and feet.
                // unitSystem: google.maps.UnitSystem.metric, // kilometers and meters.
                avoidHighways: false,
                avoidTolls: false
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDByWqsyGQopJ8tnvFk8yp4PjcfG7zoXuo&callback=initMap"
        async>
    </script>

@endsection
