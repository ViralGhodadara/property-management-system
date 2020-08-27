<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../custom.css">
</head>
<body bgcolor="beige">
    <center>
        <h3 class="title">Registration Here....</h3>
        <div class="main">
            <form method="post">
                <br>
                <input type="text" name="username" class="box" placeholder="Username" required><br>
                <p id="error-username" class="error"></p>
                <input type="text" name="full_name" class="box" placeholder="Full name" required><br>
                <p id="error-fullName" class="error"></p>
                <input type="number" name="contact_number" class="box" placeholder="Contact number" required><br>
                <p id="error-contactNumber" class="error"></p>
                <textarea name="address" cols="40" rows="7" class="txtarea" placeholder="Address"></textarea><br>
                <p id="error-address" class="error"></p>
                <select name="gender" class="opt" required>
                    <option value="">Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select><br>
                <input type="email" name="email_id" class="box" placeholder="Email id"><br><br>
                <p class="error" id="error-email"></p>
                <select name="type" class="opt" required><br><br>
                    <option value="">Type</option>
                    <option value="sale">Sale</option>
                    <option value="purchase">Purchase</option>
                </select><br>
                <input type="password" name="pass" class="box" placeholder="Password" required><br>
                <p id="error-pass" class="error"></p>
                <input type="password" name="cpass" class="box" placeholder="Conform Password" required><br><br>
                <p id="error-cpass" class="error"></p>
                <button type="submit" class="btn" name="submit-registration-detail">Register</button>
            </form>
            <br>
            <p class="last-para">Back to <a href="http://localhost/viral/property-management/">Home ?</a></p>
        </div>
    </center>
</body>
</html>

<?php
    if (isset($_POST['submit-registration-detail'])) {

        $username = $_POST['username'];
        $full_name = $_POST['full_name'];
        $contact_number = $_POST['contact_number'];
        $add = $_POST['address'];
        $gender = $_POST['gender'];
        $email = $_POST['email_id'];
        $type = $_POST['type'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];

       include "../connection.php";

        if (strlen($username) > 7) {
            if(strlen($full_name) > 7) {
                if (strlen($contact_number) == 10) {
                    if (strlen($pass) > 7) {
                        if (strlen($cpass) > 7) {
                            if ($pass === $cpass) {
                                $pass_hash = password_hash($pass, PASSWORD_BCRYPT);

                                // checkUsername and email are available ot not

                                $checkUsername = $conn->prepare('SELECT * FROM registration WHERE username LIKE ?');
                                $checkUsername->execute([$username]);

                                if ($checkUsername->rowCount() == 0) {
                                    // check email id
                                    $checkEmail = $conn->prepare('SELECT * FROM registration WHERE email LIKE ?');
                                    $checkEmail->execute([$email]);

                                    if ($checkEmail->rowCount() == 0) {
                                        $insertUserDetail = $conn->prepare('INSERT INTO registration (username, full_name, contact_number, gender, address, type, email, password, conform_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
                                    
                                        if ($insertUserDetail->execute([$username, $full_name, $contact_number, $gender, $add, $type, $email, $pass_hash, $pass_hash])) {
                                            $_SESSION['login-msg'] = 'Please enter the username and password';
                                        ?>
                                            <script>
                                                alert('Your detail registered successfully........');
                                                window.location.replace('http://localhost/viral/property-management/login-system/login.php');
                                            </script>
                                        <?php
                                        }
                                    } else {
                                    ?>
                                        <script>
                                            document.getElementById('error-email').innerHTML = '*** Please enter the another email this email will be exist';
                                        </script>
                                    <?php
                                    }
                                    
                                } else {
                                ?>
                                    <script>
                                        document.getElementById('error-username').innerHTML = '*** Please enter the another username this username will be exist';
                                    </script>
                                <?php
                                }
                            } else {
                            ?>
                                <script>
                                    document.getElementById('error-pass').innerHTML = '*** Please enter the password and conform password are same';
                                    document.getElementById('error-cpass').innerHTML = '*** Please enter the password and conform password are same';
                                </script>
                            <?php    
                            }
                        } else {
                        ?>
                            <script>
                                document.getElementById('error-cpass').innerHTML = '*** Password must be 8 character';
                            </script>
                        <?php   
                        }
                    } else {
                    ?>
                        <script>
                            document.getElementById('error-pass').innerHTML = '*** Password must be 8 character';
                        </script>
                    <?php
                    }
                } else {
                ?>
                    <script>
                        document.getElementById('error-contactNumber').innerHTML = '*** Enter the 10 digits';
                    </script>
                <?php
                }
            } else {
            ?>
                <script>
                    document.getElementById('error-fullName').innerHTML = '*** Enter the full name must be 7 letter';
                </script>
            <?php
            }
        } else {
        ?>
            <script>
                document.getElementById('error-username').innerHTML = '*** Username must be 8 letter';
            </script>
        <?php
        }

        
    }
?>

<!-- <script>
    function checkUsername() {
        let username = document.getElementById('usernm').value;

        console.log(username);

        if (username.length <= 2 || username.length >= 16) {
            document.getElementById('error-username').innerHTML = '***Please enter the username is less than 3 and greter than 10 character';
            return false;
        }

        if (checkSpaceInString(username) == true) {
            document.getElementById('error-username').innerHTML = '*** You cannot use space for username';
            return false;
        }
    }

    function checkFullName() {
        let fullName = document.getElementById('fullName').value;

        if (fullName.length < 8) {
            document.getElementById('error-fullName').innerHTML = '*** Enter character must be 3 letter';
            return false;
        } else if (fullName.length > 25) {
            document.getElementById('error-fullName').innerHTML = '*** Enter character maximum 25 letter';
            return false;
        } else {
            return true;
        }
    }

    function checkContactNumber() {
        let contactNumber = document.getElementById('contactNumber').value;

        if (contactNumber.length <= 9 || contactNumber.length >= 11) {
            document.getElementById('error-contactNumber').innerHTML = '*** Enter number must be 10 digits';
            return false;
        }
    }

    function checkAdd() {
        let address = document.getElementById('address').value;

        if (address.length < 5) {
            document.getElementById('error-address').innerHTML = '*** Please enter the valid address';
            return false;
        }
    }

    function checkPass() {
        let password = document.getElementById('pass').value;

        if (password.length < 8) {
            document.getElementById('error-pass').innerHTML = '*** Enter must be 8 letter';
            return false;
        }
    }

    function checkCpass() {
        let password = document.getElementById('cpass').value;

        if (password.length < 8) {
            document.getElementById('error-cpass').innerHTML = '*** Enter must be 8 letter';
            return false;
        }
    }

    function checkSpaceInString(str) {

        let val;

        for (let i = 0; i < str.length; i++) {
            
            if (str[i] == 0) {
                val = 1;
                break;
            } else {
                val = 0;
            }
        }

        if (val == 1) {
            return true;
        } else {
            return false;
        }
    }
    
</script> -->