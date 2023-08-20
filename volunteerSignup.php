<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <title>Volunteer Form</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
        <link rel="stylesheet" href="volunteerSignup.css" />
        <link rel="stylesheet" href="errorMsg.css" />
        <link href="nav.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">

        <style>
            .success_msg {
                text-align: center;
                width:88%;
                margin: 5px auto;
                border:1px solid green;
                color:green;
            }
        </style>
    </head>
    <body>
        <?php
        include 'includes/dbConnector.php';
        include 'includes/helper.php';
        session_start();

        // if (!isset($_SESSION["Student_ID"])) {
        //     header("Location: /MusicSociety_LiewKimWah/MusicSociety_LiewKimWah/volunteerSignup.php");
        // }

        $studId = $_SESSION['Student_ID'];

        $selectIdCommand = "SELECT * FROM student WHERE Student_Id = '$studId'";
        $idResults = mysqli_query($dbConnection, $selectIdCommand);
        $row = mysqli_fetch_array($idResults);

        $selectVolunteerWorkCommand = "SELECT * FROM volunteer_work ";
        $volunteerWorkResults = mysqli_query($dbConnection, $selectVolunteerWorkCommand);

        $firstName = $row['First_Name'];
        $lastName = $row['Last_Name'];
        ?>


        <?php
        if (isset($_POST['btnSubmit'])) {

            $volunteerWork = isset($_POST['volunteerWork']) ? trim($_POST['volunteerWork']) : "";

            $errStudId = validateStudId($studId);
            $errFirstName = array();
            $errLastName = array();
            if (sizeof($errStudId) == 0) {
                $errFirstName = validateFirstName($studId, $firstName);
                $errLastName = validateLastName($studId, $lastName);
            }

            $finalErrorMessages = array_merge(array_merge($errStudId, $errFirstName), $errLastName);

            if (count($finalErrorMessages) > 0) {
                echo "<div class='error'>";
                echo "<ul>";
                foreach ($finalErrorMessages as $message) {
                    header("Location: volunteerSignup.php?error=$message");
                }
                echo "</ul>";
                echo "</div>";
            } else {

                $insertCommand = "INSERT INTO volunteer (Volunteer_Work_Id , Student_Id) VALUES ('$volunteerWork', '$studId')";

                $insertResult = mysqli_query($dbConnection, $insertCommand);

                if (mysqli_affected_rows($dbConnection) > 0) {
                    $insertArchiveCommand = "INSERT INTO archive_volunteer (Volunteer_Work_Id , Student_Id) VALUES ('$volunteerWork', '$studId')";
                    $insertArchiveResult = mysqli_query($dbConnection, $insertArchiveCommand);
                    header("Location: volunteerSignup.php?success=Student has been inserted successfully.");
                } else {
                    header("Location: volunteerSignup.php?error=Multiple signups is prohibited.");
                    exit();
                }
            }
        }
        ?>
        <div class="hero">
            <div class="wrappers">
                <nav>
                  <input type="checkbox" id="show-search">
                  <input type="checkbox" id="show-menu">
                  <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
                  <div class="content">
                  <div class="logo"><a href="home.php">Music Society</a></div>
                    <ul class="links">
                     
                      <li><a href="aboutus.php">About</a></li>
                      <li><a href="home.php#footer">Contact Us</a></li>
                      <li>
                        <a href="news.php" class="desktop-link">Recent News</a>
                        <input type="checkbox" id="show-features">
                        <label for="show-features">Recent News</label>
                        
                      </li>
                      <li>
                        <a href="categoryEventList.php" class="desktop-link">Categories</a>
                        <input type="checkbox" id="show-services">
                        <label for="show-services">Categories</label>
                        
                      </li>
                      <li><a href="volunteerSignup.php">Join Volunteer</a></li>
                    </ul>
                    
                    
                
                  </div>
                  <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
                  <form action="#" class="search-box">
                    <input type="search" placeholder="Type Something to Search..." required>
                    <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
                  </form>
                  <img src="images/user3.png" width="50px" class="user-pics" onclick="togglemenu()">
                  <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                        <img src="images/user3.png" width="60px">
                        <p><?php echo $studId?></p>
                        </div>
                        <hr>
                     

                

                       

                        <a href="#" class="sub-menu-link">
                            <img src="Images/logout.png" alt="">
                            <a href="Register.php" class="link2">logout</a>
                            <span></span>
                        </a>
                    </div>
                </div>
                </nav>
              </div>
        </div>
        

   
        <form method="POST" id="volunteerForm">
            <div class="signup-container">
                <div class="signup-title">
                    <h2>Volunteer Sign Up</h2>
                    <h6><span>*</span>Note that signing up does not guarantee your place as a volunteer . Whoever got shortlisted would receive an email from our president .</h6>
                </div>
                <div class="container-fluid signup-body">
                <?php if (isset($_GET['error'])) { ?>
                        <p class="invalid_msg"><?php echo $_GET['error']; ?></p>
                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                        <p class="success_msg"><?php echo $_GET['success']; ?></p>
                    <?php } ?>

                    <div class="row">
                        <div class="col-12">
                            <input name="studentId" id="studentID" oninvalid="InvalidId(this);" 
                                   oninput="InvalidId(this);" type="text" placeholder="e.g 21WMD02180" pattern="[0-9]{2}[A-Z]{3}[0-9]{5}" value="  <?php echo $studId?>" disabled><br>
                               
                                   <label for="studentID">Student Id <span>*</span></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <input name="firstName" id="firstName" type="text"  maxlength="30" value=  <?php echo $firstName?>disabled><br>
                            <label for="firstName">First Name <span>*</span></label>
                          
                        </div>
                        <div class="col-12 col-sm-6">
                            <input name="lastName" id="lastName" type="text" maxlength="30" value=<?php echo $lastName?> disabled><br>
                            <label for="lastName">Last Name <span>*</span></label>
                            
                        </div>
                    </div>

                    <div class="row">
                    <?php
                        while ($data = mysqli_fetch_array($volunteerWorkResults)) {
                            echo '<label class="col-12 col-sm-3" ><input type="radio" value=' . $data["Volunteer_Work_Id"] . ' name="volunteerWork" required="">' . $data["Work"] . '</label>';
                        }
                        ?>
                    </div>


                    <div class="row">
                        
                             <label class="col-12 col-sm-3" ><input type="radio" value="Engineering" name="volunteerWork" required="">Engineering  </label>
                             <label class="col-12 col-sm-3" ><input type="radio" value="Programmer" name="volunteerWork" required="">Programmer </label>
                             <label class="col-12 col-sm-3" ><input type="radio" value="Crew" name="volunteerWork" required="">Crew</label>
                    </div>
                </div>
                <div class="submitContainer">
                    <div class="col submit">
                        <button class="btn" name="btnSubmit" type="submit">Sign Up</button>
                    </div>
                </div>
            </div>
        </form>
        <script src="volunteerSignup.js"></script> 
        <script src="../cherngherng/homejs.js"></script>
    </body>
</html>
<script>
    function InvalidId(textbox) {
  
  if (textbox.value === '') {
      textbox.setCustomValidity
            ('Entering your Student ID is necessary!');
  } else if (textbox.validity.patternMismatch) {
      textbox.setCustomValidity
            ('Please enter a Student ID which is valid!');
  } else {
      textbox.setCustomValidity('');
  }

  return true;
}

function InvalidZip(textbox) {

  if (textbox.validity.patternMismatch) {
      textbox.setCustomValidity
            ('Please enter a Zip Code which is valid!');
  } else {
      textbox.setCustomValidity('');
      textbox.classList.toggle("correct");
  }

  return true;
}

    let subMenu = document.getElementById("subMenu");

    function togglemenu(){
        subMenu.classList.toggle("open-menu");
    }
</script>
