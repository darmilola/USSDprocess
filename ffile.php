<?php

//require_once ('./dbc/connect.php');

//$conn = connectToDatabase();
@$sessionId   = $_POST["sessionId"];
@$serviceCode = $_POST["serviceCode"];
@$phoneNumber = $_POST["phoneNumber"];
@$text        = $_POST["text"];
session_start();
$usersPhone = "";
$firstname = "";
$middlename = "";
$surname = "";
$dob = "";
$stateoforigin = "";
$lga = "";

$_SESSION["surname"];
$_SESSION["firstname"];
$_SESSION["middlename"];
$_SESSION["phonenumber"];
$_SESSION["dob"];
$_SESSION["stateoforigin"];
$_SESSION["lga"];
$_SESSION["level"];


if ($text == ""){
    $response  = "CON Welcome to NIMC Partial Registration Portal\n Press 1. to Start your Registration\n";
}
else if($text == "1"){
    StartPartialRegistration(1);
}
else if(isset($_SESSION["level"]) && $_SESSION["level"] == 1){
    StartPartialRegistration(2);
    //$_SESSION["surname"] = retrieveInformation($text, 1);    
}
else if(isset($_SESSION["level"]) && $_SESSION["level"] == 2){
    StartPartialRegistration(3);
    //$_SESSION["firstname"] = retrieveInformation($text, 2);    
}
else if(isset($_SESSION["level"]) && $_SESSION["level"] == 3){
    StartPartialRegistration(4);
    //$_SESSION["middlename"] = retrieveInformation($text, 3);    
}
else if(isset($_SESSION["level"]) && $_SESSION["level"] == 4){
    StartPartialRegistration(5);
    //$_SESSION["dob"] = retrieveInformation($text, 4);    
}
else if(isset($_SESSION["level"]) && $_SESSION["level"] == 5){
    StartPartialRegistration(6);
    //$_SESSION["stateoforigin"] = retrieveInformation($text, 5);    
}
else if(isset($_SESSION["level"]) && $_SESSION["level"] == 6){
    StartPartialRegistration(7);
    //$_SESSION["lga"] = retrieveInformation($text, 6);    
}
else if(isset($_SESSION["level"]) && $_SESSION["level"] == 7){
     
    $response = "Registration Completed se you soon on Ngrok";
    //$_SESSION["phonenumber"] = retrieveInformation($text,7);    
}
echo $response;

function StartPartialRegistration($location){
    
    if($location == 1){
       $response  = "CON Please input your surname";
       $_SESSION["level"] = 1;
    }
    else if($location == 2){
        $response  = "CON Please input your firstname";
        $_SESSION["level"] = 2;
    }
     else if($location == 3){
        $response  = "CON Please input your middlename";
        $_SESSION["level"] = 3;
    }
     else if($location == 7){
        $response  = "CON Finally please kindly Provide your Phonenumber";
        $_SESSION["level"] = 7;
    }
     else if($location == 4){
        $response  = "CON Please input your Date of Birth";
        $_SESSION["level"] = 4;
    }
     else if($location == 5){
        
         $response  = "CON Please input your State of Origin";
         $_SESSION["level"] = 5;
    
        
     }else if($location == 6){
         
        $response  = "CON We are Almost there input your Local Government Area";
        $_SESSION["level"] = 6;
    }
  
    
}


function retrieveInformation($text, $level){
    
    if($level == 1){
        $surname = preg_replace("/([0-9]+)\*/", "", $text);
        $_SESSION["surname"] = $surname;
    }
    else if($level == 2){
        $firstname = preg_replace("/([0-9]+)\*([A-z,0-9,\*\#\+]+)\*/", "", $text);
        $_SESSION["firstname"] = $firstname;
     }
     else if($level == 3){
        $middlename = preg_replace("/([0-9]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*/", "", $text);
        $_SESSION["middlename"] = $middlename;
      }
      else if($level == 4){
        $dob = preg_replace("/([0-9]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*/", "", $text);
        $_SESSION["dob"] = $dob;
      }
      else if($level == 5){
        $stateoforigin = preg_replace("([0-9]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*/", "", $text);
        $_SESSION["stateoforigin"] = $stateoforigin;
      }
      else if($level == 6){
            $lga = preg_replace("/([0-9]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*/", "", $text);
        $_SESSION["lga"] = $lga;
      }
       else if($level == 7){
             $usersPhone = preg_replace("/([0-9]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*([A-z,0-9,\*\#\+]+)\*/", "", $text);
             $_SESSION["phonenumber"] = $usersPhone;
      }
}
