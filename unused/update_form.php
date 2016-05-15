<?php
$event_id=isset($_GET['event_id']) ? $_GET['event_id'] : die('ERROR: Event ID not found.');

// include database and object files
include_once 'Database.php';
include_once 'Event.php';

$database = new Database();
$db = $database->getConnection();

// initialize objectp
$event = new Event($db);

$event->id=$event_id;

$event->readOne();
?>
<form id='update-event-form' action='#' method='post' border='0'>
    <table class='table table-bordered table-hover'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' value='<?php echo htmlspecialchars($event->name, ENT_QUOTES); ?>' required /></td>
        </tr>
        <tr>
            <td>Description</td>
            <td>
                <textarea name='description' class='form-control' required><?php echo htmlspecialchars($event->description, ENT_QUOTES); ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Coordinates</td>
            <td><input type='coordinates' name='coordinates' class='form-control' value='<?php echo htmlspecialchars($event->coordinates, ENT_QUOTES);  ?>' required /></td>
        </tr>
        <tr>
            <td>Location</td>
            <td><input type='location' name='location' class='form-control' value='<?php echo htmlspecialchars($event->location, ENT_QUOTES);  ?>' required /></td>
        </tr>
        <tr>
            <td>
                <!-- hidden ID field so that we could identify what record is to be updated -->
                <input type='hidden' name='id' value='<?php echo $event_id ?>' />
            </td>
            <td>
                <button type='submit' class='btn btn-primary'>
                    <span class='glyphicon glyphicon-edit'></span> Save Changes
                </button>
            </td>
        </tr>
    </table>
</form>