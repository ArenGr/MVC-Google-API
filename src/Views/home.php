<div>Hello from home view</div>
<!--<img src="--><?php //echo $this->data ?><!--">-->
<!--<img src="https://maps.googleapis.com/maps/api/staticmap?center=40.7128,-74.0060&zoom=12&size=600x400&key=AIzaSyCXyqIwIDS9w_6r5zqQErhSGNSpQ1TbNXM" alt="Google Map">-->

<img src="data:image/png;base64,<?= base64_encode($this->data['img']) ?>" alt="Google Map">







<input type="text" id="autocomplete" placeholder="Enter a location">
<div id="coordinates"></div>

<script>
    function initAutocomplete() {
        var input = document.getElementById('autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                console.log("Place not found");
                return;
            }

            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();

            var xhttp = new XMLHttpRequest();
            // xhttp.onreadystatechange = function() {
            //     if (this.readyState == 4 && this.status == 200) {
            //         // document.getElementById("map").innerHTML = this.responseText;
            //     }
            // };

            xhttp.open("GET", "http://localhost:8000/?lat=" + lat + "&lng=" + lng, true);
            xhttp.send();
            // xhttp.open("http://localhost:8000/", "?lat=" + lat + "&lng=" + lng, true);
            // xhttp.send();

        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXyqIwIDS9w_6r5zqQErhSGNSpQ1TbNXM&libraries=places&callback=initAutocomplete" async defer></script>
