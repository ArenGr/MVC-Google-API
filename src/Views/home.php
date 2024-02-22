<?php require_once 'layout/header.php'?>


<?php var_dump($this->data);?>
<button type="button" class="btn btn-primary">Primary</button>
<div class>hello</div>
<img id="mapImage" src="data:image/png;base64,<?= base64_encode($this->data['img']) ?>" alt="Google Map">

<input type="text" id="autocomplete" placeholder="Enter a location">

<script>

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

            fetchMapByCoordinates(lat, lng);
            postMapData(place.address_components);
        })
    }


    function fetchMapByCoordinates(lat, lng) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                try {
                    document.getElementById("mapImage").src = "data:image/png;base64," + this.responseText;
                    // postMapData("hello");
                } catch (error) {
                    console.log(error)
                }
            }
        };

        xhttp.open("GET", "http://localhost:8000/map/?lat=" + lat + "&lng=" + lng, true);
        xhttp.send();
    }

    function postMapData(data) {

        expectedTypes = ['street_number', 'route', 'sublocality_level_1', 'locality', 'administrative_area_level_1', 'country'];
        res = data.reduce((acc, item) => {
            if (expectedTypes.includes(item['types'][0])) {
                acc[item['types'][0]] = item['long_name'];
            }
            return acc;
        }, {});

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    try {
                        // document.getElementById("mapImage").src = "data:image/png;base64," + this.responseText;
                        console.log('workssssssssss')
                    } catch (error) {
                        console.log(error);
                    }
                } else {
                    console.error("Request failed with status: " + this.status);
                }
            }
        };

        res = JSON.stringify(res)
        xhttp.open("POST", "http://localhost:8000/requests/store", true);
        // xhttp.setRequestHeader(contentType: application/x-www-form-urlencoded);
        xhttp.send(res);
    }


    function loadMapScript() {
        var script = document.createElement("script");
        script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCXyqIwIDS9w_6r5zqQErhSGNSpQ1TbNXM&libraries=places&callback=initAutocomplete";
        document.body.appendChild(script);
    }

    window.onload = loadMapScript;
</script>
<?php require_once 'layout/footer.php'?>


