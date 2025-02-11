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
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="form-grid">
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