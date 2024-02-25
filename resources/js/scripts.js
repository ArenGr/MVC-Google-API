function loadMapScript() {

    var xhttp = new XMLHttpRequest();
    let input = document.getElementById('autocomplete');
    var suggestionsList = document.getElementById('suggestions');
    input.addEventListener('input', function () {
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                try {
                    suggestionsList.innerHTML = '';
                    JSON.parse(this.responseText).forEach(function (suggestion) {
                        var li = document.createElement('li');
                        li.classList.add("list-group-item");
                        li.classList.add("item");
                        li.textContent = suggestion[1];
                        li.setAttribute('data-place-id', suggestion[0]);
                        suggestionsList.appendChild(li);
                        li.addEventListener('mouseenter', function() {
                            li.style.backgroundColor = '#f0f0f0'; // Change background color on hover
                        });
                        li.addEventListener('mouseleave', function() {
                            li.style.backgroundColor = ''; // Reset background color when mouse leaves
                        });
                        li.addEventListener("click", function (e) {
                            if (e.target && e.target.matches("li.item")) {
                                input.value = e.target.textContent;
                                suggestionsList.innerHTML = '';
                                getDetails(li.getAttribute('data-place-id'));
                            }
                        });
                    });
                } catch (error) {
                    console.log(error)
                }
            }
        };
        xhttp.open("GET", "http://localhost:8000/google/maps/autocomplete/?input=" + input.value, true);
        xhttp.send();
    })
}

function getDetails(placeId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            try {
                res = JSON.parse(this.responseText);
                getImage(res['location']['lat'], res['location']['lng'])
                storeAddressDetails(res['address'])
            } catch (error) {
                console.log(error)
            }
        }
    };
    xhttp.open("GET", "http://localhost:8000/google/maps/coordinates/?placeId=" + placeId, true);
    xhttp.send();
}

function getImage(lat, lng) {
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
    xhttp.open("GET", "http://localhost:8000/google/maps/image/?lat=" + lat + "&lng=" + lng, true);
    xhttp.send();
}

function storeAddressDetails(data) {
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
                    getAddressDetails()
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
    xhttp.send(res);
}

function getAddressDetails() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            try {
                var tableBody = document.querySelector('tbody');
                var html = '';
                JSON.parse(this.responseText).forEach(function (component) {
                    html += '<tr>';
                    html += '<td>' + component['street_number'] + '</td>';
                    html += '<td>' + component['route'] + '</td>';
                    html += '<td>' + component['sublocality_level_1'] + '</td>';
                    html += '<td>' + component['locality'] + '</td>';
                    html += '<td>' + component['administrative_area_level_1'] + '</td>';
                    html += '<td>' + component['country'] + '</td>';
                    html += '<td>' + component['created_at'] + '</td>';
                    html += '</tr>';
                });
                tableBody.innerHTML = html;
            } catch (error) {
                console.log(error)
            }
        }
    };
    xhttp.open("GET", "http://localhost:8000/requests/all", true);
    xhttp.send();
}

window.onload = loadMapScript;