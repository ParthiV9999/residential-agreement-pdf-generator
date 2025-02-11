<?php
require_once 'dbconn.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM `residentialtbl` WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error executing delete statement: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing delete statement: " . $conn->error;
    }
} else {
    echo "No ID provided for deletion.";
}

$conn->close();
