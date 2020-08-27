<?php
    require '../connection.php';

    if (isset($_GET['idOfDel'])) {
        
        $deleteProperty = $conn->prepare('DELETE FROM listproperty WHERE id = ?');

        if ($deleteProperty->execute([$_GET['idOfDel']])) {
        ?>
            <script>
                alert("Property deleted successfully........");
                window.location.replace('http://localhost/viral/property-management/adminPanel/myProperty.php');
            </script>
        <?php
        }
    }

    if (isset($_GET['idOfEdit'])) {
        $idEdit = $_GET['idOfEdit'];

        $selectFlatDetail = $conn->prepare('SELECT * FROM listproperty WHERE id = ?');
        $selectFlatDetail->execute([$idEdit]);

        $flatData = $selectFlatDetail->fetch();
    }

    if (isset($_GET['idOfDelPur'])) {
        $updateListPro = $conn->prepare('UPDATE listproperty SET bid = ?, buyerName = ? WHERE id = ?');
        $updateListPro->execute(['null', 'NULL', $_GET['idOfDelPur']]);

        $delPurPro = $conn->prepare('DELETE FROM propertybid WHERE property_id = ?');

        if ($delPurPro->execute([$_GET['idOfDelPur']])) {
            echo '<script>alert("Your property can deleted from purchased")</script>';
            echo '<script>window.location.replace("http://localhost/viral/property-management/adminPanel/purchaseAdminPanel/myPurchased.php")</script>';
        }
    }

    if (isset($_GET['soldId'])) {
        $delBid = $conn->prepare('DELETE FROM propertybid WHERE property_id = ?');
        $delBid-> execute([$_GET['soldId']]);

        $delProperty = $conn->prepare('DELETE FROM listproperty WHERE id = ?');
        $delProperty->execute([$_GET['soldId']]);

        echo '<script>alert("This property was sold successfully.....")</script>';
        echo '<script>window.location.replace("http://localhost/viral/property-management/adminPanel/saleAdmin/myBids.php")</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit - <?php echo $flatData['property_name']; ?></title>
    <link rel="stylesheet" href="../custom.css">
</head>
<body bgcolor="beige">
    <center>
        <br><br><br>
        <div class="container-editProperty">
            <br>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="propertyName" placeholder="Name of property" class="box-NameProperty" value="<?php echo $flatData['property_name']; ?>"><br><br>
                <p class="error" id="error-propertyName"></p>
                <select name="pSize" class="opt" required style="margin-left: -313px;">
                    <option value="">Property Size</option>
                    <option value="<?php echo $flatData['propert_size']; ?>" selected><?php echo $flatData['propert_size']; ?></option>
                    <option value="1/2 BHK">1/2 BHK</option>
                    <option value="4/8 BHK">4/8 BHK</option>
                    <option value="10/12 BHK">10/12 BHK</option>
                </select><br>
                <input type="number" name="price" placeholder="Price" class="box" required style="margin-left: -191px;" value="<?php echo $flatData['price']; ?>"><br>
                <input type="text" name="city" placeholder="City" class="box" required style="margin-left: -191px;" value="<?php echo $flatData['city']; ?>"><br>
                <p class="error" id="error-city"></p>
                <textarea name="address" placeholder="Address" cols="40" rows="7" required  class="txtarea" style="margin-left: -128px;"><?php echo $flatData['address']; ?></textarea><br>
                <p class="error" id="error-address"></p>
                <select name="type" class="opt" style="margin-left: -313px;">
                    <option value='' disabled>Type</option>
                    <option value="sale">Sale</option>
                    <option value="<?php echo $flatData['type']; ?>" selected><?php echo $flatData['type']; ?></option>
                    <option value="rent">Rent</option>
                </select><br>
                <textarea name="discription" placeholder="Discription" cols="40" rows="7" required  class="txtarea" style="margin-left: -131px;"><?php echo $flatData['discription']; ?></textarea><br>
                <p class="error" id="discription-error"></p>
                <input type="file" name="photo" required style="margin-left: -177px;"><br><br>
                <p class="error" id="error-photo"></p>
                <button type="submit" name="btn-listProperty" class="btn" style="margin-left: -319; width: 180px;">Update Property</button>
            </form><br>
            <p class="last-para">Back to <a href="http://localhost/viral/property-management/adminPanel/myProperty.php">Home ?</a></p>
        </div>
    </center>
</body>
</html>

<?php
    if (isset($_POST['btn-listProperty'])) {

        error_reporting(0);

        $propertName = $_POST['propertyName'];
        $pSize = $_POST['pSize'];
        $propertPrice = $_POST['price'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $type = $_POST['type'];
        $discription = $_POST['discription'];


        $fileName = $_FILES['photo']['name'];
        $fileTmpName = $_FILES['photo']['tmp_name'];
        $fileType = $_FILES['photo']['type'];
        $path = 'saleAdmin/flatImages/'.$fileName;
        $dbPath = "flatImages/$fileName"; //This is a store for a database part

        $photoType = array('image/png', 'image/jpg', 'image/jpeg');

        if (strlen($propertName) > 7) {
            if (strlen($city) > 3) {
                if (strlen($address) > 7) {
                    if (strlen($discription) > 7) {
                        if (in_array($fileType, $photoType)) {
                            if (move_uploaded_file($fileTmpName, $path)) {
                                echo "<script>console.log('This is a run')</script>";
                                // Update data
                                $updateProperty = $conn->prepare('UPDATE listproperty SET property_name = ?, propert_size = ?, price = ?, city = ?, address = ?, type = ?, discription = ?, image = ? WHERE id = ?');
                                if ($updateProperty->execute([$propertName, $pSize, $propertPrice, $city, $address, $type, $discription, $dbPath, $idEdit])) {
                                ?>
                                    <script>
                                        alert('Your property detail can updated successfully....');
                                        window.location.replace('http://localhost/viral/property-management/adminPanel/myProperty.php');
                                    </script>
                                <?php
                                }
                            }
                        } else {
                        ?> 
                            <script>
                                document.getElementById('error-photo').innerHTML = '*** Please enter the only images';
                            </script>
                        <?php
                        }                                         
                    } else {
                    ?>
                        <script>
                            document.getElementById('discription-error').innerHTML = '*** Please enter the discription atleast 8 character';
                        </script>
                    <?php
                    }
                } else {
                ?>
                    <script>
                        document.getElementById('error-address').innerHTML = '*** Please enter the address atleast 8 character';
                    </script>
                <?php
                }
            } else {
            ?>
                <script>
                    document.getElementById('error-city').innerHTML = '*** Please enter the valid name';
                </script>
            <?php
            }
        } else {
        ?>
            <script>
                document.getElementById('error-propertyName').innerHTML = '*** Please enter must 8 character to name';
            </script>
        <?php
        }
    }
?>