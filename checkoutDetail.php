<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width-device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="checkoutDetail.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="nav.css" rel="stylesheet">
        <title>Detail</title>
    </head>

        <body>
            <?php
            $pageTitle = "Checkout(detail)";
            include 'includes/dbConnector.php';
            include 'includes/helper.php';
            ?>
        
            <?php
            session_start();  //important
        
            if (isset($_GET['eventId'])) {
                $eventId = trim($_GET['eventId']);
            }
            
            if (isset($_POST['btnCheckout'])) {
      
                $price  = $_POST['count'];
                $quantity= $_POST['finalAmount'];
        
                $_SESSION["QUANTITY"] = $quantity;
                $_SESSION["PRICE"] = $price;
        
                $studId = $_SESSION['Student_ID'];
                $eventParticipant = $_SESSION['EVENT_PARTICIPANT'];
                
                if ($quantity <= $eventParticipant) {
        
                    $updatedParticipant = $eventParticipant - $quantity;
        
                    //update
                    $updateParticipantCommand = "UPDATE event SET Participant = $updatedParticipant WHERE Event_Id = '$eventId'";
                    $updateParticipantResult = mysqli_query($dbConnection, $updateParticipantCommand);
        
                    $bookingIdPrefixes = "B";
        
                    $selectCommand = "SELECT count(*) as count FROM booking";
                    $bookingResult = mysqli_query($dbConnection, $selectCommand);
                    $bookingCounts = intval(mysqli_fetch_all($bookingResult, MYSQLI_ASSOC)[0]['count']);
                    $bookingCounts += 1;
                    $bookingId = $bookingIdPrefixes . str_pad($bookingCounts, 3, '0', STR_PAD_LEFT);
        
                    $insertBookingCommand = "INSERT INTO booking(Booking_Id , Student_Id , Event_Id , Price , Quantity , Status) values ('$bookingId','$studId','$eventId','$price','$quantity' ,'Pending')";
                    $bookingResults = mysqli_query($dbConnection, $insertBookingCommand);
        
                    $insertArchiveBookingCommand = "INSERT INTO archive_booking(Booking_Id , Student_Id , Event_Id , Price , Quantity , Status) values ('$bookingId','$studId','$eventId','$price','$quantity' ,'Pending')";
                    $bookingArchiveResults = mysqli_query($dbConnection, $insertArchiveBookingCommand);
        
                    $_SESSION["BOOKINGID"] = $bookingId;
                    $_SESSION["EVENTID"] = $eventId;
                } 
                else {
                    header("Location: seatBook.php?error=Number of selected slots cannot be greated than what we could offer.");
                }
            }
            ?>

    


    <div class="progress-checkout-container">
        <div class="progress-step-container">
            <div class="step-check"></div>
            <span class="step-title">Detail</span>
        </div>
        <div class="progress-step-container">
            <div  class="step-check"></div>
            <span class="step-title">Payment</span>
        </div>
        <div class="progress-step-container">
            <div class="step-check"></div>
            <span class="step-title">Review</span>
        </div>
    </div>


    <h2 class="form-title">Personal Information</h2>
    <div class="form-container">

        <form method="POST" action="checkoutPayment.php"  class="was-validated" >
            <div class="input-line">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" maxlength="30" pattern="[a-z A-Z]{1,30}" required="true" 
                       value="" />
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>


            <div class="input-line">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" pattern="[a-z]{1,30}-[a-z]{2}[0-9]{2}@student.tarc.edu.my" placeholder="casper-wm21@student.tarc.edu.my"  required="true" 
                       value="" />
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>


            <div class="input-container">
                <div class="input-line">
                    <label for="state"  class="form-label">State</label>
                    <input type="text" class="form-control"  name="state" id="state" placeholder="e.g Kuala Lumbur" pattern="[a-z A-Z]{1,30}"  required="true" 
                           value="" />
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>



                <div class="input-line">
                    <label for="postcode" class="form-label">Postcode</label>
                    <input type="text" class="form-control" name="postcode" id="postcode" pattern="[0-9]{5}" maxlength="5" placeholder="53300"  required="true" 
                           value="" />
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>

            <div class="input-container"> 
                <a href="eventInfo.php">
                    <input type="button" name="btnCancel" value="CANCEL"
                           onclick=" location.href='eventInfo.php'"/> 
                </a>
                <a href=""><input type="submit" name="btnSubmit"  value="PROCEED" /></a>
            </div>
        </form>

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