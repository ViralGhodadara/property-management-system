<?php
    session_start();

    require "../../connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($_SESSION['seller_username'])) { echo $_SESSION['seller_username']; } ?></title>
    <link rel="stylesheet" href="../../custom.css">
</head>
<body>
    <nav>
        <div class="w3-sidebar w3-black w3-bar-block" style="width:25%">
            <h3 class="w3-bar-item" style="font-family: monospace;"><?php echo $_SESSION['seller_username']; ?></h3>
            <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/saleAdminPanel.php" class="w3-bar-item myclass">Home</a>
            <a href="#" class="w3-bar-item myclass">List Property</a>
            <a href="http://localhost/viral/property-management/adminPanel/myProperty.php" class="w3-bar-item myclass">My Property</a>
            <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/myBids.php" class="w3-bar-item myclass">Property Bids</a>
            <a href="http://localhost/viral/property-management/" class="w3-bar-item myclass">Logout</a>
        </div>
    </nav>

    <div style="margin-left:25%">
        <div>
            <h3 class="heading">List Property</h3>
        </div>
        <br><br>
        <div class="container-listProperty">
            <br>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="propertyName" placeholder="Name of property" class="box-NameProperty"><br><br>
                <p class="error" id="error-propertyName" style="margin-left: 75px;"></p>
                <select name="pSize" class="opt" style="margin-left: 75px;" required>
                    <option value="">Property Size</option>
                    <option value="1/2 BHK">1/2 BHK</option>
                    <option value="4/8 BHK">4/8 BHK</option>
                    <option value="10/12 BHK">10/12 BHK</option>
                </select><br>
                <input type="number" name="price" placeholder="Price" class="box" style="margin-left: 75px;" required><br>
                <input type="text" name="city" placeholder="City" class="box" style="margin-left: 75px;" required><br>
                <p class="error" id="error-city"></p>
                <textarea name="address" placeholder="Address" cols="40" rows="7" required  class="txtarea" style="margin-left: 75px;"></textarea><br>
                <p class="error" id="error-address"></p>
                <select name="type" class="opt" style="margin-left: 75px;">
                    <option value='' selected disabled>Type</option>
                    <option value="sale">Sale</option>
                    <option value="rent">Rent</option>
                </select><br>
                <textarea name="discription" placeholder="Discription" cols="40" rows="7" required  class="txtarea" style="margin-left: 75px;"></textarea><br>
                <p class="error" id="discription-error"></p>
                <input type="file" name="photo" required style="margin-left: 75px;"><br><br>
                <p class="error" id="error-photo"></p>
                <button type="submit" name="btn-listProperty" class="btn" style="margin-left: 75px;">List Property</button>
            </form>
        </div>
    </div>
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
        $path = 'flatImages/'.$fileName;

        $photoType = array('image/png', 'image/jpg', 'image/jpeg');

        if (strlen($propertName) > 7) {
            if (strlen($city) > 3) {
                if (strlen($address) > 7) {
                    if (strlen($discription) > 7) {
                        if (in_array($fileType, $photoType)) {
                            if (move_uploaded_file($fileTmpName, $path)) {
                                
                                // $insert = ;
                                $insertProperty = $conn->prepare('INSERT INTO listproperty (property_name, propert_size, price, city, address, type, discription, username, bid, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                                if ($insertProperty->execute([$propertName, $pSize, $propertPrice, $city, $address, $type, $discription, $_SESSION['seller_username'], 'null', $path])) {
                                echo "The username is : ".$_SESSION['seller_username'];
                               ?>
                                    <script>
                                        alert('Your propert listed successfully.....');
                                        console.log("this is a not a run")
                                    </script>
                                <?php
                                } else {
                                    echo "<script>console.log('you can redirect else part')</script>";
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

<!-- This is a name : if (isset($_POST['btn-listProperty'])) { error_reporting(0); $propertName = $_POST['propertyName']; $propertSize = $_POST['pSize']; $propertPrice = $_POST['price']; $city = $_POST['city']; $address = $_POST['address']; $type = $_POST['type']; $discription = $_POST['discription']; echo " -->
