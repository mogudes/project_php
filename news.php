<html lang="en">
<?php
    include 'includes/dbConnector.php';
    include 'includes/helper.php';
    session_start();
    if (isset($_GET['id'])) {
        $newsId = trim($_GET['id']);

        $dbConnection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $selectCommand = "SELECT * from recentnews where newsId ='$newsId'";

        $result = mysqli_query($dbConnection, $selectCommand);

        if ($result->num_rows == 1) {
            $news = mysqli_fetch_object($result);

            $newsId = $news->newsId;
            $newsTitle = $news->newsTitle;
            $newsArticle = $news->newsArticle;
            $newsImg = $news->newsImage;
            
        }
      
    }
    $studId = $_SESSION['Student_ID'];
    ?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        echo "<title>" . $newsTitle . "</title>";
        ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"  >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>


        <link href="news.css" rel="stylesheet">
        <script src="../homejs.js"  type="text/javascript"defer></script>
        <link rel="icon" href="../../images/homeImages/logo.png" type="image/icon type">
        <link href="nav.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">

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
                    <input type="checkbox" id="show-features">
                    <label for="show-features">Recent News</label>
                  </li>
                  <li>
                    <a href="categoryEventList.php" class="desktop-link">Categories</a>
                    <input type="checkbox" id="show-services">
                    <label for="show-services">Categories</label>
                    <ul>

                        <a href="#" class="desktop-link"></a>
                        <input type="checkbox" id="show-items">
                        <label for="show-items"></label>
                       
                      </li>
                    </ul>
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

    <p style="font-size: medium; padding-left: 10%;padding-right: 10%;">  </p>
    <?php
echo $newsArticle;
?>

                </p>
                <div class="img">

                    <img src="eventImages/<?php echo "$newsImg" ?>">
                </div>


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
                    <a href="#" target="_blank"><i class="fab fa-instagram" ></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
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