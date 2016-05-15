<?php

require 'Database.php';

if ( !empty($_POST)) {
    // keep track validation errors
    $nameError = null;
    $descriptionError = null;
    $locationError = null;
    $dateError = null;
    $longitudeError = null;
    $latitudeError = null;

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
        $nameError = 'Please enter event Name';
        $valid = false;
    }

    if (empty($description)) {
        $descriptionError = 'Please enter event Description';
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
        $dateError = 'Please enter Event Date';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO events (name,description,location, latitude, longitude, date) values(?, ?, ?, ?, ?, ?)";
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
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">

    <div class="span10 offset1">
        <div class="row">
            <h3>Create an Event</h3>
        </div>

        <form class="form-horizontal" action="create.php" method="post">
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
            <div class="control-group <?php echo !empty($locationError)?'error':'';?>">
                <label class="control-label">Event Location</label>
                <div class="controls">
                    <input name="location" type="text"  placeholder="Event Location" value="<?php echo !empty($location)?$location:'';?>">
                    <?php if (!empty($locationError)): ?>
                        <span class="help-inline"><?php echo $locationError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($latitudeError)?'error':'';?>">
                <label class="control-label">Event Latitude</label>
                <div class="controls">
                    <input name="latitude" type="text"  placeholder="Event Latitude" value="<?php echo !empty($latitude)?$latitude:'';?>">
                    <?php if (!empty($latitudeError)): ?>
                        <span class="help-inline"><?php echo $latitudeError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($longitudeError)?'error':'';?>">
                <label class="control-label">Event Longitude</label>
                <div class="controls">
                    <input name="longitude" type="text"  placeholder="Event Longitude" value="<?php echo !empty($longitude)?$longitude:'';?>">
                    <?php if (!empty($longitudeError)): ?>
                        <span class="help-inline"><?php echo $longitudeError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Create</button>
                <a class="btn" href="../index.php">Back</a>
            </div>
        </form>
    </div>

</div> <!-- /container -->
</body>
</html>