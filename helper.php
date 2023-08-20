<?php
        function validateStudId($studId) {
            global $dbConnection;
            $errMsgId = array();

            $selectCommand = "SELECT * FROM student WHERE Student_Id = '$studId'";

            $result = mysqli_query($dbConnection, $selectCommand);

            if ($result->num_rows != 1) {
                $errMsgId[] = "Student ID " . $studId . " does not exist.";
            }
            return $errMsgId;
        }

        function validateFirstName($studId, $firstName) {
            global $dbConnection;
            $errMsgFirstName = array();

            $selectCommand = "SELECT * FROM student WHERE Student_Id = '$studId'";

            $result = mysqli_query($dbConnection, $selectCommand);

            if ($result->num_rows == 1) {
                $student = mysqli_fetch_object($result);
                $correctFirstName = $student->First_Name;
                if ($correctFirstName != $firstName) {
                    $errMsgFirstName[] = "Student First Name '" . $firstName . "' does not exist.";
                }
            }

            return $errMsgFirstName;
        }

        function validateLastName($studId, $lastName) {
            global $dbConnection;
            $errMsgLastName = array();

            $selectCommand = "SELECT * FROM student WHERE Student_Id = '$studId'";

            $result = mysqli_query($dbConnection, $selectCommand);

            if ($result->num_rows == 1) {
                $student = mysqli_fetch_object($result);
                $correctLastName = $student->Last_Name;
                if ($correctLastName != $lastName) {
                    $errMsgLastName[] = "Student Last Name '" . $lastName . "' does not exist.";
                }
            }

            return $errMsgLastName;
        }
        
// debug function , to ease coding 

function dd($a) {
            echo "<pre>";
            print_r($a);
            die;
}        
 
// leonard functions


function validatePass1And2($pass1, $pass2){
        //return true if pass1 and 2 is different
        if(strcmp($pass1, $pass2) != 0) {
            return true;
        }else{
            return false;
        }
    } 

function validateExistUser($email, $pwd){
    if($pwd == "" || $pwd == null || $email == "" || $email == null){
        return $errMsgPass = "Email or password cannot be empty";
    }
    else{
        return "";
    }
}

// cherng henrg function 

function validateId($eventId){
    global $dbConnection;
    $errMsgId = array();
    
    $selectCommand = "SELECT * FROM event WHERE Event_Id = '$eventId'";
    
    $result = mysqli_query($dbConnection, $selectCommand);
    
    
    if ($result->num_rows > 0){
        $errMsgId[] = "Event ID" . $eventId . " already exist.";
    }
    return $errMsgId;
}

?>
