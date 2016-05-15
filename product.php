<?php
require 'Database.php';

$id = null;
if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if ( null==$id ) {
    header("Location: index.php");
}

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

} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM events where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $name = $data['name'];
    $description = $data['description'];
    $location = $data['location'];
    $latitude = $data['latitude'];
    $longitude = $data['longitude'];
    $date = $data['date'];
    Database::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>




<div class="container" >
    <ul class="list-group">
        <div class="panel panel-default" style="border:none;">
            <div class="panel-body">
                <div class="panel-info">
                    <div class="text-center"><h3>Create New Meeting Point</h3></div>
                    <?php
                        echo '<div class="text-center">';
                        echo '<p>'. $name. '</p>';
                        echo '<p>'. $description . '</p>';
                        echo '<p>'. $date . '</p>';
                        echo '<div class="panel-more1 center-block">
                                    <div id="img_container" style="position:relative;display:inline-block;text-align:center;">
                                    <img class="map center-block" src="http://maps.googleapis.com/maps/api/staticmap?center='.$latitude.','.$longitude.'&zoom=17&format=png&sensor=false&size=280x280&maptype=roadmap&style=element:geometry.fill|color:0xf4f4f4&markers=color:red|'.$latitude.','.$longitude.'&scale=2" alt="" style="height:200px;">
                                    <a href="product.php?id='.$id.'"><button class="button btn-primary" style="position:absolute;bottom:10px;left:0px;width:100%;height:30px" href="register.php" >click here </button></a>
                                    </div></div></div>';
                    ?>
                </div>
            </div>
        </div>
        </li>
    </ul>
</div>
</div> <!-- /container -->
</body>
</html>