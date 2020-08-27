<?php
    session_start();

    require "../../connection.php";

    if (isset($_GET['idOfProperty'])) {

        $property = $conn->prepare('SELECT * FROM listproperty WHERE id = ?');
        $property->execute([$_GET['idOfProperty']]);

        $data = $property->fetch();


        // check if property is buy or not 
        $checkPropertyBuy = $conn->prepare('SELECT * FROM propertybid WHERE Property_id = ?');
        $checkPropertyBuy->execute([$_GET['idOfProperty']]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase - <?php echo $data['property_name']; ?></title>
    <link rel="stylesheet" href="../../custom.css">
    <!-- fontawsome icon link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .btn-disable
        {
            cursor: not-allowed;
            pointer-events: none;

            /*Button disabled - CSS color class*/
            color: #c0c0c0;
            background-color: #ffffff;

        }
    </style>
</head>
<body>
    <p class="title viewpropertytitle">View Property</p>
    <div class="conatainer-viewProperty">
        <div class="image">
            <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/<?php echo $data['image']; ?>">
                <img src="../saleAdmin/<?php echo $data['image']; ?>" class="propertyImg">
            </a>
        </div>
        <div class="property-detail">
            <p class="property-title"><?php echo $data['property_name']; ?></p>
            <p class="property-price"> <b>Price : </b><i class="fa fa-inr" aria-hidden="true"></i><?php echo $data['price']; ?></p>
            <p class="other-detail"><b>Size : </b><?php echo $data['propert_size']; ?></p>
            <p class="other-detail"><b>Type : </b><?php echo $data['type']; ?></p>
            <p class="other-detail"><b>City : </b><?php echo $data['city']; ?></p>
            <p class="other-detail"><b>Address : </b><?php echo $data['address']; ?></p>
            <p class="other-detail"><b>Discription : </b><?php echo $data['discription']; ?></p>
            <?php
                if ($checkPropertyBuy->rowCount() == 0) {
                ?>
                    <a href="http://localhost/viral/property-management/adminPanel/purchaseAdminpanel/PurchaseForm.php?idOfProperty=<?php echo $data['id']; ?>&ownerId=<?php echo $data['username']; ?>">
                        <button class="btn viewButton">Intrested</button>
                    </a>
                <?php
                } else {
                ?>
                    <button class="btn viewButton btn-disable">Intrested</button><span style="color: maroon;">&nbsp;&nbsp;&nbsp;***You cannot buy this property beacuse bid alredy...</span>
                <?php
                }
            ?>
            <br><br>
            <p class="last-para" style='margin-left: -1px;'>Back to <a href="http://localhost/viral/property-management/adminPanel/purchaseAdminPanel/property.php">Home ?</a></p>
            <br><br>
        </div>
    </div>
</body>
</html>