<?php 
$conn = new mysqli("localhost","root","","eyeglass_shop");
if($conn->connect_error) {
    die('Connection error'.$conn->connect_error);
}
?>