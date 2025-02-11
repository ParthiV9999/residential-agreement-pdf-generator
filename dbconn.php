<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "residentialdb";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Fail to connect with database" . mysqli_connect_error());
}
