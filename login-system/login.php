<?php
    session_start();

    require "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Here....</title>
    <link rel="stylesheet" href="../custom.css">
</head>
<body bgcolor="beige">
    <center>
        <h3 class="title">Login Here.....</h3>
        <div class="login-div">
            <br>
            <p class="para"><?php if (isset($_SESSION['login-msg'])) { echo $_SESSION['login-msg']; } else { echo "Please enter the username and password"; } ?></p>
            <form method="post">
                <br><br>
                <p class="error" id="error-login"></p>
                <input type="text" name="username" placeholder="username" class="box" required><br>
                <input type="password" name="password" placeholder="password" class="box" required><br><br>
                <input type="submit" value="Login" class="btn" name="submit-btn">
            </form>
            <br>
            <p class="last-para">Back to <a href="http://localhost/viral/property-management/">Home ?</a></p>
        </div>
    </center>
</body>
</html>

<?php

    if (isset($_POST['submit-btn'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // check username is exist or not

        $checkUsername = $conn->prepare('SELECT * FROM registration WHERE username LIKE ?');
        $checkUsername->execute([$username]);

        if ($checkUsername->rowCount() == 1) {
            $data = $checkUsername->fetch();

            if (password_verify($password, $data['password']) == true) {
                
                if ($data['type'] == 'sale') {
                    $_SESSION['seller_username'] = $username;                
                ?>
                    <script>
                        alert('Login are successfully.....');
                        window.location.replace('http://localhost/viral/property-management/adminPanel/saleAdmin/saleAdminPanel.php');
                    </script>
                <?php
                // header('location: http://localhost/viral/property-management/adminPanel/saleAdmin/saleAdminPanel.php');
                } else {
                    $_SESSION['buyer_username'] = $username;
                ?>
                    <script>
                        alert('Login are successfully.....');
                        window.location.replace('http://localhost/viral/property-management/adminPanel/purchaseAdminPanel/purAdminPanel.php');
                    </script>
                <?php
                }
            } else {
            ?>
                <script>
                    document.getElementById('error-login').innerHTML = '*** Please enter the valid password';
                </script>
            <?php
            }
        } else {
        ?>
            <script>
                document.getElementById('error-login').innerHTML = '*** Please enter the valid username';
            </script>
        <?php
        }
    }


?>