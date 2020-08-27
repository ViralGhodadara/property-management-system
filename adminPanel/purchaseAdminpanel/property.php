<?php
    session_start();
    
    require "../../connection.php";

    $numOfProperty = $conn->prepare('SELECT id, image, property_name, price FROM listproperty');
    $numOfProperty->execute();

    // echo $numOfProperty->rowCount();

    $test = $numOfProperty->rowCount() % 3;
    $num = $numOfProperty->rowCount() / 3;

    if ($test > 0) {
        $num++;
        $num = intval($num);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($_SESSION['buyer_username'])) { echo $_SESSION['buyer_username']; } ?> - admin panel</title>
    <link rel="stylesheet" href="../../custom.css">
    <!-- fontawsome icon link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav>
        <div class="w3-sidebar w3-black w3-bar-block" style="width:25%">
            <h3 class="w3-bar-item" style="font-family: monospace;"><?php echo $_SESSION['buyer_username']; ?></h3>
            <a href="http://localhost/viral/property-management/adminPanel/purchaseAdminPanel/purAdminPanel.php#" class="w3-bar-item myclass">Home</a>
            <a href="#" class="w3-bar-item myclass">Property</a>
            <a href="http://localhost/viral/property-management/adminPanel/purchaseAdminPanel/myPurchased.php" class="w3-bar-item myclass">Purchased property</a>
            <a href="http://localhost/viral/property-management/" class="w3-bar-item myclass">Logout</a>
        </div>
    </nav>

    <div class="section">
        <div>
            <h3 class="heading">All Property</h3>
        </div>
        <div class="container-property">
            <?php

                for ($i = 0; $i < $num; $i++) {                     

                    for ($v = 0; $v < 3; $v++) {
                        if ($property = $numOfProperty->fetch()) {
                        ?>
                            <div class="property">
                                <a href="http://localhost/viral/property-management/adminPanel/purchaseAdminpanel/purchaseProperty.php?idOfProperty=<?php echo $property['id']; ?>">
                                    <img src="../saleAdmin/<?php echo $property['image']; ?>" class="property_images">
                                </a>
                                <p class="property_title"><?php echo $property['property_name']; ?></p>
                                <h5 class="property-price">Price : <i class="fa fa-inr" aria-hidden="true"></i><?php echo $property['price']; ?></h5>
                            </div>
                        <?php    
                        }
                    }
                    echo "<br><br>";   
                }
            ?>
        </div>
    </div>
    
</body>
</html>