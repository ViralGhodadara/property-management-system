<?php
    require "../connection.php";

    if (isset($_GET['idOfView'])) {
        
        $propertyDetail = $conn->prepare('SELECT * FROM listproperty WHERE id = ?');
        $propertyDetail->execute([$_GET['idOfView']]);
        $data = $propertyDetail->fetch();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View - <?php echo $data['property_name']; ?></title>
    <link rel="stylesheet" href="../custom.css">

    <!-- fontawsome icon link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <p class="title viewpropertytitle">View Property</p>
    <div class="conatainer-viewProperty">
        <div class="image">
            <a href="saleAdmin/<?php echo $data['image']; ?>">
                <img src="saleAdmin/<?php echo $data['image']; ?>" class="propertyImg">
            </a>
        </div>
        <div class="property-detail">
            <p class="property-title"><?php echo $data['property_name']; ?></p>
            <p class="property-price"> <b>Price : </b><i class="fa fa-inr" aria-hidden="true"></i><?php echo $data['price']; ?></p>
            <p class="other-detail"><b>Size : </b><?php echo $data['propert_size']; ?></p>
            <p class="other-detail"><b>City : </b><?php echo $data['city']; ?></p>
            <p class="other-detail"><b>Address : </b><?php echo $data['address']; ?></p>
            <p class="other-detail"><b>Discription : </b><?php echo $data['discription']; ?></p>
            <button class="btn viewButton">Intrested</button>
            <br><br>

        </div>
    </div>
</body>
</html>