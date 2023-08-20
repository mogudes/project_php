<?php
include 'includes/dbConnector.php';
include 'includes/helper.php';

$selectCommand = "SELECT * FROM recentnews";
session_start();
$studId= $_SESSION['Student_ID'];
$results = mysqli_query($dbConnection, $selectCommand);
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"  >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>


        <link href="home.css" rel="stylesheet">
        <link href="nav.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">


        <link rel="icon" href="homeImages/logo.png" type="image/icon type">
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
                      <li><a href="#footer">Contact Us</a></li>
                      <li>
                        <a href="home.php#article2" class="desktop-link">Recent News</a>
                        <input type="checkbox" id="show-features">
                        <label for="show-features">Recent News</label>
                       
                      </li>
                      <li>
                        <a href="home.php#article1" class="desktop-link">Categories</a>
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
                  <img src="Images/user3.png" width="50px" class="user-pics" onclick="togglemenu()">
                  <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                        <img src="Images/user3.png" width="60px">
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
            
          </div>
        <div id="content1" style="background-image: url('home.jpg');">
            <div id="welcome-text">
                <div>
                    <h2>Music Society</h2>

                    <p>Welcome to TARUC Music Society. A place where passion and talent meets. Music Club is fun and stimulating, amusing activities like learning new dance and playing music provides a healthy, natural and invaluable opportunity for individual expression.</p>            
                </div>
                <div>
                    <a href=""><button type="button" class="btn btn-light">Join Us</button></a>
                    

                </div>   

            </div>
            <div id="scroll-down">
                <div class="arrow" >
                    <div class="arrow-left"></div>
                    <div class="arrow-right"></div>

                </div>
                <div class="arrow" >
                    <div class="arrow-left"></div>
                    <div class="arrow-right"></div>
                </div>
                <p>Scroll Down</p>            
            </div>
        </div>  
        <div id="article1">
            <h1 id="page1-heading">Categories</h1>
            <div class="category-slide">
                <div class="card mx-1 slide" style="width: 18rem;">
                    <img class="card-img-top" src="admin/eventImages/piano.jpg" alt="Piano Society">
                    <div class="card-body">
                        <h5 class="card-title">Piano</h5>
                        <p class="card-text">Classical and pop piano playing style</p>
                        <div>
                            <a href="categoryEventList.php?category=piano" class="d-block w-auto btn btn-primary mx-auto">Join Now</a>

                        </div>
                    </div>
                </div>
                <div class="card mx-1 slide" style="width: 18rem;">
                    <img class="card-img-top" src="admin/eventImages/guitar.jpg" alt="Guitar Society">
                    <div class="card-body">
                        <h5 class="card-title">Guitar</h5>
                        <p class="card-text">Acoustic Guitar, Electric Guitar, Classical Guitar and Bass</p>
                        <div>
                            <a href="categoryEventList.php?category=guitar" class="d-block w-auto btn btn-primary mx-auto">Join Now</a>

                        </div>
                    </div>
                </div>
                <div class="card mx-1 slide" style="width: 18rem;">
                    <img class="card-img-top" src="admin/eventImages/drum.jpg" alt="Drum Society">
                    <div class="card-body">
                        <h5 class="card-title">Drum</h5>
                        <p class="card-text">Profesional lessons and jamming sessions with other music instruments</p>
                        <div>
                            <a href="" class="d-block w-auto btn btn-primary mx-auto">Join Now</a>

                        </div>
                    </div>
                </div>
                <div class="card mx-1 slide" style="width: 18rem;">
                    <img class="card-img-top" src="admin/eventImages/violin.jpg" alt="Violin Society">
                    <div class="card-body">
                        <h5 class="card-title">Violin</h5>
                        <p class="card-text">Violin, Viola , Cello and Double Bass. String Orchestra are available once a month </p>
                        <div>
                            <a href="" class="d-block w-auto btn btn-primary mx-auto">Join Now</a>

                        </div>
                    </div>
                </div>
                <div class="card mx-1 slide" style="width: 18rem;">
                    <img class="card-img-top" src="admin/eventImages/vocal.jpg" alt="Vocal Society">
                    <div class="card-body">
                        <h5 class="card-title">Vocal</h5>
                        <p class="card-text">Vocal lessons from the best vocalist and jamming sessions with other musicians.</p>
                        <div>
                            <a href="" class="d-block w-auto btn btn-primary mx-auto">Join Now</a>

                        </div>
                    </div>
                </div>
                <div class="card mx-1 slide" style="width: 18rem;">
                    <img class="card-img-top" src="admin/eventImages/otherActivities.jpg" alt="Others">
                    <!-- alt should be see more ? -->
                    <div class="card-body">
                        <h5 class="card-title">Other Activities</h5>
                        <p class="card-text">Check out our activities and join them!</p>
                        <div>
                            <a href="" class="d-block w-auto btn btn-primary mx-auto">See More..</a>


                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div id="article2" >
            
           
            <div class="category-slide">
            <?php
while ($row = mysqli_fetch_array($results)) {

    $shortArticle = substr($row['newsArticle'], 0, 30);
    echo "<div class='card mx-1 slide' style='width: 18rem;'>";
    echo"<img class='card-img-top' src='./eventImages/" . $row['newsImage'] . "' alt=''>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>" . $row['newsTitle'] . "</h5>";
    echo"<p class='card-text'>" . $shortArticle . "<a href='news.php?id=" . $row['newsId'] . "'>See More...</a></p>";
    echo "</div></div>";
}
?>
            </div>
        </div>


        <div id="aboutus-container" class="container-fluid p-3 ">
            <h1>About Us</h1>
            <div id="aboutus" >
                <p>Music Society is founded in 1972. Main goal of Music Society is to provide a platform for music lovers to express themselves and improve thier musical ability and mentality. We had participate in many major music performance over the years and our facility has been improved a lot since 1972. We have over 10,000 members since 1972 and in this year will be our 50th anniversary. </p>
            </div>
            <div class="container d-flex  " id="about-us-img">
                <div class="col-4"><img src="eventImages/societyPic1.jpg" width="100%" height="100%"></div>
                <div class="col-4"><img src="eventImages/societyPic2.jpg" width="100%" height="100%"></div>
                <div class="col-4"><img src="eventImages/societyPic3.jpg" width="100%" height="100%"></div>

            </div>


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
  