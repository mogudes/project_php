<!DOCTYPE html>
<?php
    session_start();
include '../includes/dbConnector.php';
include '../includes/helper.php';
if (!$dbConnection) {
    echo "connection failed";
}

//pass in query parameter
if (isset($_GET['event_id'])) {
    $eventID = trim($_GET['event_id']);
    $selectCommand = "SELECT * FROM event WHERE Event_Id = '$eventID' ";
    $result = mysqli_query($dbConnection, $selectCommand);

    $row = mysqli_fetch_array($result);

    //after delete redirect to view event page
    //save button 
    if (isset($_POST['editBtn'])) {

        $eventName = isset($_POST['eventName']) ? trim($_POST['eventName']) : "";
        $eventDate = isset($_POST['eventDate']) ? trim($_POST['eventDate']) : "";
        $eventFromTime = isset($_POST['eventFromTime']) ? trim($_POST['eventFromTime']) : "";
        $venue = isset($_POST['eventVenue']) ? trim($_POST['eventVenue']) : "";
        $maxPax = isset($_POST['maxPax']) ? trim($_POST['maxPax']) : "";

        $editCommand = "UPDATE event SET Event_Category = '$eventName', Date = '$eventDate', Time = '$eventFromTime', Venue = '$venue', Participant = '$maxPax'  WHERE Event_Id = '$eventID' ";
        $result2 = mysqli_query($dbConnection, $editCommand);
        header("Location: adminViewEvent.php");
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="sidebar/sidebar.css" rel="stylesheet">
        <link rel="stylesheet" href="adminEditEvent.css">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
        <title>Admin Edit Event</title>

    </head>



    <body>
        <nav>
            <ul>
                <li>
                    <a href="adminAdd.php" class="logo">
                        <img src="logo.png" alt="">
                        <span class="nav-item">Music Society</span>
                    </a>
                </li>
                <li><a href="#">
                    <i class="fas fa-home"></i>
                    <span class="nav-item">Add</span>
                </a></li>
                <li><a href="adminViewEvent.php"><i class="fas fa-user"></i>
                    <span class="nav-item">Edit/View</span></a></li>
                <li><a href="#" class="logout"><i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item">Log Out</span></a></li>
        
            </ul>
            
        </nav>
        <div class="main-content">

            <section>
                


                <div class="container">
                    <fieldset class="record">
                        <legend>Previous record for ID: <?php echo $row['Event_Id'] ?></legend>
                        <div class="input">
                            <label for="eventName"><i class='bx bx-calendar-event'></i> Event</label>
                            <input type="text" id="eventName" value="<?php echo $row['Event_Category'] ?> " disabled="true">
                            <br>
                            <label for="eventtime"><i class='bx bxs-calendar' ></i> Date</label>
                            <input type="dateTime" id="eventDate"  value="<?php echo $row['Date'] ?>" disabled="true">
                            <br>
                            <label for="eventTime"><i class='bx bx-time-five' ></i> Time</label>
                            <input type="time" id="eventTime"  value="<?php echo $row['Time'] ?>" disabled="true">
                            <br>
                            <label for="eventVenue"><i class='bx bxs-institution'></i> Venue</label>
                            <input type="text" id="eventVenue"  value="<?php echo $row['Venue'] ?>" disabled="true">
                            <br>
                            <label for="maxPax"><i class='fa-solid fa-person'></i> Max Pax</label>
                            <input type="text" id="maxPax"  value="<?php echo $row['Participant'] ?>" disabled="true">
                            <div class="oprButton">


                                <button onclick="enableEdit()"   class="editBtn"><i class='bx bxs-edit'></i>EDIT</button>
                            </div>
                        </div>
                    </fieldset>
                </div>


                <form action="" method="POST">
                    <div class="container">
                        <fieldset class="record">
                            <legend>Edit Record</legend>
                            <div class="input">
                                <label for="eventName"><i class='bx bx-calendar-event'></i> Event</label>
                                <input type="text" id="eventName" class="edit" name="eventName" placeholder="event name" disabled="true">
                                <br>
                                <label for="eventtime"><i class='bx bxs-calendar' ></i> Date</label>
                                <input type="date" id="eventDate" class="edit" min="<?php echo date("Y-m-d"); ?>" name="eventDate" disabled="true">
                                <br>
                                <label for="eventTime"><i class='bx bx-time-five' ></i> Time</label>
                                <input type="time" id="eventTime" class="edit" name="eventFromTime" disabled="true">
                                <br>
                                <label for="eventVenue"><i class='bx bxs-institution'></i> Venue</label>
                                <input type="text" id="eventVenue" class="edit"name="eventVenue"
                                        disabled="true">
                                <br>
                                <label for="maxPax"><i class="fa-solid fa-person"></i> Max Pax</label>
                                <input type="number" id="maxPax" class="edit"name="maxPax"
                                        disabled="true">
                                <div class="oprButton">
                                    <input type="submit" id="saveBtn" value="Save" onclick="saveSuccess()" disabled="true" name="editBtn">
                                </div>

                            </div>
                        </fieldset>
                    </div>
                </form>
            </section>
        </div>

    </body>

    <script>
        function enableEdit() {
            const inputs = document.getElementsByClassName("edit");
            const saveInput = document.getElementById("saveBtn");

            for (const input of inputs) {
                if (input.disabled == true) {
                    input.disabled = false;
                    saveInput.disabled = false;
                    document.getElementById('saveBtn').style.backgroundColor = 'rgb(54, 179, 23)';
                } else {
                    input.disabled = true;
                    saveInput.disabled = true;
                    document.getElementById('saveBtn').style.backgroundColor = 'grey';

                }

            }
        }

        function saveSuccess() {
            alert("Save successfully!")
        }


    </script>
</html>