<?php
require_once 'dbconn.php';

// updating from date !
if (isset($_SERVER["REQUEST_METHOD"]) == "POST" && isset($_POST['edit'])) {
    function test_input($data)
    {
        $data = strtolower($data);
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uid =  test_input($_POST['id']);
    $lrname = test_input($_POST['lrname']);
    $lradd2 = test_input($_POST['lradd2']);
    $lename = test_input($_POST['lename']);

    $updatesql = "UPDATE `residentialtbl` SET `lessor_name`=?, `lradd2`=?, `lessee_name`=? WHERE id = ?";

    $upstmt = $conn->prepare($updatesql);
    $upstmt->bind_param("sssi", $lrname, $lradd2, $lename, $uid);

    if ($upstmt->execute()) {
        echo "Record updated successfully";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $upstmt->close();
}

if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM residentialtbl WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch data and display it in the form for editing
        $row = $result->fetch_assoc();
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Agreement - RESIDENTIAL RENTAL AGREEMENT</title>
            <link rel="stylesheet" href="index.css" />
        </head>

        <body style="background-color: navy">
            <div>
                <div class="container">
                    <div class="heading">
                        <h1>UPDATE AGREEMENT</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="form-grid">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <div class="grid-gap">
                                <label for="lrname">Lessor Name</label>
                                <input class="validation" type="text" placeholder="Enter Your Name" name="lrname" id="lrname" value="<?= $row['lessor_name'] ?>" required />
                            </div>
                            <div class="grid-gap">
                                <label for="lradd2">Lessor Address 1</label>
                                <textarea class="validation" name="lradd2" id="lradd2" placeholder="Enter Your Address" required><?= $row['lradd2'] ?></textarea>
                            </div>
                            <div class="grid-gap">
                                <label for="lename">Lessee Name</label>
                                <input class="validation" type="text" placeholder="Enter Your Name" name="lename" id="lename" value="<?= $row['lessee_name'] ?>" pattern="[A-z|a-z]{5}" required />
                            </div>
                            <div>
                                <button class="submit-btn" type="submit" name="edit">
                                    Submit
                                </button>
                            </div>
                    </form>
        </body>

        </html>
<?php
    } else {
        echo "No record found with ID: " . $id;
    }

    $stmt->close();
} else {
    echo "Invalid ID";
}

$conn->close();
