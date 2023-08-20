<!DOCTYPE html>

<!-- <?php
include 'includes/dbConnector.php';
include 'includes/helper.php';

session_start();

// if (!isset($_SESSION["Student_ID"])) {
//     header("Location: viewRecord.php");
// }

$Student_ID = $_SESSION["Student_ID"];

$loginCommand = "SELECT * FROM booking WHERE Student_Id='$Student_ID'";
$result = mysqli_query($dbConnection, $loginCommand);
?>  -->
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>View Booking Record</title>
        <link href="viewRecord.css" rel="stylesheet" />
        
        <link href="style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
        <link href="nav.css" rel="stylesheet">

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
                  <img src="Images/user3.png" width="50px" class="user-pics" onclick="togglemenu()">
                  <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                    <div class="user-info">
                        <img src="images/user3.png" width="60px">
                        <p><?php echo $studId?></p>
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
            </nav>
          </div>
    </div>
    
        <div class="img-container">
            <a href="../cherngherng/home.php"><img src="../images/web logo.png" alt=""></a>
        </div>
        <section id="cart-header" class="pt-5 mt-5 container">
            <h2 class="font-weight-bold pt-5">Your Booking record</h2>
        </section>

        <section id="cart-container" class="container my-5">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Booking ID</td>
                        <td>Event</td>
                        <td>Price Per Seat</td>
                        <td>Subtotal</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                   <td><h5>ABC123</h5></td>
                    <td><h5><p>Genesis</p></h5></td>
                    <td><h5>RM55</h5></td>
                    <td><h5>RM55</h5></td>
                   <td><h5>Paid</h5></td>
                    </tr>
                    <tr>
                      <td><h5>ABC124</h5></td>
                       <td><h5><p>Noah</p></h5></td>
                       <td><h5>RM25</h5></td>
                       <td><h5>RM25</h5></td>
                      <td><h5>Paid</h5></td>
                    </tr>
                        <tr>
                          <td><h5>ABC123</h5></td>
                           <td><h5><p>Exdodus</p></h5></td>
                           <td><h5>RM30</h5></td>
                           <td><h5>R30</h5></td>
                          <td><h5>Haven't Paid</h5></td>
                           </tr>
                </tbody>
            </table>
        </section>
    </body>
</html>
<script>
  let subMenu = document.getElementById("subMenu");

  function togglemenu(){
      subMenu.classList.toggle("open-menu");
  }
</script>