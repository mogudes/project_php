<!DOCTYPE html>
<?php
include 'includes/dbConnector.php';
include 'includes/helper.php';
if (!$dbConnection) {
    echo "CONNECTION FAILED";
}
session_start();
$email=$_GET['email'];
if (isset($_POST['email'])) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    echo $email;
    if (isset($_POST['btnSubmit'])) {
        //get the email from the student just successfully registered
        $fname = isset($_POST['fname']) ? trim($_POST['fname']) : "";
        $lname = isset($_POST['lname']) ? trim($_POST['lname']) : "";
        $studentID = isset($_POST['studentID']) ? trim($_POST['studentID']) : "";
        $phoneNo = isset($_POST['phoneNo']) ? trim($_POST['phoneNo']) : "";
        $address = isset($_POST['address']) ? trim($_POST['address']) : "";
        $postCode = isset($_POST['postCode']) ? trim($_POST['postCode']) : "";
        $city = isset($_POST['city']) ? trim($_POST['city']) : "";
        $state = isset($_POST['state']) ? trim($_POST['state']) : "";
        $confirm = isset($_POST['confirm']) ? trim($_POST['confirm']) : "";

            $updateCommand = "UPDATE student SET Student_Id = '$studentID', First_Name = '$fname', Last_Name = '$lname', Phone_No = '$phoneNo', Address = '$address', Postcode = '$postCode', City = '$city', State = '$state' WHERE Email='$email' ";
            $result = mysqli_query($dbConnection, $updateCommand);
            header("Location: Register.php");
            exit();
    }
}
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>
        <div class="conMsg">

            <h2>Congratulation!!! You have registered successfully</h2>
        </div>


        <div class="container">
            <span>*This is a auto-direct page if you are a <b>new registered user</b></br></span>
            <span>*Any information required is just for better using experienc and would not share to third party</span>
            <h1>Please fill in the form to let us know more about you</h1>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                <div class="row">
                    <div class="col-25">
                        <label for="fname">First Name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="fname" placeholder="Your name.." required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">Last Name</label>
                    </div>
                    <div class="col-75">
                        <input type="text"  name="lname" placeholder="Your last name.." required>
                    </div>
                </div>
                <?php 
                echo " <input type= 'email'  name='email' hidden value = ".$email.">";
                ?>
                <div class="row">
                    <div class="col-25">
                        <label for="studentID">Student ID</label>
                    </div>
                    <div class="col-75">
                        <input type="text"  name="studentID" placeholder="Your Student ID.." required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="phoneNo">Phone No</label>
                    </div>
                    <div class="col-75">
                        <input type="text"  name="phoneNo" placeholder="Your phone number.." required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="address">Address</label>         
                    </div>
                    <div class="col-75">
                        <textarea id="subject" name="address" placeholder="Write address here.." style="height:200px"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="postCode">Postcode</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="postCode" placeholder="Postcode.." required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="city">City</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="city" placeholder="City you live.." required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="state">State</label>
                    </div>
                    <div class="col-75">
                        <input type="text"  name="state" placeholder="State" required>
                    </div>
                </div> 
                <div>
                    <input type="checkbox" value="confirm" name="confirm">
                    <label for="confirm">I have double check and confrm that the information provided is accurate and correct. </label>

                    <?php if (isset($_GET['error'])) { ?>
                        <p class="invalid_msg"><?php echo $_GET['error']; ?></p>
                    <?php } ?>  
                  
                </div>

                <div class="row">
                    <input type="submit" value="Submit and back to login page" name="btnSubmit">
                </div>
            </form>
        </div>

    </body>
</html>

<style>
    img.logo{
        width:20%;
    }

    div.conMsg{
        background-image: linear-gradient(to bottom right, #DDA0DD 50% , #FAEBD7 );
        border-radius:5px;
        opacity:0.95;
    }

    body {
        box-sizing: border-box;
        background-image: url(wallpaperflare.com_wallpaper.jpg);
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        background-size: cover;
    }

    body div h2{
        color:white;
        text-align: center;
        margin:10px;
        padding:10px;
    }

    input[type=text], select, textarea {
        width: 95%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }

    label {
        padding: 12px 12px 12px 0;
        display: inline-block;
    }

    input[type=submit] {
        background-color: #04AA6D;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
        margin-top:20px;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
        opacity:0.98;
    }

    .container span{
        color:grey;
        font-size: smaller;
    }

    .col-25 {
        float: left;
        width: 25%;
        margin-top: 6px;
    }

    .col-75 {
        float: left;
        width: 75%;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
        .col-25, .col-75, input[type=submit] {
            width: 100%;
            margin-top: 0;
        }
    }

    p.invalid_msg{
        color:red;
        font-size:smaller;
        text-align: center;
    }
</style>