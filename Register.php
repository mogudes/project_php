<!DOCTYPE html>
<?php
//after register direct to another form to fill in and baru direct to home page
session_start();
include 'includes/dbConnector.php';
if (!$dbConnection) {
    echo "CONNECTION FAILED";
}

if (isset($_POST['btnRegister'])) {
    $emailAddr = isset($_POST['email']) ? trim($_POST['email']) : "";
    $pass1 = isset($_POST['password1']) ? trim($_POST['password1']) : "";
    $pass2 = isset($_POST['password2']) ? trim($_POST['password2']) : "";

    function validatePass1And2($pass1, $pass2) {
        //return true if pass1 and 2 is different
        if (strcmp($pass1, $pass2) != 0) {
            return true;
        } else {
            return false;
        }
    }

    //step one by one //email format no need bc ady do in html
    if (empty($emailAddr)) {
        //pass error message to error
        header("Location: register.php?error=Student email cannot be empty");
        exit();
    } else if (empty($pass1) || empty($pass2)) {
        header("Location: register.php?error=Password cannot be empty");
        exit();
    } else if (validatePass1And2($pass1, $pass2) == true) {
        header("Location: register.php?error=Confirm password must be same with password");
        exit();
    } else {
        $existsEmailCommand = "SELECT * FROM student WHERE Email='$emailAddr' ";
        $result = mysqli_query($dbConnection, $existsEmailCommand);
        $passwordPattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/";

        //email exists --> cannot register
        if (mysqli_num_rows($result) == 1) {
            header("Location: Register.php?error=This email already registered");
            exit();
        } else if (preg_match($passwordPattern, $pass1) == FALSE) {
            header("Location: Register.php?error=Password require at least 8 till 20 charectors which at least contain one letter and number");
            exit();
        } else if (mysqli_num_rows($result) == 0) {
            $registerCommand = "INSERT INTO student(Email, password) values ('$emailAddr', '$pass1') ";
            $result2 = mysqli_query($dbConnection, $registerCommand);
            header("Location: userInformation.php?email=$emailAddr");
            exit();
        }
    }
}else if (isset($_POST['btnLogin'])) {

  $emailAddr = isset($_POST['email']) ? trim($_POST['email']) : "";
  $password = isset($_POST['password']) ? trim($_POST['password']) : "";

  if (empty($emailAddr)) {
      //pass error message to error
      header("Location: Register.php?error=Student email cannot be empty");
      exit();
  } else if (empty($password)) {
      //pass error message to error
      header("Location: Register.php?error=Password cannot be empty");
      exit();
  } else {
      //sql command
      $loginCommand = "SELECT * FROM student WHERE Email='$emailAddr' AND Password='$password' ";
      $result = mysqli_query($dbConnection, $loginCommand);

      if (mysqli_num_rows($result) === 1) {
          $row = mysqli_fetch_assoc($result);
          if ($row['Email'] == $emailAddr && $row['Password'] == $password) {

            if($row['type'] == 0){
              header("Location:admin/adminAdd.php");
              exit();
            }else if($row['type'] == 1){
              $_SESSION['Email'] = $row['Email'];
              $_SESSION['Student_ID'] = $row['Student_Id'];
              header("Location: home.php");
              exit();
            }

          } else {
              header("Location: Register.php?error=Invalid username or password");
              exit();
          }
      } else {
          header("Location:Register.php?error=Invalid username or password");
          exit();
      }
  }
}
?>


<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Register.css" />
    <link rel="stylesheet" href="errorMsg.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>Login and Register</title>
    
  </head>
  <body>
  <?php if (isset($_GET['error'])) { ?>
                    <p class="invalid_msg"><?php echo $_GET['error']; ?></p>
<?php } ?>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fa fa-envelope"></i>
              <input type="email" placeholder="Email" name="email"pattern="[A-Za-z1-9]{1, 30}@student.tarc.edu.my" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password"required/>
            </div>
            <input type="submit" value="Login" name="btnLogin" class="btn solid">
          </form>


          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="sign-up-form">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" pattern="[A-Za-z1-9]{1, 30}@student.tarc.edu.my"required/>
            </div> 
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password1"required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Confirm Password" name="password2"required/>
            </div>
           
            <input type="submit" class="btn" name="btnRegister" value="Sign up" />
            
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
             HALO
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="#" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              HALO
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="" class="image" alt="" />
        </div>
      </div>
    </div>
  </body>
  <footer>
    
  </footer>
  
</html>
<script>
const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");
    
    sign_up_btn.addEventListener("click", () => {
      container.classList.add("sign-up-mode");
    });
    
    sign_in_btn.addEventListener("click", () => {
      container.classList.remove("sign-up-mode");
    });</script>