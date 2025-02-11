<?php
include("dbconn.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard - RESIDENTIAL RENTAL AGREEMENT</title>
    <link rel="stylesheet" href="../registration/style.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include_once 'templates/header.html';
    ?>
    <main>
        <div class="container">
            <table>
                <th>id</th>
                <th>Lanlord Name</th>
                <th>Property Address</th>
                <th>Tenant Name</th>
                <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT * FROM `residentialtbl` ORDER BY id ";
                $result = mysqli_query($conn, $sql);

                if ($result->num_rows > 0) {
                    $row = null;
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['lessor_name'] ?></td>
                            <td><?= $row['lradd2'] ?></td>
                            <td><?= $row['lessee_name'] ?></td>
                            <td>
                                <a href="edit_agreement.php?id=<?= $row['id'] ?>">Edit</a>
                                <a href="delete_agreement.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                <a href="generate_pdf.php?id=<?= $row['id'] ?>">Download PDF</a>
                            </td>
                        </tr>
                <?php }
                } else {
                    echo "0 results";
                }
                ?>
            </table>
        </div>
    </main>
</body>

</html>
<?php
$conn->close();
?>