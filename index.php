<?php
    require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proparty rent-sale</title>
    <link rel="stylesheet" href="custom.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
        <nav>
            <ul>
                <li>
                    <a href="#">Home</a> 
                </li>
                <li>
                    <a href="#about">About</a> 
                </li>
                <li>
                    <a href="http://localhost/viral/property-management/login-system/registration.php">Registration</a>
                </li>
                <li>
                    <a href="http://localhost/viral/property-management/login-system/login.php">Login</a> 
                </li>
            </ul>
        </nav>
        <div class="main-banner">
          <br>

            
        </div>
        <?php
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
        <br>
        <h3 class="title" style="text-align: center;"><span style="color: red">***</span> All Properties<span style="color: red"> ***</span></h3>
        <br>
        <div class="all-property">
            <?php

                for ($i = 0; $i < $num; $i++) {                     

                    for ($v = 0; $v < 3; $v++) {
                        if ($property = $numOfProperty->fetch()) {
                        ?>
                            <div class="property">
                                <a href="http://localhost/viral/property-management/adminPanel/purchaseAdminpanel/purchaseProperty.php?idOfProperty=<?php echo $property['id']; ?>">
                                    <img src="adminPanel/saleAdmin/<?php echo $property['image']; ?>" class="property_images">
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
    <!-- Footer -->
<footer class="page-footer font-small unique-color-dark" id="about" >
<!-- 6351ce -->
<div style="background-color: #6351ce;">
  <div class="container">

    <!-- Grid row-->
    <div class="row py-4 d-flex align-items-center">

      <!-- Grid column -->
      <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
        <h6 class="mb-0">Get connected with us on social networks!</h6>
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-6 col-lg-7 text-center text-md-right">

        <!-- Facebook -->
        <a class="fb-ic">
          <i class="fab fa-facebook-f white-text mr-4"> </i>
        </a>
        <!-- Twitter -->
        <a class="tw-ic">
          <i class="fab fa-twitter white-text mr-4"> </i>
        </a>
        <!-- Google +-->
        <a class="gplus-ic">
          <i class="fab fa-google-plus-g white-text mr-4"> </i>
        </a>
        <!--Linkedin -->
        <a class="li-ic">
          <i class="fab fa-linkedin-in white-text mr-4"> </i>
        </a>
        <!--Instagram-->
        <a class="ins-ic">
          <i class="fab fa-instagram white-text"> </i>
        </a>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->

  </div>
</div>

<!-- Footer Links -->
<div class="container text-center text-md-left mt-5">

  <!-- Grid row -->
  <div class="row mt-3">

    <!-- Grid column -->
    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

      <!-- Content -->
      <h6 class="text-uppercase font-weight-bold">Company name</h6>
      <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
      <p>Here you can buy and sell you property. and enjoy it service for free.</p>
      <br><br>
      <p>Surce code = <a href=""><i class="fa fa-code" style="font-size: 25px" aria-hidden="true"></i></a></p>
    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

      <!-- Links -->
      <h6 class="text-uppercase font-weight-bold">Social Links</h6>
      <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
      <p>
        <a href="https://www.facebook.com/viral.ghodadara.3">
            <i class="fa fa-facebook-square" style="font-size: 30px;"></i>
        </a>
      </p>
      <p>
        <a href="https://twitter.com/GhodadaraViral" style="font-size: 30px;">
            <i class="fa fa-twitter"></i>
        </a>
      </p>
      <p>
        <a href="https://www.instagram.com/viral_ghodadara/" style="font-size: 30px; color: maroon;">
            <i class="fa fa-instagram"></i>
        </a>
      </p>
      <p>
        <a href="#!" style="font-size: 30px; color: #222;">
            <i class="fa fa-linkedin"></i>
        </a>
      </p>

    </div>
    <!-- Grid column -->

    <!-- Grid column -->

    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

      <!-- Links -->
      <h6 class="text-uppercase font-weight-bold">Contact</h6>
      <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
      <p style="color: black;">
        <i class="fa fa-home"></i> Surat, Gujarat, India</p>
      <p>
        <i class="fa fa-envelope-o"></i>&nbsp;&nbsp;viralghodadra37@gmail.com</p>
      <p>
        <i class="fa fa-mobile"></i> + 93 76007 42473</p>
      <p>
        <i class="fa fa-phone"></i> + 01 234 567 89</p>

    </div>
    <!-- Grid column -->

  </div>
  <!-- Grid row -->

</div>
<!-- Footer Links -->

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2020 Copyright:
  <a href="https://mdbootstrap.com/"> https://viralghodadara.000webhostapp.com/</a>
</div>
<!-- Copyright -->

</footer>
<!-- Footer -->

</body>
</html>