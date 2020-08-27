<?php
    session_start();
    
    require '../../connection.php';

    if (isset($_GET['idOfProperty']) && isset($_GET['ownerId'])) {
        $propertyDetail = $conn->prepare('SELECT * FROM listproperty WHERE id = ?');
        $propertyDetail->execute([$_GET['idOfProperty']]);

        $propertyData = $propertyDetail->fetch(); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bid - <?php echo $propertyData['property_name']; ?></title>
    <link rel="stylesheet" href="../../custom.css">
</head>
<body bgcolor="beige">
    <center>
        <h3 class="title">Bid form...</h3>  
        <div class="container-form">
            <p class="error" id="Err"></p>
            <form method="post">
                <br>
                <input type="text" name="fullName" placeholder="Full Name" class="box" style="width: 300px;" required><br>
                <input type="number" name="mobileNumber" placeholder="Mobile Number" class="box" style="width: 300px;" required><br>
                <textarea name="msg" class="txtarea" cols="30" rows="7" placeholder="Write your Msg....." style="margin-left: -2px; width: 300px;" required></textarea><br>
                <button class="btn" name="submit-bid" style="margin-left: -195px;">Bid</button>
            </form>
            <br>
            
        </div>  
    </center>
</body>
</html>

<?php
    if (isset($_POST['submit-bid'])) {

        $fullName = $_POST['fullName'];
        $contactNumber = $_POST['mobileNumber'];
        $msg = $_POST['msg'];

        if (isset($_SESSION['buyer_username'])) {
            $entryBid = $conn->prepare('INSERT INTO propertybid (buyerName, ownerName, property_id, msg, buyer_mobile_number) VALUES (?, ?, ?, ?, ?)');
        
            if ($entryBid->execute([$_SESSION['buyer_username'], $_GET['ownerId'], $_GET['idOfProperty'], $msg, $contactNumber])) {
                $updateBid = $conn->prepare('UPDATE listproperty SET bid = ? WHERE  id = ?');
                $updateBid->execute(['intrested', $_GET['idOfProperty']]);
    
                $insertListProperty = $conn->prepare('UPDATE listproperty SET buyerName = ? WHERE id = ?');
                $insertListProperty->execute([$_SESSION['buyer_username'], $_GET['idOfProperty']]);
    
                $_SESSION['buyer_username'] = $_SESSION['buyer_username'];
                
                echo '<script>alert("Property owner contact successfully please wait for responce")</script>';
                echo '<script>window.location.replace("http://localhost/viral/property-management/adminPanel/purchaseAdminPanel/property.php")</script>';
            }            
        } else { 
        ?>
            <script>
                document.getElementById('Err').innerHTML = '*** Please you can create your account';
            </script>
        <?php
        }

    }
?>