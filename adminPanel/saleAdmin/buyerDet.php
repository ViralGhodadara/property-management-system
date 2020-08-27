<?php
    require '../../connection.php';
    if (isset($_GET['det'])) {
        $buyerData = $conn->prepare('SELECT * FROM propertybid WHERE property_id = ?');
        $buyerData->execute([$_GET['det']]);

        $data = $buyerData->fetch();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Buyer</title>
    <link rel="stylesheet" href="../../custom.css">
</head>
<body bgcolor="beige">
    <center>
        <h3 class="title">Buyer Information</h3>
        <div class="container-buyer-detail">
            <br><br>
            <table>
                <tbody>
                    <tr> 
                        <td>
                            <p class="paraDet"><label><b> Buyer Name : </b></label><?php echo $data['buyerName']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="paraDet"><label><b>Mobile Number : </b></label><?php echo $data['buyer_mobile_number']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="msgBuyserDet">
                                <p class="paraDet"><label><b>Message : </b></label><?php echo $data['msg']; ?></p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>     
            <br>
            <p class="last-para">back to <a href="http://localhost/viral/property-management/adminPanel/saleAdmin/myBids.php#">Bid ?</a></p>   
        </div>
    </center>
</body>
</html>