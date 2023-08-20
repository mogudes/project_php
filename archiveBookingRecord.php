<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Archived Booking List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
              integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
        <link href='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <script src="./archiveBookingRecord.js" type="text/javascript" defer></script>
        <link rel="stylesheet" href="archiveBookingRecord.css" />
        <link rel="stylesheet" href="sidebar/sidebar.css" />
    </head>
    <body>
    <?php
        session_start();
        include '../includes/dbConnector.php';
        include '../includes/helper.php';

        if (isset($_GET['eventId'])) {
            $eventID = trim($_GET['eventId']);
            $selectCommand = "SELECT * FROM archive_booking WHERE Event_Id = '$eventID' ";

            $room = mysqli_query($dbConnection, $selectCommand);
        }
        ?>
        <nav>
            <ul>
                <li>
                    <a href="#" class="logo">
                        <img src="logo.png" alt="">
                        <span class="nav-item">Music Society</span>
                    </a>
                </li>
                <li><a href="adminAdd.html" class="a">
                    <i class="fas fa-home"></i>
                    <span class="nav-item">Add</span>
                </a></li>
                <li><a href="adminViewEvent.html" class="a"><i class="fas fa-user"></i>
                    <span class="nav-item">Edit/View</span></a></li>
                <li><a href="#" class="logout"><i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item">Log Out</span></a></li>
        
            </ul>
            
        </nav>
        <div class="booking-header">
            <div>
                <h3>Archived Booking Record</h3>
            
            </div>
        </div>
        <div class="container booking-container">
            <div class="row first-row ">
                <div class="col-4 col-sm-1">
                    <h4>No</h4>
                </div>
                <div class="col-4 col-sm-3">
                    <h4>Booking ID</h4>
                </div>
                <div class="col-4 col-sm-3">
                    <h4>Name</h4>
                </div>
                <div class="col-6 col-sm-2">
                    <h4>Price</h4>
                </div>
                <div class="col-6 col-sm-3">
                    <h4>Actions</h4>
                </div>
            </div>
                <?php
$record = 1;
while ($bookingData = mysqli_fetch_array($room
)) {
    $selectStudentCommand = "SELECT * FROM student WHERE Student_Id = '" . $bookingData['Student_Id'] . "'";
    $studentResults = mysqli_query($dbConnection, $selectStudentCommand);
    $studData = mysqli_fetch_array($studentResults);

    echo '<div class="row">';
    echo '<div class="col-4 col-sm-1">';
    echo '<p>' . $record . '</p>';
    echo '</div>';
    echo '<div class="col-4 col-sm-3">';
    echo '<p>' . $bookingData["Booking_Id"] . '</p>';
    echo '</div>';
    echo '<div class="col-4 col-sm-3">';
    echo '<p>' . $studData['First_Name'] . ' ' . $studData["Last_Name"] . '</p>';
    echo '</div>';
    echo '<div class="col-6 col-sm-2">';
    echo '<p>' . $bookingData['Price'] . '</p>';
    echo '</div>';
    echo '<div class="col-6 col-sm-3">';

    echo '<button  class="toggle" data-studNo="' . $record . '"><i class="fa-solid fa-eye"></i></button>';

    echo '</div>';
    echo '<div class="row student-info hidden" id="student' . $record . '">';
    echo '<div class="row">';
    echo '<div>';
    echo "<h4>Volunteer's Info</h4>";
    echo '</div>';
    echo '</div>';
    echo '<div class="row gy-2">';

    echo '<div class="col-12 col-lg-6">';
    echo '<p>Email : ' . $studData['Email'] . '</p>';
    echo '</div>';
    echo '<div class="col-12 col-lg-6">';
    echo '<p>Phone Number : ' . $studData['Phone_No'] . '</p>';
    echo '</div>';
    echo '<div class="col-12">';
    echo '<p>Address : ' . $studData['Address'] . ' ' . $studData['Postcode'] . ' ' . $studData['City'] . ' ' . $studData['State'] . '</p>';
    echo '</div>';
    echo '<div class="col-12">';
    echo '<p>Number Of Seats : ' . $bookingData['Quantity'] . '</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    $record += 1;
}
$record -= 1;
echo '<div>';
echo '<p>Total Record : ' . $record . '</p>';
echo '</div>';
?>
        </div>
    </body>
</html>
<script>
    
var numberOfRecords = document.querySelectorAll(".toggle").length;

for(var i = 0 ; i < numberOfRecords ; i ++ ){
    document.querySelectorAll(".toggle")[i].addEventListener("click",function(){
        var studId = "student"+this.getAttribute("data-studNo");
        // console.log(studId);
        var element = document.getElementById(studId);

        element.classList.toggle("hidden");
        
    });
}
</script>