
<html lang="en">
    <?php
        session_start();
    include '../includes/dbConnector.php';
    include '../includes/helper.php';

    if (isset($_POST['btnSubmit'])) {
        $eventId = isset($_POST['eventId']) ? trim($_POST['eventId']) : "";
        $category = isset($_POST['category']) ? trim($_POST['category']) : "";
        $eventTitle = isset($_POST['eventTitle']) ? trim($_POST['eventTitle']) : "";
        $date = isset($_POST['date']) ? trim($_POST['date']) : "";
        $time = isset($_POST['time']) ? trim($_POST['time']) : "";
        $price = isset($_POST['price']) ? trim($_POST['price']) : "";
        $venue = isset($_POST['venue']) ? trim($_POST['venue']) : "";
        $participant = isset($_POST['participant']) ? trim($_POST['participant']) : "";
        $description = isset($_POST['description']) ? trim($_POST['description']) : "";
        $learn1 = isset($_POST['learn1']) ? trim($_POST['learn1']) : "";
        $learn2 = isset($_POST['learn2']) ? trim($_POST['learn2']) : "";
        $learn3 = isset($_POST['learn3']) ? trim($_POST['learn3']) : "";

        $finalErrorMessages = validateId($eventId);

        if (count($finalErrorMessages) > 0) {
            echo "<div class='error'>";
            echo "<ul>";
            foreach ($finalErrorMessages as $message) {
                echo "<li>$message</li>";
            }
            echo "</ul>";
            echo "</div>";
        } else if (isset($_FILES['eventImg1']['name']) && isset($_FILES['eventImg2']['name']) && isset($_FILES['eventImg3']['name'])) {




            $fileName1 = $_FILES["eventImg1"]["name"];
            $source_path1 = $_FILES["eventImg1"]["tmp_name"];
            $destination_path1 = "eventImages/" . $fileName1;
            $fileName2 = $_FILES["eventImg2"]["name"];
            $source_path2 = $_FILES["eventImg2"]["tmp_name"];
            $destination_path2 = "eventImages/" . $fileName2;
            $fileName3 = $_FILES["eventImg3"]["name"];
            $source_path3 = $_FILES["eventImg3"]["tmp_name"];
            $destination_path3 = "eventImages/" . $fileName3;

            if (move_uploaded_file($source_path1, $destination_path1) && move_uploaded_file($source_path2, $destination_path2) && move_uploaded_file($source_path3, $destination_path3)) {    //return true, false
                echo "<h3>  Image uploaded successfully!</h3>";

                $insertCommand = "INSERT INTO event (Event_Id,Event_Category,Event_Title,Date,Time,Venue,Price,Participant,Description,Learn1,Learn2,Learn3,Img1,Img2,Img3) VALUES ('$eventId', '$category', '$eventTitle', '$date','$time','$venue', '$price', '$participant', '$description', '$learn1','$learn2','$learn3','$fileName1', '$fileName2','$fileName3')";
                $result = mysqli_query($dbConnection, $insertCommand);

                echo "<div class='message'>";
                echo "Event has been inserted successfully.";
                echo "</div>";
            }
        } else {
            echo "<h3>  Failed to upload image!</h3>";

            //stop the program
            die();
        }
    }



    if (isset($_POST['btnSubmitNews'])) {

        $newsTitle = isset($_POST['newsTitle']) ? trim($_POST['newsTitle']) : "";
        $newsContent = isset($_POST['newsContent']) ? trim($_POST['newsContent']) : "";

        if (isset($_FILES['newsImg']['name'])) {




            $fileName = $_FILES["newsImg"]["name"];
            $source_path = $_FILES["newsImg"]["tmp_name"];
            $destination_path = "eventImages/" . $fileName;

            if (move_uploaded_file($source_path, $destination_path)) {    //return true, false
                echo "<h3>  Image uploaded successfully!</h3>";
            }
        } else {
            echo "<h3>  Failed to upload image!</h3>";

            //stop the program
            die();
        }






        $insertCommand = "INSERT INTO recentnews (newsId, newsTitle, newsArticle,newsImage) VALUES (null,'$newsTitle', '$newsContent', '$fileName')";
        $result = mysqli_query($dbConnection, $insertCommand);

        echo "<div class='message'>";
        echo "Event has been inserted successfully.";
        echo "</div>";
    }
    ?>


    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Add</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
              integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />


        <link href="adminAdd.css" rel="stylesheet">
        <link href="sidebar/sidebar.css" rel="stylesheet">
        <link rel="icon" href="../images/homeImages/logo.png" type="image/icon type">
    </head>

    <h3 style="margin-left:20%;">Image uploaded successfully!</h3>
    <div class='message' style="margin-left:20%;">
     Event has been inserted successfully.
    </div>

    <body>
        
       
        <div id="confirmationPage">
            <div id="confirmContainer">
                <div id="closeConfirmation">
                    <i class="fas fa-times"></i>
                </div>
                <div id="confirmText"><p>Are you sure to submit?</p></div>
                <div id="confirmBtn">
                    <button id="yes" value="yes">Yes</button>
                    <button id="no" value="no">No</button>

                </div>
            </div>
        </div>
        <div class="container-fluid d-flex" id="adminPage">
            <div  id="side-navbar">
                <h1>Content</h1>
                <ul>
                    <li id="category-btn">Categories</li>
                    <li id="recentNews-btn">Recent News</li>
                </ul>
            </div>
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
                    <li><a href="../Register.php" class="logout"><i class="fas fa-sign-out-alt"></i>
                        <span class="nav-item">Log Out</span></a></li>
            
                </ul>
                
            </nav>
            
            <div  id="main">

                <div id="categoryEdit">
                

                    <form  method="POST" action=""  enctype="multipart/form-data">
                        <h1>Add Category Activities</h1>
                        <table>
                            <tr>
                                <td>
                                    <label for="eventId">Event ID: </label>
                                </td>
                                <td>
                                    <input type="text" id="eventId" name="eventId" maxlength="4" required="true" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="category">Choose a category: </label>
                                </td>
                                <td>
                                    <select id="category" name="category"  required="true">
                                        <option value="piano">Piano</option>
                                        <option value="guitar">Guitar</option>
                                        <option value="drum">Drum</option>
                                        <option value="violin">Violin</option>
                                        <option value="vocal">Vocal</option>
                                        <option value="others">Others</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="eventTitle">Event Title: </label>
                                </td>
                                <td>
                                    <input type="text" id="eventTitle" name="eventTitle" maxlength="30" required="true" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="date">Choose a Date: </label>
                                </td>

                                <td>
                                    <input type="date" name="date"  required="true" min="<?php echo date("Y-m-d"); ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="time">Choose a Time: </label>
                                </td>

                                <td>
                                    <input type="time" name="time"  required="true"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="price">Enter a Price: </label>
                                </td>

                                <td>
                                    <input type="number" name="price" min="0" step="any" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="venue">Enter a Venue: </label>
                                </td>
                                <td>
                                    <input type="text" name="venue" maxlength="30" />
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <label for="participant">Enter maximum participant: </label>
                                </td>
                                <td>
                                    <input type="number" name="participant"  value="" />
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <label for="description">Description: </label>
                                </td>
                                <td colspan="2">
                                    <textarea type="text" name="description" required="true" maxlength="1500"></textarea>   
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="learn1">Learning Outcome 1: </label>
                                </td>
                                <td>
                                    <input type="text" name="learn1" required="true" maxlength="50" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="learn2">Learning Outcome 2: </label>
                                </td>
                                <td>
                                    <input type="text" name="learn2"  maxlength="50" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="learn3">Learning Outcome 3: </label>
                                </td>
                                <td>
                                    <input type="text" name="learn3"  maxlength="50" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="eventImg1">Select image for event: </label>
                                </td>
                                <td>
                                    <input type="file" id="eventImg1" name="eventImg1"  required="true" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="eventImg2">Select image for event: </label>
                                </td>
                                <td>
                                    <input type="file" id="eventImg2" name="eventImg2"  required="true" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="eventImg3">Select image for event: </label>
                                </td>
                                <td>
                                    <input type="file" id="eventImg3" name="eventImg3"  required="true" />
                                </td>
                            </tr>

                        </table>
                        <div id="btn">
                            <input type="button" class="submit" value="Submit" />
                            <input type="reset" value="Cancel">
                            <input type="submit" class="realSubmitBtn" id="realSubmitEvent" name="btnSubmit"> 
                        </div>

                    </form>

                </div>

                <div id="recentNewsEdit">
                    <h1>Add Recent news</h1>
                    <form   method="POST" action="" enctype="multipart/form-data"  >
                        <table>
                            <tr>
                                <td>
                                    <label for="newsTitle">Enter Title: </label>
                                </td>
                                <td>
                                    <input type="text" name="newsTitle" id="newsTitle" maxlength="30" required="true"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="newsContent">Enter content: </label>
                                </td>
                            </tr>
                            <tr>    
                                <td colspan="2">
                                    <textarea name="newsContent" id="newsContent" required="true"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="newsImg">Select image for event: </label>
                                </td>
                                <td>
                                    <input type="file" id="newsImg" name="newsImg"  required="true" />
                                </td>
                            </tr>
                        </table>
                        <div id="btn">
                            <input type="button" class="submit" value="Submit" />
                            <input type="reset" value="Cancel">
                            <input type="submit" class="realSubmitBtn" id="realSubmitNews" name="btnSubmitNews"> 

                        </div>
                    </form>
                </div>
            </div>

        </div>

    </body>

</html>
<script>
    var category_btn = document.getElementById("category-btn");
var recentNews_btn = document.getElementById("recentNews-btn");

var category_content = document.getElementById("categoryEdit");
var recentNewsEdit_content = document.getElementById("recentNewsEdit");

var menuBtn = document.getElementById("admin-menu");
var menu = document.getElementById("side-navbar");

var confirmationPage = document.getElementById("confirmationPage");
var closeConfirmation = document.getElementById("closeConfirmation");
var yesBtn = document.getElementById("yes");
var noBtn = document.getElementById("no");
var submitBtn=document.getElementsByClassName("submit");
var submitEvent=document.getElementById("realSubmitEvent");
var submitNews=document.getElementById("realSubmitNews");



closeConfirmation.addEventListener("click", closeConfirmationPage);
noBtn.addEventListener("click", closeConfirmationPage);
for(var i=0; i<2; i++){
    submitBtn[i].addEventListener("click", closeConfirmationPage);


}
yesBtn.addEventListener("click", submitFunction);


recentNewsEdit_content.style.display = "none";
category_content.style.display = "block";
category_btn.style.backgroundColor = "var(--darker_theme)";
recentNews_btn.style.backgroundColor = "var(--theme)";

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
confirmationPage.style.display = "none";

category_btn.addEventListener("click", displayCategory);
recentNews_btn.addEventListener("click", displayRecentNews);
menuBtn.addEventListener("click", displayMenu);

function submitFunction(){
    if(category_content.style.display!="none"){
        submitEvent.click();
    }else if(recentNewsEdit_content.style.display != "none"){
        submitNews.click();
    }
}


function displayCategory() {
    if (category_content.style.display == "none") {
        category_content.style.display = "block";
        recentNewsEdit_content.style.display = "none";
        category_btn.style.backgroundColor = "var(--darker_theme)";
        recentNews_btn.style.backgroundColor = "var(--theme)";

    }
}
function displayRecentNews() {
    if (recentNewsEdit_content.style.display == "none") {
        recentNewsEdit_content.style.display = "block";
        category_content.style.display = "none";
        recentNews_btn.style.backgroundColor = "var(--darker_theme)";
        category_btn.style.backgroundColor = "var(--theme)";


    }
}

function displayMenu() {
    if (menu.style.display == "none") {
        menu.style.display = "block";
    } else if (menu.style.display == "block") {
        menu.style.display = "none";
    }

}

function closeConfirmationPage() {
    if (confirmationPage.style.display == "none") {
        confirmationPage.style.display = "block";


    } else if (confirmationPage.style.display == "block"){
        confirmationPage.style.display = "none";

    }

}


</script>
