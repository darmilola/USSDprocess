<?php

require_once ('./dbc/connect.php');

$conn = connectToDatabase();
@$sessionId   = $_POST["sessionId"];
@$serviceCode = $_POST["serviceCode"];
@$phoneNumber = $_POST["phoneNumber"];
@$text        = $_POST["text"];




if ($text == ""){
    $response  = "CON Welcome to Company name Promo\n";
    $response .= "1. Check Promo Code\n";
    
}

else if ($text == "1") {
   
    $response = "CON Enter Promo Code\n";
}
else if(preg_match_all("/1\*([0-9]+)/", $text) > 0 && preg_match_all("/([^0-9\*\#]+)/", $text) == 0){
    
         /**   Currently in menu 1, this will be displayed when the user press 1 on the menu list of the  display  **/
         
     
         if(preg_match_all("/([0-9])+\*([0-9]+)\*([0-9]+)/", $text) == 1){
       
             
                 //regex for determining on phone number input
                   $phone = preg_replace("/([0-9])+\*([0-9]+)\*/", "", $text);
             
                  saveWinnersPhone($phone);
                  $response  = "END Thank you for Participating we will get in touch very soon\n";
         }
         else if(preg_match_all("/([0-9]+)\*([0-9]+)/", $text) == 1 && preg_match_all("/([^0-9\*\#]+)/", $text) == 0){
           
             //regex for determining on promo code input
             $promoCode = str_replace("1*","", $text);
       
             if(preg_match_all("/([^0-9]+)/",$promoCode) != 0){
                 
                 $response   = "END You have Entered an Invalid Promo Code\n";
              }
               else{
                 
                 if(verifyPromoCode($promoCode)){
                
                    if(isPromoCodeUsed($promoCode)){
                 
                      $response   = "END The code has already been used\n";
                  }
                      else{
          
                        $response   =  "CON Congratulations you have won\n";
                        $response  .=  "Enter your phonenumber to redeem your price\n";
                        updateCodeStatus($promoCode);
                   
             }
          
         }
         
             
        
          else{
              
              if(isPromoCodeExist($promoCode)){
                  
              
                    if(isPromoCodeUsed($promoCode)){
                 
                    $response   = "END The promo code has already been used\n";
                }
                else{
            
                    $response  = "END Thank you for Participating we are sorry but your promo code is not winning, please try again\n";
                     updateCodeStatus($promoCode);
        
                    }
                  
              }
              else{
                  
                    $response   = "END The code you entered does not exist\n";
              }
              
          } 
              
       }
     
     
}
else{
    
     $response  = "END Invalid Input Please try Again\n";
}
        

     
 }
 
 /** menu 1 ends here so be careful and mind the boundary **/
 
 
   else{
       
        $response  = "END Invalid Input Please try Again\n";
       
   }
   
    



    
echo $response;
        
        
function  verifyPromoCode($promocode){
    
    global $conn;
    $codeStatus = false;
    $isWinning = "false";
    $verifyql = "SELECT iswinning from promo_codes_centric WHERE promo_code = '$promocode'";
   
     $result  = mysqli_query($conn, $verifyql);
      if(mysqli_num_rows($result)>0){
          while ($row = mysqli_fetch_assoc($result)){
           
              $isWinning = $row["iswinning"]; 
           }
          if(strcasecmp($isWinning, "false") == 0){
              $codeStatus = false;
              return $codeStatus;
          }
          else if(strcasecmp($isWinning, "true") == 0){
              $codeStatus = true;
              return $codeStatus;
          }
          else{
              $codeStatus = false;
              return $codeStatus;
              
          }
         }
         else{
             
             return $codeStatus;
         }
         
      
}


  function isPromoCodeUsed($promocode){
    
    global $conn;
    $codeStatus = "used";
    $isPromoCodeUsed = false;
    $verifyql = "SELECT status from promo_codes_centric WHERE promo_code = '$promocode'";
   
     $result  = mysqli_query($conn, $verifyql);
      if(mysqli_num_rows($result)>0){
          
           while ($row = mysqli_fetch_assoc($result)){
           
              $codeStatus = $row["status"]; 
           }
          if(strcasecmp($codeStatus, "used") == 0){
              
              $isPromoCodeUsed = true;
              return $isPromoCodeUsed;
          }
          else if(strcasecmp($codeStatus, "available") == 0){
             
              $isPromoCodeUsed = false;
              return $isPromoCodeUsed;
          }
          else{
              $isPromoCodeUsed = false;
              return $isPromoCodeUsed;
              
          }
          
         }
         else{
             
             return $isPromoCodeUsed;
         }
}


  
  
  function isPromoCodeExist($promocode){
    
    global $conn;
    $isExisting = false;
    $verifyql = "SELECT * from promo_codes_centric WHERE promo_code = '$promocode'";
   
       $result  = mysqli_query($conn, $verifyql);
       if(mysqli_num_rows($result)>0){
          
              $isExisting = true;
              return $isExisting;
         }
          else{
              $isExisting = false;
              return $isExisting;
              
          }
          
        
}


  function  updateCodeStatus($promocode){
    
    global $conn;
    
    $updateql = "UPDATE promo_codes_centric SET status = 'used' WHERE promo_code = '$promocode'";
    mysqli_query($conn, $updateql);
        
    }
    
    function  saveWinnersPhone($phone){
    
    global $conn;
    
    $insertql = "INSERT INTO winners_phone_tbl SET phonenumber = '$phone'";
   
     mysqli_query($conn, $insertql);
       
    
    }

?>

