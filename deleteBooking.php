<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Delete Booking</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
              integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
        <link href='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'>
        <link href="viewBookingList.css" rel="stylesheet">
        <link href="deleteBooking.css" rel="stylesheet">
        <link rel="stylesheet" href="../leonard/userLogin/errorMsg.css" />
        <link rel="icon" href="../images/homeImages/logo.png" type="image/icon type">
    
    </head>

    <body>
    <?php
        session_start();
        include '../includes/dbConnector.php';
        include '../includes/helper.php';
        if (isset($_POst['id'])) {
            $bookingId = trim($_POST['id']);

            $selectEventCommand = "SELECT * FROM booking ";

            $bookingResult = mysqli_query($dbConnection, $selectEventCommand);

            $bookingData = mysqli_fetch_object($bookingResult);

            $selectStudentCommand = "SELECT * FROM student WHERE Student_Id = '" . $bookingData->Student_Id . "'";
            $studentResults = mysqli_query($dbConnection, $selectStudentCommand);
            $studData = mysqli_fetch_object($studentResults);

            $studId = $studData->Student_Id;
            $studName = $studData->First_Name . " " . $studData->Last_Name;
        }
        else{
            $bookingId = trim($_GET['id']);
        }
        if (isset($_POST['btnDelete'])) {



            $deleteCommand = "DELETE FROM booking WHERE Booking_Id = '$bookingId'";
            $result = mysqli_query($dbConnection, $deleteCommand);

            header("Location: viewBookingList.php");
        }
        ?>
        <div class="container-fluid d-flex" id="bodyPage">
            
            <div class="table">
                <div class="container booking-container">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <?php if (isset($_GET['success'])) { ?>
                            <p class="success_msg"><?php echo $_GET['success']; ?></p>
                        <?php } ?>
                          <?php echo "<input-type = 'text' name = 'id' value = ".$bookingId."hidden >"  ;  ?>  
                        <p>Are you sure you want to delete the following record ?</p>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <p>Student ID : </p>
                            </div>
                            <div class="col-12 col-sm-6">
                            <?php
                                global $studId;
                                echo $studId;
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <p>Student Name : </p>
                            </div>
                            <div class="col-12 col-sm-6">
                            <?php
                                global $studName;
                                echo $studName;
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <p>Booking : </p>
                            </div>
                            <div class="col-12 col-sm-6">
                            <?php
                                global $bookingId;
                                echo $bookingId;
                                ?>
                            </div>
                        </div>
                        <br>
                        <button class="btn" type="submit" name="btnDelete" value="Yes" >Yes</button>
                        <button class="btn" type="button" name="btnCancel" value="Cancel" >Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>