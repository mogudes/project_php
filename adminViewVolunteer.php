<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin View Volunteers</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
              integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
        <link href='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'>
        <link href="./adminViewVolunteer.css" rel="stylesheet">
        <link rel="icon" href="../images/homeImages/logo.png" type="image/icon type">
      
        <link rel="stylesheet" href="../leonard/userLogin/errorMsg.css" />
      <link rel="stylesheet" href="sidebar/sidebar.css  ">
      <style>
            .success_msg {
                text-align: center;
                width:88%;
                margin: 5px auto;
                border:1px solid green;
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

        $selectVolunteerCommand = "SELECT * FROM volunteer";
        $volunteerResult = mysqli_query($dbConnection, $selectVolunteerCommand);

        $success = "Records have been deleted successfully";
        $error = "No record detected";

        if (isset($_POST['btnDelete'])) {
            $studIds = isset($_POST['dltVolunteerArr']) ? $_POST['dltVolunteerArr'] : array();

            if (!empty($studIds)) {
                foreach ($studIds as $studId) {
                    $deleteCommand = "DELETE FROM volunteer WHERE Student_Id = '$studId'";
                    $result = mysqli_query($dbConnection, $deleteCommand);
                    header("Location: adminViewVolunteer.php?success=Volunteers have been deleted successfully.");
                }
            } else {
                header("Location: adminViewVolunteer.php?error=No Volunteer selected.");
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
                <li><a href="adminAdd.php" class="a">
                    <i class="fas fa-home"></i>
                    <span class="nav-item">Add</span>
                </a></li>
                <li><a href="adminViewEvent.php" class="a"><i class="fas fa-user"></i>
                    <span class="nav-item">Edit/View</span></a></li>
                <li><a href="#" class="logout"><i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item">Log Out</span></a></li>
        
            </ul>
            
        </nav>
        <form method="" action="" class="container-fluid d-flex" id="bodyPage">

            <div  id="side-navbar">
                <h1>Content</h1>
                <ul>
                    <li id="viewEvents-btn"><a href="adminViewEvent.php">View Events</a></li>
                    <li id="viewVolunteers-btn">View Volunteers</li>
                   
                </ul>
            </div>
            <div class="table">
                <div class="container booking-container">
                    <div class="booking-header">
                    <?php if (isset($_GET['error'])) { ?>
                            <p class="invalid_msg"><?php echo $_GET['error']; ?></p>
<?php } ?>
<?php if (isset($_GET['success'])) { ?>
                            <p class="success_msg"><?php echo $_GET['success']; ?></p>
                        <?php } ?>    

                            <p class="invalid_msg"></p>

                            <p class="success_msg">Item Add successfully</p>

                        <div>
                            <h3>Volunteers</h3>
                            <span style="width:100%; background-color: black;"></span>
                            <div>
                                <a style="color: black;" href="archiveVolunteer.php">
                                    <i class="fa-solid fa-box-archive"></i>
                                </a>
                            </div>


                        </div>
                    </div>

                    </form>
                    <div class="row first-row ">
                        <div class="col-4 col-sm-1">

                        </div>
                        <div class="col-4 col-sm-1">
                            <h4>No</h4>
                        </div>
                        <div class="col-4 col-sm-2">
                            <h4>Student ID</h4>
                        </div>
                        <div class="col-4 col-sm-3">
                            <h4>Name</h4>
                        </div>
                        <div class="col-6 col-sm-2">
                            
                            <h4>Email</h4>
                        </div>
                        <div class="col-6 col-sm-3">
                            <h4>Actions</h4>
                        </div>
                    </div>
                         <?php
$record = 1;
while ($volunteerData = mysqli_fetch_array($volunteerResult)) {

    $selectStudentCommand = "SELECT * FROM student WHERE Student_Id = '" . $volunteerData['Student_Id'] . "'";
    $studentResults = mysqli_query($dbConnection, $selectStudentCommand);
    $studData = mysqli_fetch_array($studentResults);

    $selectVolunteerWorkCommand = "SELECT * FROM volunteer_work WHERE Volunteer_Work_Id = '" . $volunteerData['Volunteer_Work_Id'] . "'";
    $volunteerWorkResults = mysqli_query($dbConnection, $selectVolunteerWorkCommand);
    $volunteerWorkdata = mysqli_fetch_array($volunteerWorkResults);

    echo '<div class="row">';
    echo "<div class='col-4 col-sm-1'><input type='checkbox' name='dltVolunteerArr[]' value='" . $volunteerData['Student_Id'] . "'></div>";
    echo '<div class="col-4 col-sm-1">';
    echo '<p>' . $record . '</p>';
    echo '</div>';
    echo '<div class="col-4 col-sm-2">';
    echo '<p>' . $studData["Student_Id"] . '</p>';
    echo '</div>';
    echo '<div class="col-4 col-sm-3">';
    echo '<p>' . $studData['First_Name'] . ' ' . $studData["Last_Name"] . '</p>';
    echo '</div>';
    echo '<div class="col-6 col-sm-2">';
    echo '<a class="toEmail" href="mailto:' . $studData["Email"] . '?subject=Event Volunteering" title="Email volunteer"><i class="fa-solid fa-envelope"></i></a>';
    echo '</div>';
    echo '<div class="col-6 col-sm-3">';

    echo '<button type="button" class="toggle" data-studNo="' . $record . '"><i class="fa-solid fa-eye"></i></button>';
    echo '<a class="delete" href="./deleteVolunteer.php?id=' . $volunteerData['Student_Id'] . '"><button type="button" class="delete" data-studNo="' . $record . '"><i class="fa-solid fa-trash"></i></button></a>';
    echo '<a class="update" href="./editVolunteer.php?id=' . $volunteerData['Student_Id'] . '"><button type="button"  class="update" data-studNo="' . $record . '"><i class="fa-solid fa-pen-to-square"></i></button></a>';

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




                    <br>
                    <input  class="submit" type="submit" name="btnDelete" value="Delete Selected" onclick="return confirm('This will delete all checked records. \nAre you sure ?')">
                </div>
            </div>
        </form>
    </body>
</html>
<script>
    

var menuBtn = document.getElementById("admin-menu");
var menu = document.getElementById("side-navbar");

window.addEventListener('load',function(){
    if(this.window.innerWidth > 640){
        menu.style.display = "block";
    }else {
        menu.style.display = "none";
    }
})

window.addEventListener('resize',function(){
    if(this.window.innerWidth > 640){
        menu.style.display = "block";
    }else {
        menu.style.display = "none";
    }
})


menuBtn.addEventListener("click", displayMenu);

function displayMenu() {
    if (menu.style.display == "none") {
        menu.style.display = "block";
    } else if (menu.style.display == "block") {
        menu.style.display = "none";
    }
}


var numberOfRecords = document.querySelectorAll(".toggle").length;

for(var i = 0 ; i < numberOfRecords ; i ++ ){
    document.querySelectorAll(".toggle")[i].addEventListener("click",function(){
        var volunteerId = "student"+this.getAttribute("data-studNo");
        // console.log(studId);
        var element = document.getElementById(volunteerId);

        element.classList.toggle("hidden");
        
    })
}





</script>