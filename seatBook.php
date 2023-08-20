<!DOCTYPE html>
<?php 
include 'includes/dbConnector.php';
include 'includes/helper.php';
session_start();
$studId = $_SESSION['Student_ID'];

?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="seatBook.css" />
    <link rel="stylesheet" href="nav.css" />

    <title>Movie Seat Booking</title>
  </head>
  <body>
    <div class="movie-container">
      <label> Select a movie:</label>
      <select id="movie">
        <?php $selectEventCommand = "SELECT * FROM event;"; //////
            $eventResults = mysqli_query($dbConnection, $selectEventCommand);
            $resultCheck = mysqli_num_rows($eventResults);
            $count = -1;
            $name;
            if($resultCheck > 0){
              while($row = mysqli_fetch_assoc($eventResults)){
                $count++;
                if($_GET['index'] == $count){
                  $name = $row['Event_Id'];
                  $_SESSION ['EVENT_PARTICIPANT'] = $row['Participant'];
                }
                echo '<option value="'.$row['Price'].'">'.$row['Event_Title'].'</option>';
                
              }
            }
            ?>
      </select>
    </div>
    <form action="checkoutDetail.php?eventId=<?php echo $name;?>" method="post">
    <ul class="showcase">
      <li>
        <div class="seat"></div>
        <small>Available</small>
      </li>
      <li>
        <div class="seat selected"></div>
        <small>Selected</small>
      </li>
      <li>
        <div class="seat sold"></div>
        <small>Sold</small>
      </li>
    </ul>
    <div class="container">
      <div class="screen"></div>

      <div class="row">
      <?php 
        $selectSeatCommand = "SELECT * FROM seat WHERE Event_Id = '".$name."';"; //////
        $seatResults = mysqli_query($dbConnection, $selectSeatCommand);
    

        while($row = mysqli_fetch_assoc($seatResults)){
          $count = $row['SeatID'];
          if($count <= 8){
          echo "<input type='checkbox' value=".$row['SeatID']." id=".$row['SeatID']." name='seats[]' hidden>
          <label for=".$row['SeatID']." class='".$row['Status']."' ></label>";
          }
        }
        ?>
      
      </div>

      <div class="row">
        <?php
          $selectSeatCommand = "SELECT * FROM seat WHERE Event_Id = '".$name."';"; //////
          $seatResults = mysqli_query($dbConnection, $selectSeatCommand);
        while($row = mysqli_fetch_assoc($seatResults)){
          $count = $row['SeatID'];
          if($count > 8 && $count <=16){
            echo "<input type='checkbox' value=".$row['SeatID']." id=".$row['SeatID']." name='seats[]' hidden>
            <label for=".$row['SeatID']." class='".$row['Status']."' ></label>";
          }
        }?>
      
      </div>
      <div class="row">
      <?php
          $selectSeatCommand = "SELECT * FROM seat WHERE Event_Id = '".$name."';"; //////
          $seatResults = mysqli_query($dbConnection, $selectSeatCommand);
        while($row = mysqli_fetch_assoc($seatResults)){
          $count = $row['SeatID'];
          if($count > 16 && $count <=24){
            echo "<input type='checkbox' value=".$row['SeatID']." id=".$row['SeatID']." name='seats[]' hidden>
            <label for=".$row['SeatID']." class='".$row['Status']."' ></label>";
          }
        }?>
      </div>
      <div class="row">
      <?php
         $selectSeatCommand = "SELECT * FROM seat WHERE Event_Id = '".$name."';"; //////
         $seatResults = mysqli_query($dbConnection, $selectSeatCommand);
        while($row = mysqli_fetch_assoc($seatResults)){
          $count = $row['SeatID'];
          if($count > 24 && $count <=32){
            echo "<input type='checkbox' value=".$row['SeatID']." id=".$row['SeatID']." name='seats[]' hidden>
            <label for=".$row['SeatID']." class='".$row['Status']."' ></label>";
          }
        }?>
      </div>
      <div class="row">
      <?php
          $selectSeatCommand = "SELECT * FROM seat WHERE Event_Id = '".$name."';"; //////
          $seatResults = mysqli_query($dbConnection, $selectSeatCommand);
        while($row = mysqli_fetch_assoc($seatResults)){
          $count = $row['SeatID'];
          if($count > 32 && $count <=40){
            echo "<input type='checkbox' value=".$row['SeatID']." id=".$row['SeatID']." name='seats[]' hidden>
            <label for=".$row['SeatID']." class='".$row['Status']."' ></label>";
          }
        }?>
      </div>
      <div class="row">
      <?php
          $selectSeatCommand = "SELECT * FROM seat WHERE Event_Id = '".$name."';"; //////
          $seatResults = mysqli_query($dbConnection, $selectSeatCommand);
        while($row = mysqli_fetch_assoc($seatResults)){
          $count = $row['SeatID'];
          if($count > 40 && $count <=48){
            echo "<input type='checkbox' value=".$row['SeatID']." id=".$row['SeatID']." name='seats[]' hidden>
            <label for=".$row['SeatID']." class='".$row['Status']."' ></label>";
          }
        }?>
      </div>
    </div>

    <p class="text">
      You have selected <span id="count">0</span> seat for a price of RM.<span id="total">0</span>
      <input type="number" id="total_price" name="count" step = "0.01" hidden>
      <input type="number" id="num" name="finalAmount" step = "1" hidden>
    </p>

    <input type="submit" name="btnCheckout">
    </form>
  </body>
</html>

<script>const container = document.querySelector(".container");
    const seats = document.querySelectorAll(".row .seat:not(.sold)");
    const count = document.getElementById("count");
    const total = document.getElementById("total");
    const movieSelect = document.getElementById("movie");
    
    populateUI();
    
    let ticketPrice = +movieSelect.value;
    
    // Save selected movie index and price
    function setMovieData(movieIndex, moviePrice) {
      localStorage.setItem("selectedMovieIndex", movieIndex);
      localStorage.setItem("selectedMoviePrice", moviePrice);
    }
    
    // Update total and count
    function updateSelectedCount() {
      const selectedSeats = document.querySelectorAll(".row .seat.selected");
      const input = document.getElementById("total_price");
      const seatsIndex = [...selectedSeats].map((seat) => [...seats].indexOf(seat));
  

      localStorage.setItem("selectedSeats", JSON.stringify(seatsIndex));
    
      const selectedSeatsCount = selectedSeats.length;
      const price = document.getElementById("num");
      count.innerText = selectedSeatsCount;
      total.innerText = selectedSeatsCount * ticketPrice;
      price.value = selectedSeatsCount;
      input.value = total.innerText;
      
      setMovieData(movieSelect.selectedIndex, movieSelect.value);
    }
    
    
    // Get data from localstorage and populate UI
    function populateUI() {
      const selectedSeats = JSON.parse(localStorage.getItem("selectedSeats"));
    
      if (selectedSeats !== null && selectedSeats.length > 0) {
        seats.forEach((seat, index) => {
          if (selectedSeats.indexOf(index) > -1) {
            console.log(seat.classList.add("selected"));
          }
        });
      }
    
      const selectedMovieIndex = localStorage.getItem("selectedMovieIndex");
    
      if (selectedMovieIndex !== null) {
        movieSelect.selectedIndex = selectedMovieIndex;
        console.log(selectedMovieIndex)
      }
    }
    console.log(populateUI())
    // Movie select event
    movieSelect.addEventListener("change", (e) => {
      let url="http://localhost/MusicSociety_LiewKimWah/MusicSociety_LiewKimWah/seatBook.php";
      ticketPrice = +e.target.value;
      setMovieData(e.target.selectedIndex, e.target.value);
      updateSelectedCount();
      window.location.href = url +"?index="+e.target.selectedIndex;
      
    });
    
    // Seat click event
    container.addEventListener("click", (e) => {
      if (
        e.target.classList.contains("seat") &&
        !e.target.classList.contains("sold")
      ) {
        e.target.classList.toggle("selected");
    
        updateSelectedCount();
      }
    });
    
    // Initial count and total set
    updateSelectedCount();
    
 
    </script>