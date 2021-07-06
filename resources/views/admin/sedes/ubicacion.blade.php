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

            <div id="map"></div>

        </div>
    </div>

    <script>
        var sede = {!! json_encode($sede->toArray(), JSON_HEX_TAG) !!};
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
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDByWqsyGQopJ8tnvFk8yp4PjcfG7zoXuo&callback=initMap"
        async>
    </script>

@endsection
