<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container" style="width: 40%;">
    <div class="container" >
        <ul class="list-group">
                <div class="panel panel-default" style="border:none;">
                    <div class="panel-body">
                        <div class="panel-info">
                            <a href="create_meeting.php"><button class="btn-warning">Create New Event</button></a>
                            <?php
                            include 'Database.php';
                            $pdo = Database::connect();
                            $sql = 'SELECT * FROM events ORDER BY id DESC';
                            foreach ($pdo->query($sql) as $row) {
                                echo '<div class="text-center">';
                                echo '<p>'. $row['name'] . '</p>';
                                echo '<p>'. $row['date'] . '</p>';
                                echo '<div class="panel-more1 center-block">
                                    <div id="img_container">
                                    <a href="event.php?id='.$row['id'].'"><img class="responsive" src="/uber/images/'.$row['location'].'" alt="" style="width:100%;"></a>
                                    </div></div></div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</body>
</html>
