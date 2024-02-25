<?php require_once 'layout/header.php' ?>
    <div class="container mt-5">
        <div class="row">
            <h1 class="display-6">Google Static Maps</h1>
            <div class="col-md-6">
                <img src="/resources/images/google-maps-earth.jpg" class="img-fluid" id="mapImage" width="600"
                     height="400" alt="Google Map">
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" id="autocomplete" class="form-control" list="suggestions"
                           placeholder="Enter your address" aria-label="Address">
                </div>
                <ul id="suggestions" class="list-group">
                </ul>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <table class="table">
                    <thead class="table-success">
                    <tr>
                        <th scope="col">Street Number</th>
                        <th scope="col">Route</th>
                        <th scope="col">Sublocality Level 1</th>
                        <th scope="col">Locality</th>
                        <th scope="col">Administrative Area Level 1</th>
                        <th scope="col">Country</th>
                        <th scope="col">Request Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $html = '';
                    foreach ($this->data as $component) {
                        $html .= '<tr>';
                        $html .= '<td>' . $component['street_number'] . '</td>';
                        $html .= '<td>' . $component['route'] . '</td>';
                        $html .= '<td>' . $component['sublocality_level_1'] . '</td>';
                        $html .= '<td>' . $component['locality'] . '</td>';
                        $html .= '<td>' . $component['administrative_area_level_1'] . '</td>';
                        $html .= '<td>' . $component['country'] . '</td>';
                        $html .= '<td>' . $component['created_at'] . '</td>';
                        $html .= '</tr>';
                    }
                    echo $html;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="/resources/dist/js/bundle.min.js"></script>
<?php require_once 'layout/footer.php' ?>