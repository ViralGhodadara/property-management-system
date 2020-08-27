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
    <!-- Booastrap link for table -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- fontawsome icon link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
    <nav>
        <div class="w3-sidebar w3-black w3-bar-block" style="width:25%">
            <h3 class="w3-bar-item" style="font-family: monospace;"><?php echo $_SESSION['seller_username']; ?></h3>
            <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/saleAdminPanel.php" class="w3-bar-item myclass">Home</a>
            <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/listProperty.php" class="w3-bar-item myclass">List Property</a>
            <a href="http://localhost/viral/property-management/adminPanel/myProperty.php" class="w3-bar-item myclass">My Property</a>
            <a href="#" class="w3-bar-item myclass">Property Bids</a>
            <a href="http://localhost/viral/property-management/" class="w3-bar-item myclass">Logout</a>
        </div>
    </nav>

    <div class="section">
        <div>
            <h3 class="heading">My Bids</h3>
        </div>
        <?php
            $myProperty = $conn->prepare('SELECT * FROM listproperty WHERE bid LIKE ?');
            $myProperty->execute(['intrested']);

            // $myPropertyData = $myProperty->fetch();
        ?>
        <div class="main-div-myProperty">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Image</td>
                        <td>property_name</td>
                        <td>propert_size</td>
                        <td>price</td>
                        <td>City</td>
                        <td>Address</td>
                        <td>Type</td>
                        <td>Discription</td>
                        <td>bid</td>
                        <td>Buyer Contact</td>
                        <td>Operation</td>
                        <td>Sell</td>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            while ($myPropertyData = $myProperty->fetch()) {
                            ?>
                                <tr>
                                    <td>
                                        <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/<?php echo $myPropertyData['image']; ?>" target="-Blank"  >
                                            <img src="../saleAdmin/<?php echo $myPropertyData['image']; ?>" style="height: 100px; width: 100px;">
                                        </a>
                                    </td>
                                    <td><?php echo $myPropertyData['property_name']; ?></td>
                                    <td><?php echo $myPropertyData['propert_size']; ?></td>
                                    <td><?php echo $myPropertyData['price']; ?></td>
                                    <td><?php echo $myPropertyData['city']; ?></td>
                                    <td><?php echo $myPropertyData['address']; ?></td>
                                    <td><?php echo $myPropertyData['type']; ?></td>
                                    <td><?php echo $myPropertyData['discription']; ?></td>
                                    <td><?php echo $myPropertyData['bid']; ?></td>
                                    <td>
                                        <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/buyerdet.php?det=<?php echo $myPropertyData['id'];; ?>">
                                            <button type="button" class="contact-button">Contact buyer</button>
                                        </a>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="http://localhost/viral/property-management/adminPanel/viewProperty.php?idOfView=<?php echo $myPropertyData['id']; ?>" class="icon" title="VIEW PROPERTY">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="http://localhost/viral/property-management/adminPanel/operation.php?soldId=<?php echo $myPropertyData['id']; ?>">
                                            <button type="button" class="contact-button">Sold</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                        ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>