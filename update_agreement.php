<?php
require_once 'dbconn.php';


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare selsect query to fetch data for the given ID
    $sql = "SELECT * FROM residentialtbl WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // updating from date !
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {

        $updatesql = "UPDATE `residentialtbl` SET
    `lessor_name`='?', `lradd2`='?', `lessee_name`='?'WHERE id = ?";

        $upstmt = $conn->prepare($updatesql);
        $upstmt->bind_param("ssi", $lrname, $lradd2, $lename, $id);

        if ($stmt->execute()) {
            echo "Record updated successfully";
            header("Location: dashboard.php?id");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $upstmt->close();
    } else {
        header("Location: edit_agreement.php");
        exit();
    }

    if ($result->num_rows > 0) {
        // Fetch data and display it in the form for editing
        $row = $result->fetch_assoc();

        //fetch update form 
        require_once 'tamplates/update_form.php';
    } else {
        echo "No record found with ID: " . $id;
    }

    $stmt->close();
} else {
    echo "Invalid ID";
}

$conn->close();
