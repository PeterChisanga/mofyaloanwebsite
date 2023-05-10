<?php 
$link = mysqli_connect("localhost","root","","mofyaloans");

if($link == false) {
    die ("Error connecting to database. " .mysqli_connect_error());
}


?>