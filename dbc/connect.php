<?php

function connectToDatabase(){

$servername="localhost";
$username="promo_code_db_centric_db_user";
$password="6vxNYtuz#jk/q&89";
$dbname="promo_code_db_centric_db";

return mysqli_connect($servername,$username,$password,$dbname);
}
?>