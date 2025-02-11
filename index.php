<?php
include("dbconn.php");

$lrname = $lradd1 = $lradd2 = $lrcity = $lrstate = $lrpincode = "";
$lename = $leadd1 = $leadd2 = $lecity = $lestate = $lepincode = "";
$hcategory = $bedroom = $bathroom = $carparks = $sqrfeet = "";
$startdate = $leaseterm = $notice = "";
$monthly_rentel = $rental_deposite = $advance_date = $meter_reading = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    function test_input($data)
    {
        $data = strtolower($data);
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $lrname = test_input($_POST['lrname']);
    $lradd1 = test_input($_POST['lradd1']);
    $lradd2 = test_input($_POST['lradd2']);
    $lrcity = test_input($_POST['lrcity']);
    $lrstate = test_input($_POST['lrstate']);
    $lrpincode = test_input($_POST['lrpincode']);
    $lename = test_input($_POST['lename']);
    $leadd1 = test_input($_POST['leadd1']);
    $leadd2 = test_input($_POST['leadd2']);
    $lecity = test_input($_POST['lecity']);
    $lestate = test_input($_POST['lestate']);
    $lepincode = test_input($_POST['lepincode']);
    $hcategory = test_input($_POST['hcategory']);
    $bedroom = test_input($_POST['bedroom']);
    $bathroom = test_input($_POST['bathroom']);
    $carparks = test_input($_POST['carparks']);
    $sqrfeet = test_input($_POST['sqrfeet']);
    $startdate = test_input($_POST['startdate']);
    $leaseterm = test_input($_POST['leaseterm']);
    $notice = test_input($_POST['notice']);
    $monthly_rentel = test_input($_POST['monthly_rentel']);
    $rental_deposite = test_input($_POST['rental_deposite']);
    $advance_date = test_input($_POST['advance_date']);
    $meter_reading = test_input($_POST['meter_reading']);


    $sql = "INSERT INTO `residentialtbl`(`lessor_name`, `lessor_address`, `lradd2`, `lrcity`, `lrstate`, `lrpincode`, `hcategory`, `bedroom`, `bathroom`, `carparks`, `sqrfeet`, `lessee_name`, `lessee_address`, `leadd2`, `lecity`, `lestate`, `lepincode`, `rent_start_date`, `leaseterm`, `notice`, `monthly_rentel`, `rental_deposite`, `advance_date`, `meter_reading`) 
    VALUES ('$lrname','$lradd1','$lradd2','$lrcity','$lrstate','$lrpincode','$hcategory','$bedroom','$bathroom','$carparks','$sqrfeet','$lename','$leadd1','$leadd2','$lecity','$lestate','$lepincode','$startdate','$leaseterm','$notice','$monthly_rentel','$rental_deposite','$advance_date','$meter_reading')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Your data posted successfully!');</script>";
    } else {
        echo "The record was not inserted because of this error ===><br>";
        mysqli_error($conn);
    }
    // exit();
}

include("templates/user.html");
