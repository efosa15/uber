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
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600' rel='stylesheet' type='text/css'>

</head>

<body>

    <div class="container" style="width: 80%;" >
        <ul class="list-group">
            <div class="panel panel-default" style="border:none;">
                <div class="panel-body">
                    <div class="panel-info">
                        <div class="text-center"><h3></h3></div>
                        <?php
                        echo '<h3><div class="text-center">'. $name . '</div></h3>';
                            echo '<div class="panel-more1 center-block">
                                    <div id="img_container">
                                    <img class="responsive" src="/uber/images/'.$location.'" alt=""style="width:100%;"" />
                                    </div></div>';
                            echo '<div class="text-center">';
                            echo '<div class="myButtons">';
                            echo '<button class="btn-primary" style="width: 30%">Attend</button><button class="btn-primary" style="width: 30%">Invite</button><button class="btn-primary" style="width: 30%">Share</button>';
                            echo '</div>';
                            echo '<p>'. $description . '</p>';
                            echo '<p>'. $date . '</p>';
                            echo '<div class="text-center">
                                    <img class="map-canvas" src="http://maps.googleapis.com/maps/api/staticmap?center='.$latitude.','.$longitude.'&zoom=17&format=png&sensor=false&size=280x280&maptype=roadmap&style=element:geometry.fill|color:0xf4f4f4&markers=color:red|'.$latitude.','.$longitude.'&scale=2" alt="" style="width:70%"">
                                    </div>
                                            <a href="#">
                                                <div class="buttonUber" style="width:45%">
                                                    <p id="time">ESTIMATING TIME</p>
                                                    <div id="img_container">
                                                </div>
                                            </a>

                                    </div>';
                        ?>
                    </div>
                        <ul class="list-group" style="padding-left: 30%;padding-right: 30%;">
                            <div class="panel panel-default" style="border:none;">
                                <div class="panel-body">
                                    <div class="panel-info">
                                        <?php
                                        $pdo = Database::connect();
                                        $sql = 'SELECT * FROM user WHERE id <> 1 ORDER BY id DESC';
                                        foreach ($pdo->query($sql) as $row) {
                                            echo '<div class="text-center">';
                                            echo ' <div id="'.$row['id'].'user"><div id="img_container" style="position:relative;text-align:center;width:100px;height:30px;">
                                    <img class="img-responsive img-circle" src="'.$row['photourl'].'"alt="" style="display:inline-block;width:30px;">
                                    <button id="'.$row['id'].'accept" class="btn-primary glyphicon glyphicon-ok img-circle"></button><button id="'.$row['id'].'decline" class="btn-danger glyphicon glyphicon-remove img-circle"></button>
                                    </div></div>';
                                            echo '<div class="text-center">';
                                            echo '<p>'. $row['name'] . '</p></div></div></div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </ul>
                </div>
            </div>
            </li>
        </ul>
    </div>
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/uber.js"></script>
    <script>
        $('#2accept').click(function(){
            $('#2user').css('background-color','orange');
        });
        $('#2decline').click(function(){
            $('#2user').css('background-color','red');
        });


        $('#3accept').click(function(){
            $('#3user').css('background-color','green');
        });
        $('#3decline').click(function(){
            $('#3user').css('background-color','red');
        });
    </script>
</body>
</html>