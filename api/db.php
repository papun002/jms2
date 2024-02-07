<?php
$server = "10.35.45.232";
$username = "root";
$password = "";
$database = "j";

$con = mysqli_connect($server,$username,$password,$database);
if(!$con){
    echo "Not Connected";
}
?>
