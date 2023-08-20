<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>About Us</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="aboutus.css">
<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="http://pro.fontawesome.com/releases/v5.10.0/css/all.css">
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
                        <a href="home.php#article2" class="desktop-link">Recent News</a>
                        <input type="checkbox" id="show-features">
                        <label for="show-features">Recent News</label>
                       
                      </li>
                      <li>
                        <a href="categoryEventList.php#article1" class="desktop-link">Categories</a>
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
                            <img src="images/logout.png" alt="">
                            <a href="Register.php" class="link2">logout</a>
                            <span></span>
                        </a>
                    </div>
                </div>
                </nav>
              </div>
        </div>
            </nav>
          </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="content-section">
                <div class="title">
                    <div class="image-section">
                        <img src="Images/home.jpg" >
                    </div>
                    <h1> About us </h1>

                </div>
                <div class="title2">
                    <h3>The Music Society is founded on 1990. </h3>
                    <p>It have many event such as Noah, Exodus, Genesis and more...The "Music Lovers Society" is a community of music enthusiasts dedicated to promoting the art of music in all its forms. Our mission is to inspire and educate people about the power of music and to create opportunities for musicians to showcase their talent and connect with audiences.

                        At the Music Lovers Society, we believe that music has the power to bring people together, transcend cultural barriers, and enrich our lives in countless ways. Our goals include promoting music education, supporting local musicians, and organizing events that showcase a diverse range of musical genres and styles.
                        
                        Through our programs and events, we provide opportunities for musicians of all ages and levels to showcase their talent and connect with others who share their passion for music. We host regular concerts, workshops, and masterclasses featuring local and international artists, and we also collaborate with schools and community organizations to provide music education programs for young people.
                        
                        Over the years, the Music Lovers Society has become a vibrant and thriving community of music lovers, with members from all walks of life and backgrounds. Our members are passionate about music and are committed to promoting and celebrating its many forms and expressions.
                        
                        Membership in the Music Lovers Society is open to anyone who shares our love of music. To become a member, simply fill out an application on our website and pay a small annual fee. Members have access to a variety of benefits, including discounted event tickets, priority seating at concerts, and invitations to exclusive events and receptions.
                        
                        If you're interested in learning more about the Music Lovers Society or getting involved in our events and programs, please visit our website or contact us via email or social media. Join us in celebrating the power of music and the joy it brings to our lives.    </p>
                  
                </div>
                
                <div class="button">
                    <a href="#">Read more</a>
                </div>
                <div class="social">
                    <a href="https://www.facebook.com/tarucmusicsociety/" target="_blank"><i class="fab fa-facebook-square"></i></a>
                    <a href="https://www.instagram.com/taruc_official/?hl=en" target="_blank"><i class="fab fa-instagram" ></i></a>
                    <a href="https://twitter.com/tarucperak" target="_blank"><i class="fab fa-twitter"></i></a>   
                </div>
               
            </div>
          
        </div>
        
    </div>
</body>
<!-- <div id="footer" class="container-fluid">

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
</div> -->
</html>