<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Delete Volunteers</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
              integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
        <link href='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'>
        <link href="./viewBookingList.css" rel="stylesheet">
        <link href="deleteVolunteer.css" rel="stylesheet">
        <link rel="stylesheet" href="errorMsg.css" />
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
                padding: 10px 0px !important ;
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
            $studId = trim($_GET['id']);

            $selectVolunteerCommand = "SELECT * FROM volunteer WHERE Student_Id = '$studId'";
            $volunteerResult = mysqli_query($dbConnection, $selectVolunteerCommand);
            $volunteerData = mysqli_fetch_object($volunteerResult);

            $selectStudentCommand = "SELECT * FROM student WHERE Student_Id = '" . $studId . "'";
            $studentResults = mysqli_query($dbConnection, $selectStudentCommand);
            $studData = mysqli_fetch_object($studentResults);

            $selectVolunteerWorkCommand = "SELECT * FROM volunteer_work WHERE Volunteer_Work_Id = '" . $volunteerData->Volunteer_Work_Id . "'";
            $volunteerWorkResults = mysqli_query($dbConnection, $selectVolunteerWorkCommand);
            $volunteerWorkdata = mysqli_fetch_object($volunteerWorkResults);

            $studName = $studData->First_Name . " " . $studData->Last_Name;
            $work = $volunteerWorkdata->Work;
        }
        if (isset($_POST['btnDelete'])) {

            $deleteCommand = "DELETE FROM volunteer WHERE Student_Id = '$studId'";
            $result = mysqli_query($dbConnection, $deleteCommand);

            header("Location: deleteVolunteer.php?success=Volunteer has been deleted successfully.");
        }
        ?>
        <div class="container-fluid d-flex" id="bodyPage">
            <div class="table">
                <div class="container booking-container">
                <?php
     
        if (isset($_GET['id'])) {
            $studId = trim($_GET['id']);

            $selectVolunteerCommand = "SELECT * FROM volunteer WHERE Student_Id = '$studId'";
            $volunteerResult = mysqli_query($dbConnection, $selectVolunteerCommand);
            $volunteerData = mysqli_fetch_object($volunteerResult);

            $selectStudentCommand = "SELECT * FROM student WHERE Student_Id = '" . $studId . "'";
            $studentResults = mysqli_query($dbConnection, $selectStudentCommand);
            $studData = mysqli_fetch_object($studentResults);

            $selectVolunteerWorkCommand = "SELECT * FROM volunteer_work WHERE Volunteer_Work_Id = '" . $volunteerData->Volunteer_Work_Id . "'";
            $volunteerWorkResults = mysqli_query($dbConnection, $selectVolunteerWorkCommand);
            $volunteerWorkdata = mysqli_fetch_object($volunteerWorkResults);

            $studName = $studData->First_Name . " " . $studData->Last_Name;
            $work = $volunteerWorkdata->Work;
        }
        if (isset($_POST['btnDelete'])) {

            $deleteCommand = "DELETE FROM volunteer WHERE Student_Id = '$studId'";
            $result = mysqli_query($dbConnection, $deleteCommand);

            header("Location: deleteVolunteer.php?success=Volunteer has been deleted successfully.");
        }
        ?>
                   
                        <p class="success_msg"></p>
     

                    <form method="POST" action="">
                        <p>Are you sure you want to delete the following volunteer ?</p>
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
                                <p>Work : </p>
                            </div>
                            <div class="col-12 col-sm-6">
                            <?php
                                global $work;
                                echo $work;
                                ?>
                            </div>
                        </div>
                        <br>
                        <button class="btn" type="submit" name="btnDelete" value="Yes">Yes</button>
                        <button class="btn" type="button" name="btnCancel" value="Cancel">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>