<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Booking</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
              integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
        <link href='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css"/>
        
        <link href="./editBooking.css" rel="stylesheet">
        <link rel="stylesheet" href="../leonard/userLogin/errorMsg.css" />
        <link rel="icon" href="../images/homeImages/logo.png" type="image/icon type">
     

        <style>
            .success_msg {
                text-align: center;
                width:88%;
                margin: 5px auto;
                border:1px solid green;
                color:green;
            }
            img{
                max-width: 100%;
                max-height: 100%;
            }
            header{
                display: flex;
                height: 60px;
                background-color:  #4a4b4c;
                padding: 10px 0px;
                max-width: 100%;
                position: relative;
            }
            #logo-container{
                text-align: center;
            }
            #logo{
                max-height: 100%;
            }
            #back-arrow{
                padding: 5px;
                font-size: 30px;
                color: white;
                cursor: pointer;
            }
            #back-arrow a {
                position: relative;
                top: -8px;
            }
            #back-arrow:hover{
                color: white;
                font-size: 32px;
            }
        </style>
    </head>
    <body>
    <?php
        session_start();
        include '../includes/dbConnector.php';
        include '../includes/helper.php';
        if (isset($_GET['id'])) {
            $bookingId = trim($_GET['id']);

            $selectEventCommand = "SELECT * FROM booking WHERE Booking_Id = '$bookingId' ";

            $bookingResult = mysqli_query($dbConnection, $selectEventCommand);

            $bookingData = mysqli_fetch_object($bookingResult);

            $selectStudentCommand = "SELECT * FROM student WHERE Student_Id = '" . $bookingData->Student_Id . "'";
            $studentResults = mysqli_query($dbConnection, $selectStudentCommand);
            $studData = mysqli_fetch_object($studentResults);

            $studId = $studData->Student_Id;
            $studName = $studData->First_Name . " " . $studData->Last_Name;
            $price = $bookingData->Price;
            $currentStatus = $bookingData->Status;
        }
        if (isset($_POST['btnUpdate'])) {
            $status = isset($_POST['status']) ? trim($_POST['status']) : "";

            $updateCommand = "UPDATE booking SET Status = '$status' WHERE Booking_Id = '$bookingId'";
            $result = mysqli_query($dbConnection, $updateCommand);

            header("Location: editBooking.php?success=Record has been updated successfully.&id=$bookingId");
        }
        ?>
        <div class="container-fluid d-flex" id="bodyPage">
            <div class="table">
                <div class="container booking-container">

                <?php if (isset($_GET['success'])) { ?>
                                            <p class="success_msg"><?php echo $_GET['success']; ?></p>
                    <?php } ?>
                    <form method="" action="adminViewEvent.php">
                        <p>Are you sure you want to edit the following record ?</p>
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
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <p>Price : </p>
                            </div>
                            <div class="col-12 col-sm-6">
                            <?php
                                global $price;
                                echo $price;
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <p>Current Status : </p>
                            </div>
                            <div class="col-12 col-sm-6">
                            <?php
                                global $currentStatus;
                                echo $currentStatus;
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="confirm" class="col-12 col-sm-3" ><b>Confirm Booking</b> &nbsp;&nbsp;<i style="color:green" class="fa-solid fa-circle-check"></i></label> 
                                <input style="width: 50%;" id="confirm" name="status" type="radio" value="Confirmed">
                            </div>
                            <div class="col-12">
                                <label for="reject" class="col-12 col-sm-3" ><b>Reject Booking</b> &nbsp;&nbsp;&nbsp;&nbsp;<i style="color:red" class="fa-solid fa-circle-xmark"></i></label>
                                <input style="width: 50%;" id="confirm" name="status" type="radio" value="Rejected">
                            </div>
                        </div>
                        <br>
                        <button class="btn" type="submit" name="btnUpdate" value="Yes" >Yes</button>
                        <button class="btn" type="button" name="btnCancel" value="Cancel" onclick="location.href='adminViewEvent.html'">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>