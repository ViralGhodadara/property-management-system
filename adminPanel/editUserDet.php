<?php
    require "../connection.php";

    if (isset($_GET['idOfEdit'])) {
        $editId = $_GET['idOfEdit'];

        $dataOfUser = $conn->prepare('SELECT * FROM registration WHERE id = ?');
        $dataOfUser->execute([$editId]);

        $data = $dataOfUser->fetch();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit - <?php echo $data['username']; ?></title>
    <link rel="stylesheet" href="../custom.css">
</head>
<body bgcolor="beige">
    <center>
        <h3 class="title">Edit Here....</h3>
        <div class="main-edit">
            <form method="post">
                <br><br>
                <input type="text" name="fullName" placeholder="Full name" value="<?php echo $data['full_name']; ?>" class="box" required><br>
                <p class="error" id="error-fullName"></p>
                <input type="number" name="contactNumber" placeholder="Contact Number" value="<?php echo $data['contact_number']; ?>" class="box" required><br><br>
                <p class="error" id="error-contactNumber"></p>
                <select name="gender" class="opt" required>
                    <option value="<?php echo $data['gender']; ?>" selected><?php echo $data['gender']; ?></option>
                    <option value="" disabled>Gender</option>
                    <option value="male">male</option>
                    <option value="female">female</option>
                    <option value="other">other</option>
                </select><br>
                <textarea name="address" class="txtarea" cols="40" rows="7" placeholder="Address" required><?php echo $data['address'] ?></textarea><br>
                <input type="email" name="email" placeholder="Email id" value="<?php echo $data['email']; ?>" class="box" required><br><br>
                <button type="submit" class="btn" name="update-btn">Update</button>
            </form>
            <br>
            <p class="last-para">Back to <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/saleAdminPanel.php">Home ?</a></p>
        </div>
    </center>
</body>
</html>

<?php
    if (isset($_POST['update-btn'])) {
        $fullName = $_POST['fullName'];
        $contactNumber = $_POST['contactNumber'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $email = $_POST['email'];

        if (strlen($fullName) > 7) {
            if (strlen($contactNumber) == 10) {
                $updateDetail = $conn->prepare('UPDATE registration SET full_name = ?, contact_number = ?, gender = ?, address = ?, email = ? WHERE id = ?');

                if ($updateDetail->execute([$fullName, $contactNumber, $gender, $address, $email, $editId])) {
                    if ($data['type'] == 'sale') {
                    ?>
                        <script>
                            alert("Your detail updated successfully........");
                            window.location.replace('http://localhost/viral/property-management/adminPanel/saleAdmin/saleAdminPanel.php');
                        </script>
                    <?php
                    } else {
                    ?>
                        <script>
                            alert("Your detail updated successfully........");
                            window.location.replace('http://localhost/viral/property-management/adminPanel/purchaseAdminPanel/purAdminPanel.php');
                        </script>
                    <?php
                    }
                }
            } else {
            ?>
                <script>
                    document.getElementById('error-contactNumber').innerHTML = '*** Enter only 10 digits';
                </script>
            <?php
            }
        } else {
        ?>  
            <script>
                document.getElementById('error-fullName').innerHTML = '*** Enter full name must be 8 character';
            </script>
        <?php
        }
    }   
?>