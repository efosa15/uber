<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <div class="row">
        <h3>Event Admin Magement</h3>
    </div>
    <div class="row">
        <p>
            <a href="create_meeting.php" class="btn btn-success">Create New Meeting</a>
        </p>
        <button type="button" class="btn btn-default" id="events">User Suggested Events</button>
        <button type="button" class="btn btn-default" id="meetings">Meeting Points</button>
        <table class="table table-striped table-bordered" id="eventsTable">
            <thead>
            <tr>
                <th>User suggested events</th>
            </tr>
            <tr>
                <th>Name</th>
                <th>Event Description</th>
                <th>Event Date</th>
                <th>Event location</th>

                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include 'Database.php';
            $pdo = Database::connect();
            $sql = 'SELECT * FROM events ORDER BY id DESC';
            foreach ($pdo->query($sql) as $row) {
                echo '<tr>';
                echo '<td>'. $row['name'] . '</td>';
                echo '<td>'. $row['description'] . '</td>';
                echo '<td>'. $row['date'] . '</td>';
                echo '<td><img class="map" src="http://maps.googleapis.com/maps/api/staticmap?center='.$row['latitude'].','.$row['longitude'].'&zoom=17&format=png&sensor=false&size=280x280&maptype=roadmap&style=element:geometry.fill|color:0xf4f4f4&markers=color:red|'.$row['latitude'].','.$row['longitude'].'&scale=2" alt="" height="30%"></td>';
                echo '<td width=250>';
                echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Create Meeting point</a>';
                echo ' ';
                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete Event</a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>



        <table class="table table-striped table-bordered" id="meetingPointsTable">
            <thead>
            <tr>
                <th id="meetings">Meeting Points</th>
            </tr>
            <tr>
                <th>Name</th>
                <th>Event Description</th>
                <th>Event Date</th>
                <th>Event location</th>

                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $pdo = Database::connect();
            $sql = 'SELECT * FROM meeting ORDER BY id DESC';
            foreach ($pdo->query($sql) as $row) {
                echo '<tr>';
                echo '<td>'. $row['name'] . '</td>';
                echo '<td>'. $row['description'] . '</td>';
                echo '<td>'. $row['date'] . '</td>';
                echo '<td><img class="map" src="http://maps.googleapis.com/maps/api/staticmap?center='.$row['latitude'].','.$row['longitude'].'&zoom=17&format=png&sensor=false&size=280x280&maptype=roadmap&style=element:geometry.fill|color:0xf4f4f4&markers=color:red|'.$row['latitude'].','.$row['longitude'].'&scale=2" alt="" height="30%"></td>';
                echo '<td width=250>';
                echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Edit Meeting point</a>';
                echo ' ';
                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete Meeting</a>';
                echo '</td>';
                echo '</tr>';
            }
            Database::disconnect();
            ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            $('#meetingPointsTable').hide();
            $("#events").click(function(){
                $("#eventsTable").show();
            });

            $("#meetings").click(function(){
                $("#eventsTable").hide();
                $("#meetingPointsTable").show();
            });

        });

    </script>
</body>
</html>
