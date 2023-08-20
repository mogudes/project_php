<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Review</title>
    <link rel="stylesheet" href="startrating.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
      rel="styleshhet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="checkoutReview.css" />
    <link href="nav.css" rel="stylesheet">
  </head>
  <body>
     
      

  <?php
  session_start();
 $pageTitle = "Checkout(payment)";
 $studId= $_SESSION['Student_ID'];
      include 'includes/dbConnector.php';
      include 'includes/helper.php';
  //important
          $price =  $_SESSION["PRICE"];
          $bookingId = $_SESSION["BOOKINGID"];
          $Payment_Id = $_SESSION["PAYMENTID"];
      // Check if submit button is clicked to send POST request
      if (isset($_POST['btnSubmit'])) {
        
          
          $PaymentMethod = isset($_POST['PaymentMethod']) ? trim($_POST['PaymentMethod']) : "";
          $CardNumber = isset($_POST['CardNumber']) ? trim($_POST['CardNumber']) : "";
          $ExpiringDate = isset($_POST['ExpiringDate']) ? trim($_POST['ExpiringDate']) : "";
          $CVC = isset($_POST['CVC']) ? trim($_POST['CVC']) : "";  

          $insertCommand = "UPDATE payment SET Payment_Method='$PaymentMethod', Card_Number ='$CardNumber ', Expiring_Date='$ExpiringDate',CVC='$CVC', Total = '$price' WHERE Payment_Id = '$Payment_Id'";
     
          $result = mysqli_query($dbConnection, $insertCommand);
      
      }
      ?>
    <div class="alert alert-success">
      <strong>Success!</strong> your transaction have been successfully.
  </div>
      
      
    <div class="table">
      <div class="row first-row">
        <div class="col-4 col-sm-4">
        <p>1</p>
        </div>
        <div class="col-4 col-sm-4">
        <p><?php echo $bookingId; ?></p>
        </div>
        
        <div class="col-6 col-sm-4">
        <p><?php echo $price; ?></p>
        </div>

      </div>
        

        
      <div class="row">
        <div class="col-4 col-sm-4">
          <p>1</p>
        </div>
        <div class="col-4 col-sm-4">
        <p> <?php echo $studId ;?></p>
        </div>

        <div class="col-6 col-sm-4">
          <p><?php echo $price ;?></p>
        </div>

      </div>
        
        
      
        
    </div>

 

<script type="text/javascript">
        function disableBack() { window.history.forward(); }
        setTimeout("disableBack()", 0);
        window.onunload = function () { null };
    </script>


    <div>
      <a href="home.php"><button type="button" class="btn btn-primary active">
        Go back to home page
      </button></a>
      
    </div>
  </body>
</html>
<script>
    

var numberOfRecords = document.querySelectorAll(".toggle").length;

for(var i = 0 ; i < numberOfRecords ; i ++ ){
    document.querySelectorAll(".toggle")[i].addEventListener("click",function(){
        var studId = "student"+this.getAttribute("data-studNo");
        // console.log(studId);
        var element = document.getElementById(studId);

        element.classList.toggle("hidden");
        
    })
}
</script>
