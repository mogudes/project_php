<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booking List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
              integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
        <link href='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="adminViewVolunteer.css" />
        <link rel="stylesheet" href="../leonard/userLogin/errorMsg.css" />
        <link rel="stylesheet" href="sidebar/sidebar.css" />

        <style>
            .success_msg {
                text-align: center;
                width:88%;
                margin: 5px auto;
              
                color:green;
            }
            input[type="checkbox"] {
                background-color: #fff;
                margin: 0;
                font: inherit;
                color: currentColor;
                width: 1.15em;
                height: 1.15em;
                border: 0.15em solid currentColor;
                border-radius: 0.15em;
                transform: translateY(-0.075em);
            }
        </style>
    </head>
    <body>
    <?php
        session_start();
        include '../includes/dbConnector.php';
        include '../includes/helper.php';

       

            $success = "Records have been deleted successfully";
            $error = "No record detected";

            $eventID = trim($_GET['event_id']);
            $selectCommand = "SELECT * FROM booking  ";

            $bookingResult = mysqli_query($dbConnection, $selectCommand);
        

        if (isset($_POST['btnDelete'])) {
            $bookingIds = isset($_POST['dltBookingArr']) ? $_POST['dltBookingArr'] : array();

            if (!empty($bookingIds)) {
                foreach ($bookingIds as $bookingId) {
                    $deleteCommand = "DELETE FROM booking WHERE Booking_Id = '$bookingId'";
                    $result = mysqli_query($dbConnection, $deleteCommand);
                    header("Location: viewBookingList.php?success=Records have been deleted successfully.&event_id=$eventID");
                }
            } else {
                header("Location: viewBookingList.php?error=No Record selected.&event_id=$eventID");
            }
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
                <li><a href="adminAdd.html" class="a" >
                    <i class="fas fa-home"></i>
                    <span class="nav-item">Add</span>
                </a></li>
                <li><a href="adminViewEvent.php" class="a"><i class="fas fa-user"></i>
                    <span class="nav-item">Edit/View</span></a></li>
                <li><a href="../Register.html" class="logout"><i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item">Log Out</span></a></li>
        
            </ul>
            
        </nav>

        <div class="booking-header">
            <div>
            <?php if (isset($_GET['error'])) { ?>
                    <p class="invalid_msg"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                    <p class="success_msg"><?php echo $_GET['success']; ?></p>
                <?php } ?>
                 <p class="invalid_msg"></p>
                
                
                <p class="success_msg"></p>
              
                <h3>Booking Record</h3>
            </div>
            <div>
                <a style="color: black;" href="archiveBookingRecord.php">
                    <i class="fa-solid fa-box-archive"></i>
                </a>
            </div>
        </div>
        <form method="POST">
            <div class="container booking-container">
                <div class="row first-row ">
                    <div class="col-4 col-sm-1">
                    </div>
                    <div class="col-4 col-sm-1">
                        <h4>No</h4>
                    </div>
                    <div class="col-4 col-sm-2">
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
                    while ($bookingData = mysqli_fetch_array($bookingResult)) {
                        $selectStudentCommand = "SELECT * FROM student WHERE Student_Id = '" . $bookingData['Student_Id'] . "'";
                        $studentResults = mysqli_query($dbConnection, $selectStudentCommand);
                        $studData = mysqli_fetch_array($studentResults);

                        echo '<div class="row">';
                        echo "<div class='col-4 col-sm-1'><input type='checkbox' name='dltBookingArr[]' value='" . $bookingData["Booking_Id"] . "'></div>";
                        echo '<div class="col-4 col-sm-1">';
                        echo '<p>' . $record . '</p>';
                        echo '</div>';
                        echo '<div class="col-4 col-sm-2">';
                        echo '<p>' . $bookingData["Booking_Id"] . '</p>';
                        echo '</div>';
                        echo '<div class="col-4 col-sm-3">';
                        echo '<p>' . $studData['First_Name'] . ' ' . $studData["Last_Name"] . '</p>';
                        echo '</div>';
                        echo '<div class="col-6 col-sm-2">';
                        echo '<p>' . $bookingData['Price'] . '</p>';
                        echo '</div>';
                        echo '<div class="col-6 col-sm-3">';

                        echo '<button type="button" class="toggle" data-studNo="' . $record . '"><i class="fa-solid fa-eye"></i></button>';
                        echo '<a class="delete" href="./deleteBooking.php?id=' . $bookingData['Booking_Id'] . '"><button type="button" class="delete" data-studNo="' . $record . '"><i class="fa-solid fa-trash"></i></button></a>';
                        echo '<a class="update" href="./editBooking.php?id=' . $bookingData['Booking_Id'] . '"><button type="button" class="update" data-studNo="' . $record . '"><i class="fa-solid fa-pen-to-square"></i></button></a>';

                        echo '</div>';
                        echo '<div class="row student-info hidden" id="student' . $record . '">';
                        echo '<div class="row">';
                        echo '<div>';
                        echo "<h4>Booking's Info</h4>";
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
                        echo '<p>Payment Status : ' . $bookingData['Status'] . '</p>';
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
                <br>
                   <input  class="submit" type="submit" name="btnDelete" value="Delete Selected" onclick="return confirm('This will delete all checked records. \nAre you sure ?')">
            </div>
        </form>
        <script src="viewBookingList.js"></script>
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