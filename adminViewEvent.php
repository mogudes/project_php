<?php
include '../includes/dbConnector.php';
include '../includes/helper.php';
if (!$dbConnection) {
    echo "connection failed";
}

$selectCommand = "SELECT * FROM event WHERE Date >= current_date()";
$result = mysqli_query($dbConnection, $selectCommand);

//search button --> work
if (isset($_GET["searchBtn"])) {
    $search_value = $_GET['searchValue'];
    //have to change-> this just testing
    $searchQuery = "SELECT * FROM event WHERE CONCAT(Event_Id, Event_Category) LIKE '%$search_value%' ";
    $result = mysqli_query($dbConnection, $searchQuery);
}

//filter
if (isset($_GET["filterBtn"])) {
    $venue = trim($_GET['venue']);

    $filterQuery = "SELECT * FROM event WHERE Venue LIKE '%$venue%' ";
    $result = mysqli_query($dbConnection, $filterQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE = edge">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
        <title>Admin View Events</title>
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel = "stylesheet" href = "https://use.fontawesome.com/releases/v5.15.4/css/all.css"
              integrity = "sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin = "anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
              integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
        <link href='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'>

        <link href = "adminViewEvent.css" rel = "stylesheet">
             <link rel="stylesheet" href="sidebar/sidebar.css">
        <link rel="icon" href="../../images/homeImages/logo.png" type="image/icon type">
        <style>
            button.toggle  , button.update {
                color: black;
                background: transparent;
                opacity: 1;
                font-size: 1.2vw;
                line-height: 30px;
                border: none;
                margin-bottom: 5px;
                padding-top: 10px;
                margin: 10px
            }
        </style>
    </head>

    <body>
        <nav>
            <ul>
                <li>
                    <a href="#" class="logo">
                        <img src="logo.png" alt="">
                        <span class="nav-item">Music Society</span>
                    </a>
                </li>
                <li><a href="adminAdd.php" class="a">
                    <i class="fas fa-home"></i>
                    <span class="nav-item">Add</span>
                </a></li>
                <li><a href="adminViewEvent.php" class="a"><i class="fas fa-user"></i>
                    <span class="nav-item">Edit/View</span></a></li>
                <li><a href="#" class="logout"><i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item">Log Out</span></a></li>
        
            </ul>
            
        </nav>
        <div class="container-fluid d-flex" id="bodyPage">
            <div  id="side-navbar">
                <h1>Content</h1>
                <ul>
                    <li id="viewEvents-btn">View Events</li>
                    <li id="viewVolunteers-btn"><a href="adminViewVolunteer.php
                    ">View Volunteers</a></li>
                </ul>
            </div>
            <div  id="main">

                <div class="main-content">

                    <section>
                      


                        <form action="" method="GET">
                            <div class="search_box">
                                <input type="text" name="searchValue" class="search" placeholder="Search by Event or ID">

                                <button type="submit" class="search_button" name="searchBtn"><i class='bx bx-search-alt-2'></i></button>
                            </div>
                        </form>


                        <div class="block">
                            <button id="filter">Filter<i class='bx bx-filter'></i><i class='bx bx-plus'></i></button>
                        </div>
                        <form action="" method="">
                            <div class="block">
                                <div class="filter_form">
                                    <label for="venue">Venue:</label>
                                    <input type="text" name="venue" class="venue" placeholder="Any">
                                    </br>
                                    <input type="submit" class="apply_fliter" name="filterBtn">
                                </div>
                            </div>
                        </form>

                        <div class="table">
                            <table class="event-table">
                                <colgroup>
                                    <col span="1" style="width:40%">
                                    <col span="2" style="width:10%">
                                    <col span="1" style="width:20%">
                                    <col span="1" style="width:10%">
                                    <col span="2" style="width:20%">
                                </colgroup>

                                <thead>
                                    <tr>
                                        <th>Event</th>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Venue</th>
                                        <th>Participants</th>
                                        <th>Price</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <!--demo result-->
                                   <?php
                                    //    session_start();
                                   if (mysqli_num_rows($result) > 0) {
                                       while ($row = mysqli_fetch_array($result)) {
                                           echo "<tr>";
                                           echo "<td> " . $row["Event_Category"] . " </td>";
                                           echo "<td> " . $row["Event_Id"] . " </td>";
                                           echo "<td> " . $row["Date"] . " </td>";
                                           echo "<td> " . $row["Time"] . " </td>";
                                           echo "<td> " . $row["Venue"] . " </td>";
                                           echo "<td> " . $row["Participant"] . " </td>";
                                           echo "<td> " . $row["Price"] . " </td>";

                                           echo "<td>"
                                           //pass argument into by query parameter
                                           . "<a href = 'viewBookingList.php?event_id=" . $row['Event_Id'] . " '><button class='toggle'><i class='fa-solid fa-pen-to-square'></i></button></a>"
                                           . "</td>";
                                           echo "<td>"
                                           . "<a href = 'viewBookingList.php?event_id=" . $row['Event_Id'] . " '><button class='update'><i class='fa-solid fa-eye'></i></button></a>"
                                           . "</td>";

                                           echo "</tr>";
                                       }
                                   } else {
                                       echo "<tr>";
                                       echo "<td colspan='9'>No records found...</td>";
                                       echo "</tr>";
                                   }
                                   ?>


                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <script>
            let filterButton = document.querySelector("#filter");
            let form = document.querySelector(".filter_form");
            let buttonChange = document.querySelector(".bx-plus")

            filterButton.addEventListener("click", () => {
                form.classList.toggle("open");
                btnChange();
            });

            function btnChange() {
                if (buttonChange.classList.contains("bx-plus")) {
                    buttonChange.classList.replace("bx-plus", "bx-minus");
                } else {
                    buttonChange.classList.replace("bx-minus", "bx-plus")
                }
            }

            var $table = $('table'),
                    $bodyCells = $table.find('tbody tr:first').children(),
                    colWidth;

            // Get the tbody columns width array
            colWidth = $bodyCells.map(function () {
                return $(this).width();
            }).get();

            // Set the width of thead columns
            $table.find('thead tr').children().each(function (i, v) {
                $(v).width(colWidth[i]);
            });
        </script>
    </body>

</html>
<script>
    

var menuBtn = document.getElementById("admin-menu");
var menu = document.getElementById("side-navbar");

window.addEventListener('load',function(){
    if(this.window.innerWidth > 640){
        menu.style.display = "block";
    }else {
        menu.style.display = "none";
    }
})

window.addEventListener('resize',function(){
    if(this.window.innerWidth > 640){
        menu.style.display = "block";
    }else {
        menu.style.display = "none";
    }
})

menuBtn.addEventListener("click", displayMenu);

function displayMenu() {
    if (menu.style.display == "none") {
        menu.style.display = "block";
    } else if (menu.style.display == "block") {
        menu.style.display = "none";
    }
}


var numberOfRecords = document.querySelectorAll(".toggle").length;

for(var i = 0 ; i < numberOfRecords ; i ++ ){
    document.querySelectorAll(".toggle")[i].addEventListener("click",function(){
        var volunteerId = "student"+this.getAttribute("data-studNo");
        // console.log(studId);
        var element = document.getElementById(volunteerId);

        element.classList.toggle("hidden");
        
    })
}



</script>