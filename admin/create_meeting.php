<?php

require 'Database.php';

if ( !empty($_POST)) {
    // keep track validation errors
    $nameError = null;
    $descriptionError = null;
    $locationError = null;
    $latitudeError = null;
    $longitudeError = null;
    $dateError = null;

    // keep track post values
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $date = $_POST['date'];

    // validate input
    $valid = true;
    if (empty($name)) {
        $nameError = 'Please enter Event Name';
        $valid = false;
    }

    if (empty($description)) {
        $descriptionError = 'Please enter Event Description';
        $valid = false;
    }

    if (empty($location)) {
        $locationError = 'Please enter Event Location';
        $valid = false;
    }

    if (empty($latitude)) {
        $latitudeError = 'Please enter Event Latitude';
        $valid = false;
    }

    if (empty($longitude)) {
        $longitudeError = 'Please enter Event Longitude';
        $valid = false;
    }
    if (empty($date)) {
        $longitudeError = 'Please enter Event Longitude';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO events (name,description,location,latitude, longitude, date) values(?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($name,$description,$location, $latitude, $longitude, $date));
        Database::disconnect();
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container" style="width: 40%;"">

    <div class="span10 offset1">
        <div class="row">
            <h3>Create a new Meeting point for an Event</h3>
        </div>
        <div class="control-group <?php echo !empty($locationError)?'error':'';?>">
            <label class="control-label">Event Image</label>
            <div class="controls">
                <input name="location" type="text"  placeholder="Event Image" value="<?php echo !empty($location)?$location:'';?>">
                <?php if (!empty($locationError)): ?>
                    <span class="help-inline"><?php echo $locationError;?></span>
                <?php endif;?>
            </div>
        </div>
        <form class="form-horizontal" action="create_meeting.php" method="post">
            <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                <label class="control-label">Name</label>
                <div class="controls">
                    <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                    <?php if (!empty($nameError)): ?>
                        <span class="help-inline"><?php echo $nameError;?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                <label class="control-label">Event Description</label>
                <div class="controls">
                    <input name="description" type="text" placeholder="Event Description" value="<?php echo !empty($description)?$description:'';?>">
                    <?php if (!empty($descriptionError)): ?>
                        <span class="help-inline"><?php echo $descriptionError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($date)?'error':'';?>">
                <label class="control-label">Event Date</label>
                <div class="controls">
                    <input name="date" type="text"  placeholder="Event Date" value="<?php echo !empty($date)?$date:'';?>">
                    <?php if (!empty($dateError)): ?>
                        <span class="help-inline"><?php echo $dateError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($latitudeError)?'error':'';?>">
                <label class="control-label">Event Latitude</label>
                <div class="controls">
                    <input name="latitude" id="latitudeInsert" type="text"  placeholder="Event Latitude" value="<?php echo !empty($latitude)?$latitude:'';?>">
                    <?php if (!empty($latitudeError)): ?>
                        <span class="help-inline"><?php echo $latitudeError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($longitudeError)?'error':'';?>">
                <label class="control-label">Event Longitude</label>
                <div class="controls">
                    <input name="longitude" id="longitudeInsert" type="text"  placeholder="Event Longitude" value="<?php echo !empty($longitude)?$longitude:'';?>">
                    <?php if (!empty($longitudeError)): ?>
                        <span class="help-inline"><?php echo $longitudeError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div id="map_canvas" style="width: 450px; height: 450px; background-color: Black;"></div>
            <div id="hidden" style="display:none;">
            <div id="latlong">
                <p>
                    <input size="20" type="text" id="latbox" name="lat" placeholder="Drag the marker on the map or type in the latitude">
                </p>
                <p>
                    <input size="20" type="text" id="lngbox" name="lon" placeholder="Drag the marker on the map  or type in the longitude">
                </p>
            </div>
            <input class="text_field" id="locationbox" name="location" placeholder="Location" type="text">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Create</button>
                <a class="btn" href="../index.php">Back</a>
            </div>
        </form>
    </div>
</div>
<script>var map;

    function initialize() {
        var geocoder = new google.maps.Geocoder();
        //HERE CHANGE STARTING COORDS
        var myLatlng = new google.maps.LatLng(49.25302534866034, -102.04825518471148);
        var myOptions = {
            zoom: 3,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.HYBRID
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        var marker = new google.maps.Marker({
            draggable: true,
            position: myLatlng,
            map: map,
            title: "Your location"
        });
        google.maps.event.addListener(marker, 'dragend', function (event) {
            document.getElementById("latitudeInsert").value = this.getPosition().lat();
            document.getElementById("longitudeInsert").value = this.getPosition().lng();

            var latlng = this.getPosition();

            geocoder.geocode({
                "latLng": latlng
            }, function (data, status) {

                if (status == google.maps.GeocoderStatus.OK) {

                    var add = data[1].formatted_address; //this is the full address

                    // alert(add);

                    for (var i = 0; i < data[1].address_components.length; i++) {

                        if (data[1].address_components[i].types[0] == "administrative_area_level_1") {

                            document.getElementById('locationbox').value = data[1].address_components[i].short_name;

                        }
                    }
                }
            });
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);</script>
</body>
</html>