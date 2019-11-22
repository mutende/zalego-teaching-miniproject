<?php
 include "header.php";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Navigation
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Directions</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <h3 class="subtitle">Directions</h3>
    <div id="map">
</section>
<script>

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: { lat: -0.7722678, lng: 35.8133867 }
        });

        var directionsService = new google.maps.DirectionsService();
        var directionsRenderer = new google.maps.DirectionsRenderer();

        directionsRenderer.setMap(map);

        if ("geolocation" in navigator) {

            // check if geolocation is supported/enabled on current browser
            navigator.geolocation.getCurrentPosition(
                function success(position) {
                    // for when getting location is a success
                    calculateAndDisplayRoute(directionsService, directionsRenderer, position.coords);
                },
                function error(error_message) {
                    // for when getting location results in an error
                    console.error('An error has occured while retrieving location', error_message)
                }
            );
        } else {
            // geolocation is not supported
            // get your location some other way
            console.log('geolocation is not enabled on this browser')
        }
    }

    function calculateAndDisplayRoute(directionsService, directionsRenderer, start) {
        directionsService.route(
            {
                origin: `${start.latitude},${start.longitude}`,
                destination: { query: "Zalego Institute, Devan Plaza,6th Floor, Crossway, Nairobi City" },
                travelMode: 'DRIVING'
            },
            function (response, status) {
                if (status === 'OK') {
                    directionsRenderer.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
    }

</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg6Vg_U__rTNqHfXsZcQRNlOfTly8iN6g&callback=initMap">
    </script>
<?php
 include "footer.php";
?>
