<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width-device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="checkoutPayment.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="nav.css" rel="stylesheet">
        <title>Payment</title>
    </head>



        <body>
        <?php
    $pageTitle = "Checkout(payment)";

    include 'includes/dbConnector.php';
    include 'includes/helper.php';
    session_start();  //important

    if (isset($_POST['btnSubmit'])) {

        $paymentIdPrefixes = "P";

        $selectCommand = "SELECT count(*) as count FROM payment";
        $paymentResult = mysqli_query($dbConnection, $selectCommand);
        $paymentCounts = intval(mysqli_fetch_all($paymentResult, MYSQLI_ASSOC)[0]['count']);
        $paymentCounts += 1;
        $paymentId = $paymentIdPrefixes . str_pad($paymentCounts, 3, '0', STR_PAD_LEFT);

        $Booking_Id = $_SESSION["BOOKINGID"];

        $name = isset($_POST['name']) ? trim($_POST['name']) : "";
        $email = isset($_POST['email']) ? trim($_POST['email']) : "";
        $state = isset($_POST['state']) ? trim($_POST['state']) : "";
        $postcode = isset($_POST['postcode']) ? trim($_POST['postcode']) : "";

        $insertPaymentCommand = "INSERT INTO Payment (Payment_Id, Booking_Id , Name, Email, State, Postcode ) VALUES ('$paymentId','$Booking_Id','$name', '$email', '$state', '$postcode' )";
        $paymentQueriesResult = mysqli_query($dbConnection, $insertPaymentCommand);

        $_SESSION["PAYMENTID"] = $paymentId;
    }
    ?>

    <div class="progress-checkout-container">
        <div class="progress-step-container">
            <div class="step-check"></div>
            <span class="step-title">Detail</span>
        </div>
        <div class="progress-step-container">
            <div class="step-check1"></div>
            <span class="step-title">Payment</span>
        </div>
        <div class="progress-step-container">
            <div class="step-check"></div>
            <span class="step-title">Review</span>
        </div>
    </div>


    <h2 class="form-title">Choose Payment Method</h2>
    <div class="form-container">



        <form class="was-validated" method="" action="checkoutReview.php" >
            <div class="input-container"> 
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio1" name="PaymentMethod" value="Debit Card" checked>
                    <label class="form-check-label" for="radio1">Debit card
                    </label>
                    &nbsp;
                    <img src="Images/card.png" width="50" height="30">
                </div>

                &emsp;
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio2" name="PaymentMethod" value="Credit Card">
                    <label class="form-check-label" for="radio2">Credit card
                    </label>
                    &nbsp;
                    <img src="Images/card1.png" width="40" height="30">
                </div>&emsp;


                <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio2" name="PaymentMethod" value="Online Banking">
                    <label class="form-check-label" for="radio2">Online banking
                    </label>
                    &nbsp;
                    <img src="Images/card2.png" width="40" height="30">
                </div>
            </div>




            <div class="input-line">  
                <label for="card" class="form-label">Card number</label>
                <input type="text"  class="form-control" name="CardNumber" id="card" placeholder="1111-2222-3333-4444" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}" required="true" 
                       value="" />
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>


            <div class="input-container">
                <div class="input-line">
                    <label for="card" class="form-label">Expiring Date</label>
                    <input type="text" class="form-control" name="ExpiringDate" id="date" placeholder="09-21" pattern="[0-9]{2}-[2][0-9]" required="true" 
                           value="" />
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>


                <div class="input-line">
                    <label for="cvc" class="form-label">CVC</label>
                    <input type="text"  class="form-control" name="CVC" id="cvc" placeholder="***" pattern="[0-9]{3}" required="true" 
                           value="" />
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>



            <div class="col-12">
                <div class="form-check"></div>
                <div class="form-check">
                    <input id="safeInfo" type="checkbox" class="form-check-input" required/>
                    <label class="form-check-label" for="safeInfo"
                           >I agree on this term.</label>
                </div>
            </div>
            <br>



            <div class="input-container">
                <a href="checkoutDetail.php">
                    <input type="button"  name="btnCancel" value="CANCEL" 
                           onclick="location = 'checkoutDetailInfo.php'"/> 
                </a>


                <a href=""><input type="submit" name="btnSubmit" value="PROCEED" /></a>
            </div>
        </form>
    </div>
</div>

</body>
</html>