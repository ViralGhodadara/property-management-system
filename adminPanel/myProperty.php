<?php
    session_start();

    require '../connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($_SESSION['seller_username'])) { echo $_SESSION['seller_username']; } ?></title>
    <link rel="stylesheet" href="../custom.css">

    <!-- Booastrap link for table -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- fontawsome icon link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
    <nav>
        <div class="w3-sidebar w3-black w3-bar-block" style="width:25%">
            <h3 class="w3-bar-item" style="font-family: monospace;"><?php echo $_SESSION['seller_username']; ?></h3>
            <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/saleAdminPanel.php" class="w3-bar-item myclass" style="text-decoration: none;">Home</a>
            <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/listProperty.php" class="w3-bar-item myclass" style="text-decoration: none;">List Property</a>
            <a href="#" class="w3-bar-item myclass" style="text-decoration: none;">My Peroperty</a>
            <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/myBids.php" class="w3-bar-item myclass">Property Bids</a>
            <a href="http://localhost/viral/property-management/" class="w3-bar-item myclass" style="text-decoration: none;">Logout</a>            
        </div>
    </nav>

    <div style="margin-left:25%">
        <div>
            <h3 class="heading">My Property</h3>
        </div>
        <?php
            $myProperty = $conn->prepare('SELECT * FROM listproperty WHERE username LIKE ?');
            $myProperty->execute([$_SESSION['seller_username']]);

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
                        <td colspan="3">Operation</td>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php
                            while ($myPropertyData = $myProperty->fetch()) {
                            ?>
                                <tr>
                                    <td>
                                        <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/<?php echo $myPropertyData['image']; ?>" target="-Blank"  >
                                            <img src="saleAdmin/<?php echo $myPropertyData['image']; ?>" style="height: 100px; width: 100px;">
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
                                        <a href="http://localhost/viral/property-management/adminPanel/operation.php?idOfEdit=<?php echo $myPropertyData['id']; ?>" class="icon">
                                            <i class="fa fa-pencil" aria-hidden="true" title="EDIT"></i>                                        
                                        </a>
                                    </td>
                                    <td>
                                        <a href="http://localhost/viral/property-management/adminPanel/operation.php?idOfDel=<?php echo $myPropertyData['id']; ?>" class="icon" title="DELETE">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="http://localhost/viral/property-management/adminPanel/viewProperty.php?idOfView=<?php echo $myPropertyData['id']; ?>" class="icon" title="VIEW PROPERTY">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
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