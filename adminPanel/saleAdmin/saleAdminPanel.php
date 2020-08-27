<?php
    session_start();
    
    require "../../connection.php";

    $dataOfUser = $conn->prepare('SELECT * FROM registration WHERE username LIKE ?');
    $dataOfUser->execute([$_SESSION['seller_username']]);

    $data = $dataOfUser->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($_SESSION['seller_username'])) { echo $_SESSION['seller_username']; } ?> - admin panel</title>
    <link rel="stylesheet" href="../../custom.css">
</head>
<body>
    <nav>
        <div class="w3-sidebar w3-black w3-bar-block" style="width:25%">
            <h3 class="w3-bar-item" style="font-family: monospace;"><?php echo $_SESSION['seller_username']; ?></h3>
            <a href="#" class="w3-bar-item myclass">Home</a>
            <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/listProperty.php" class="w3-bar-item myclass">List Property</a>
            <a href="http://localhost/viral/property-management/adminPanel/myProperty.php" class="w3-bar-item myclass">My Property</a>
            <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/myBids.php" class="w3-bar-item myclass">Property Bids</a>
            <a href="http://localhost/viral/property-management/" class="w3-bar-item myclass">Logout</a>
        </div>
    </nav>

    <div class="section">
        <div>
            <h3 class="heading">Home</h3>
        </div>
        <div>
            <div class="detail">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <label><b>Username : </b></label><?php echo $data['username']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><b>Full Name : </b></label><?php echo $data['full_name']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><b>Contact Number : </b></label><?php echo $data['contact_number']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><b>Gender : </b></label><?php echo $data['gender']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><b> Address : </b></label><?php echo $data['address']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><b> Type : </b></label><?php echo $data['type']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><b> Email Id : </b></label><?php echo $data['email']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <a href="http://localhost/viral/property-management/adminPanel/editUserDet.php?idOfEdit=<?php echo $data['id']; ?>">
            <button class="btn" style="margin-left: 10%; margin-top: 20px;">Edit</button>
        </a>
    </div>
</body>
</html>