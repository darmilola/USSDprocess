<?php

//require_once ('./dbc/connect.php');

//$conn = connectToDatabase();
@$sessionId   = $_POST["sessionId"];
@$serviceCode = $_POST["serviceCode"];
@$phoneNumber = $_POST["phoneNumber"];
@$text        = $_POST["text"];



//$_SESSION["surname"];
//$_SESSION["firstname"];
//$_SESSION["middlename"];
//$_SESSION["phonenumber"];
//$_SESSION["dob"];
//$_SESSION["stateoforigin"];
//$_SESSION["lga"];


$expText = $text;
$ussd_string_exploded = explode ("*",$expText);
// Get menu level from ussd_string reply
$level = count($ussd_string_exploded);
if ($text == ""){
    $response  = "CON Welcome to NIMC Partial Registration Portal\n Press 1. to Start your Registration ";
    echo $response;
}
else if($level == 1){
    
    StartPartialRegistration(1,$text);
}
else if($level == 2){
    StartPartialRegistration(2,$text);
    //$_SESSION["surname"] = retrieveInformation($text, 1);    
}
else if($level == 3){
    //echo $level;    
StartPartialRegistration(3,$text);
    //$_SESSION["firstname"] = retrieveInformation($text, 2);    
}
else if($level == 4){
    StartPartialRegistration(4,$text);
    //$_SESSION["middlename"] = retrieveInformation($text, 3);    
}
else if($level == 5){
    StartPartialRegistration(5,$text);
    //$_SESSION["dob"] = retrieveInformation($text, 4);    
}
else if($level == 6){
    StartPartialRegistration(6,$text);
    //$_SESSION["stateoforigin"] = retrieveInformation($text, 5);    
}
else if($level == 7){
    StartPartialRegistration(7,$text);
    //$_SESSION["lga"] = retrieveInformation($text, 6);    
}
else if($level == 8){
     
    echo  "END phone is  ".retrieveInformation($text, 7);
    }


function StartPartialRegistration($location,$text){
    
    if($location == 1){
       $response  = "CON Please input your surname";
      // $_SESSION["level"] = "1";
    }
    else if($location == 2){
        $response  = "CON Please input your firstname  ".retrieveInformation($text, 1);
    }
     else if($location == 3){
        $response  = "CON Please input your middlename  ".retrieveInformation($text, 2);
        //retrieveInformation($text, 2);
    }
     else if($location == 7){
        $response  = "CON Finally please kindly Provide your Phonenumber  ".retrieveInformation($text, 6);
        //retrieveInformation($text, 6);
    }
     else if($location == 4){
        $response  = "CON Please input your Date of Birth  ".retrieveInformation($text, 3);
        //retrieveInformation($text, 3);
    }
     else if($location == 5){
        
         $response  = "CON Please input your State of Origin  ".retrieveInformation($text, 4);
        //retrieveInformation($text, 4);
    
        
     }else if($location == 6){
         
        $response  = "CON We are Almost there input your Local Government Area  ".retrieveInformation($text, 5);
    }
  echo $response;
    
}


function retrieveInformation($text, $level){
    
    if($level == 1){
        $surname = preg_replace("/(\w+)\*/", "", $text);
        return  $surname;
        
    }
    else if($level == 2){
        $firstname = preg_replace("/(\w+)\*(\w+)\*/", "", $text);
        return $firstname;
     }
     else if($level == 3){
        $middlename = preg_replace("/(\w+)\*(\w+)\*(\w+)\*/", "", $text);
        return  $middlename;
      }
      else if($level == 4){
        $dob = preg_replace("/(\w+)\*(\w+)\*(\w+)\*(\w+)\*/", "", $text);
        return  $dob;
      }
      else if($level == 5){
        $stateoforigin = preg_replace("/(\w+)\*(\w+)\*(\w+)\*(\w+)\*(\w+)\*/", "", $text);
        return  $stateoforigin;
      }
      else if($level == 6){
            $lga = preg_replace("/(\w+)\*(\w+)\*(\w+)\*(\w+)\*(\w+)\*(\w+)\*/", "", $text);
            return  $lga;
            
      }
       else if($level == 7){
             
           $usersPhone = preg_replace("/(\w+)\*(\w+)\*(\w+)\*(\w+)\*(\w+)\*(\w+)\*(\w+)\*/", "", $text);
           return  $usersPhone;  
      }
}
