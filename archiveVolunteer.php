<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Archive Volunteer</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
              integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
        <link href='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'>
        <link href="archiveVolunteer.css" rel="stylesheet">
        <script src="./archiveVolunteer.js" type="text/javascript" defer></script>
        <link rel="icon" href="../images/homeImages/logo.png" type="image/icon type">
        <link rel="stylesheet" href="sidebar/sidebar.css" />

    </head>
    <body>
    <?php
        include '../includes/dbConnector.php';
        include '../includes/helper.php';

        $selectVolunteerCommand = "SELECT * FROM archive_volunteer";
        $volunteerResult = mysqli_query($dbConnection, $selectVolunteerCommand);
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

        
        <div class="container-fluid d-flex" id="bodyPage">
            <div class="table">
                <div class="container booking-container">
                    <div class="booking-header">
                        <div>
                            <h3>Archived Volunteers</h3>
                        </div>
                    </div>
                    <div class="row first-row ">
                        <div class="col-4 col-sm-1">
                            <h4>No</h4>
                        </div>
                        <div class="col-4 col-sm-3">
                            <h4>Student ID</h4>
                        </div>
                        <div class="col-4 col-sm-3">
                            <h4>Name</h4>
                        </div>
                        <div class="col-6 col-sm-2">
                            <!-- <h4>Status</h4> -->
                            <h4>Email</h4>
                        </div>
                        <div class="col-6 col-sm-3">
                            <h4>Actions</h4>
                        </div>
                    </div>
                        <?php
                            session_start();
                    $record = 1;
                    while ($volunteerData = mysqli_fetch_array($volunteerResult)) {
                        $selectStudentCommand = "SELECT * FROM student WHERE Student_Id = '" . $volunteerData['Student_Id'] . "'";
                        $studentResults = mysqli_query($dbConnection, $selectStudentCommand);
                        $studData = mysqli_fetch_array($studentResults);

                        $selectVolunteerWorkCommand = "SELECT * FROM volunteer_work WHERE Volunteer_Work_Id = '" . $volunteerData['Volunteer_Work_Id'] . "'";
                        $volunteerWorkResults = mysqli_query($dbConnection, $selectVolunteerWorkCommand);
                        $volunteerWorkdata = mysqli_fetch_array($volunteerWorkResults);

                        echo '<div class="row">';
                        echo '<div class="col-4 col-sm-1">';
                        echo '<p>' . $record . '</p>';
                        echo '</div>';
                        echo '<div class="col-4 col-sm-3">';
                        echo '<p>' . $studData["Student_Id"] . '</p>';
                        echo '</div>';
                        echo '<div class="col-4 col-sm-3">';
                        echo '<p>' . $studData['First_Name'] . ' ' . $studData["Last_Name"] . '</p>';
                        echo '</div>';
                        echo '<div class="col-6 col-sm-2">';
                        echo '<a class="toEmail" href="mailto:' . $studData["Email"] . '?subject=Event Volunteering" title="Email volunteer"><i class="fa-solid fa-envelope"></i></a>';
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
                        echo '<p>Work Volunteered : ' . $volunteerWorkdata['Work'] . '</p>';
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
            </div>
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