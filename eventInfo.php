<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <title>Event</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
        <link rel="stylesheet" href="eventInfo.css" />
        <link href="nav.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">

    </head>
    <body>
    <?php
    session_start();
    $studId= $_SESSION['Student_ID'];
        include 'includes/dbConnector.php';
        include 'includes/helper.php';

        if (isset($_GET['eventId'])) {
            $eventId = $_GET['eventId'];

            $selectEventCommand = "SELECT * FROM event WHERE Event_Id = '$eventId'"; //////
            $eventResults = mysqli_query($dbConnection, $selectEventCommand);
            $eventData = mysqli_fetch_object($eventResults);

            $eventName = $eventData->Event_Title;
            $eventDes = $eventData->Description;
            $eventLearn1 = $eventData->Learn1;
            $eventLearn2 = $eventData->Learn2;
            $eventLearn3 = $eventData->Learn3;

            $eventImg1 = $eventData->Img1;
            $eventImg2 = $eventData->Img2;
            $eventImg3 = $eventData->Img3;
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
                        <p> <?php echo $studId ;?></p>
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
        
        <div class="body-container">
            <div class="description-body container-fluid">
                <div class="row des-row">
                    <div class="description col-12 col-lg-8 p-4">
                        <h3> <?php
                            global $eventName;
                            echo $eventName;
                            ?> Event
                        </h3>
                        <div class="introduction">
                            <p>
                                ><?php
                                global $eventDes;
                                echo $eventDes;
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="participate col-12 col-lg-4 p-4 align-self-center">
                        <div class="participate-btn">
                        <a href="./seatBook.php?eventId=<?php echo $eventId; ?>"><button class="btn" type="submit">Book Now</button></a>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row py-4 gy-4 event-description">
                    <div class="col-12">
                        Images of Our Guest !!!
                    </div>
                </div>
                <div class="row g-3 justify-content-center">
                    <div class="col-8 col-lg-4">
                        <div class="card shadow-sm">
                            <img src='eventImages/<?php echo $eventImg1; ?>' width='100%' height='100%'>
                        </div>
                    </div>
                    <div class="col-8 col-lg-4">
                        <div class="card shadow-sm">
                            <img src='eventImages/<?php echo $eventImg2; ?>' width='100%' height='100%'>
                        </div>
                    </div>
                    <div class="col-8 col-lg-4">
                        <div class="card shadow-sm">
                            <img src='eventImages/<?php echo $eventImg3; ?>' width='100%' height='100%'>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="knowledge py-5">
            <div class="container knowledge-body">
                <div class="row">
                    <div class="col knowledge-title">
                        <h4>What you'll learn</h4>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-4 text-center">
                            <p><i class="fa-solid fa-check"></i> 
                            <?php
                                global $eventLearn1;
                                echo $eventLearn1;
                                ?>
                            </p>
                        </div>
                        <?php
                            global $eventLearn2;
                            if ($eventLearn2 != '') {
                                echo '<div class="col-12 col-md-4 text-center">';
                                echo '<p><i class="fa-solid fa-check"></i>    ' . $eventLearn2 . '</p>';
                                echo '</div>';
                            }

                            global $eventLearn3;
                            if ($eventLearn3 != '') {
                                echo '<div class="col-12 col-md-4 text-center">';
                                echo '<p><i class="fa-solid fa-check"></i>    ' . $eventLearn3 . '</p>';
                                echo '</div>';
                            }
                            ?>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


    
</body>
</html>
<script>
    let subMenu = document.getElementById("subMenu");

    function togglemenu(){
        subMenu.classList.toggle("open-menu");
    }
</script>