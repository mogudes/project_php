<html lang="en">
  <?php
  include 'includes/dbConnector.php';
  include 'includes/helper.php';
  session_start();
  $studId= $_SESSION['Student_ID'];
  if (isset($_GET['category'])) {
    $eventCategory = trim($_GET['category']);

    $dbConnection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $selectCommand = "SELECT * from event where Event_Category ='$eventCategory' ";

    $result = mysqli_query($dbConnection, $selectCommand);
}
  ?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        echo "<title>" . $eventCategory . "</title>";
        ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"  >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
        <link href="categoryEventList.css" rel="stylesheet">
        <script src="../homejs.js"  type="text/javascript"defer></script>
        <link rel="icon" href="../../images/homeImages/logo.png" type="image/icon type">
        <link href="nav.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <title>CategoryEventList  </title>
    </head>
    <body>
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
              <img src="user3.png" width="50px" class="user-pics" onclick="togglemenu()">
              <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                    <img src="user3.png" width="60px">
                    <p> <?php echo $studId ;?></p>
                    </div>
                    <hr>
                 

          
                   

                    <a href="#" class="sub-menu-link">
                        <img src="logout.png" alt="">
                        <a href="Register.php" class="link2">logout</a>
                        <span></span>
                    </a>
                </div>
            </div>
            </nav>
          </div>
    </div>
    <div id="content">


<?php

  $eventCategory = trim($_GET['category']);

  $dbConnection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  $selectCommand = "SELECT * from event where Event_Category ='$eventCategory' ";

  $result = mysqli_query($dbConnection, $selectCommand);
while ($row = mysqli_fetch_array($result)) {
//            dd($row['Event_Id']);
    echo "<div class='eventList'>";
    echo " <div class='left'>";
    echo"<div class='eventImg'>";
    echo " <img src='../eventImages/" . $row['Img1'] . "' width='100%' height='100%'>";
    echo "</div></div>";
    echo "<div class='right'>";
    echo "<div class='eventTitle'> <a href='MusicSociety_LiewKimWah/MusicSociety_LiewKimWah/eventInfo.php?eventId=" . $row['Event_Id'] . "'>";
    echo $row['Event_Title'];
    echo "</a></div>";
    echo "<div class='eventDescription'>";
    echo $row['Description'];
    echo "</div></div>";

    echo " <div class='btnContainer'>";
    echo "<a href='eventInfo.php?eventId=" . $row['Event_Id'] . "'><button>Learn More</button></a>";
    echo "</div>";
    echo "</div></div>";
}
?>
        <div id="footer" class="container-fluid">

          <div class="col-6">
              <div id="newsletter">
                  <b>Newsletter</b><br>
                  <form action="#">                
                      <input id="email-input" type="email" name="email" placeholder="Join our newsletter for updates!">
                      <button class="w-auto btn btn-light"><i class="fas fa-check"></i></button>
                  </form>
              </div>
              <div id="address">
                  <p><b>Address</b></p>
                  <a href="https://goo.gl/maps/DxoFRMWT5c8APkYr5"><small>Jalan Genting Kelang, Setapak,<br>
                          53300 Kuala Lumpur,<br>
                          P.O. Box 10979, 50932 Kuala Lumpur, Malaysia.</small></a>
              </div>
          </div>
          <div class="col-6">
              <div id="contact">
                  <p><b>Contact Us</b></p>
                  <a href="tel:0123456789"><i class="fas fa-phone"></i> 012-3456789</a><br>
                  <a href="mailto:musicsociety@tarc.edu.my"><i class="fas fa-envelope"></i> musicsociety@tarc.edu.my</a>
              </div>

              <div id="socialmedia">
                  <p><b>Social Media Links</b></p>
                  <a href="https://www.facebook.com/tarucmusicsociety/" target="_blank"><i class="fab fa-facebook-square"></i></a>
                  <a href="https://www.instagram.com/taruc_official/?hl=en" target="_blank"><i class="fab fa-instagram" ></i></a>
                  <a href="https://twitter.com/tarucperak" target="_blank"><i class="fab fa-twitter"></i></a>
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