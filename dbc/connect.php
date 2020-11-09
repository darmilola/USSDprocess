<?php

function connectToDatabase(){

$servername="localhost";
$username="id15357813_promo_code_db_centric_db_user";
$password="vK%3Y^tU)sQd/2|V";
$dbname="id15357813_promo_code_db_centric_db";

return mysqli_connect($servername,$username,$password,$dbname);
}
?>