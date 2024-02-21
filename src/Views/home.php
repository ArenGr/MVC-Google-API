<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Map</title>
</head>
<body>
<img id="mapImage" src="data:image/png;base64,<?= base64_encode($this->data['img']) ?>" alt="Google Map">

<input type="text" id="autocomplete" placeholder="Enter a location">

<script>
    function fetchMapData(lat, lng) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                try {
                    document.getElementById("mapImage").src = "data:image/png;base64," + this.responseText;
                } catch (error) {
                    console.log(error)
                }
            }
        };

        xhttp.open("GET", "http://localhost:8000/map/?lat=" + lat + "&lng=" + lng, true);
        xhttp.send();
    }

    function initAutocomplete() {
        var input = document.getElementById('autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();

            if (!place.geometry || !place.geometry.location) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            console.log()

            fetchMapData(lat, lng);
        })


        // input.addEventListener("keydown", function(event) {
        //     if (event.key === "Enter") {
        //         // var place = autocomplete.getPlace();
        //         // if (place.geometry) {
        //         //     var lat = place.geometry.location.lat();
        //         //     var lng = place.geometry.location.lng();
        //             fetchMapData(lat, lng);
        //         }
        //     }
        // )
    }

    function loadMapScript() {
        var script = document.createElement("script");
        script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCXyqIwIDS9w_6r5zqQErhSGNSpQ1TbNXM&libraries=places&callback=initAutocomplete";
        document.body.appendChild(script);
    }

    window.onload = loadMapScript;
</script>
</body>
</html>

