<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">

</head>
<body>
    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="first-item">
                        <div class="logo">
                            <img src="images/img_3949.jpg" alt="Signature Wear ecommerce site"  height="100px" width="100px">
                        </div>
                        <ul>
                            <li><a href="#">16501 Collins Ave, Sunny Isles Beach, FL 33160, United States</a></li>
                            <li><a href="#">hexashop@company.com</a></li>
                            <li><a href="#">010-020-0340</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Shopping &amp; Categories</h4>
                    <ul>
                        <li><a href="man_watches.php">Men’s Shopping</a></li>
                        <li><a href="women_watches.php">Women’s Shopping</a></li>
                        <li><a href="man_accessories.php">Accessories Shopping</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="home.php">Homepage</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="h">Help</a></li>
                        <li><a href="Contact.php">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Help &amp; Information</h4>
                    <ul>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">FAQ's</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Tracking ID</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <p>Copyright © 2025 Signature Wear., Ltd. All Rights Reserved. 
                        
                        <br>Design: <a href="https://www.instagram.com/umer_suleman17/profilecard/?igsh=Z2t1ajNmMzh2YnZv" target="_parent" title="free css templates">Umer Suleman</a>

                        <!-- <br>Distributed By: <a href="https://themewagon.com" target="_blank" title="free & premium responsive templates">ThemeWagon</a></p> -->
                        <ul>
                            <li><a href="https://www.facebook.com/profile.php?id=61575287021430"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://youtube.com/@signatureswear?si=Lrp6oZkw50DDLAz4"><i class="fa-brands fa-youtube"></i></a></li>
                            <li><a href="https://www.tiktok.com/@the_signature_store3?_t=ZS-8wDRPJmmaR7&_r=1"><i class="fa-brands fa-tiktok"></i></a></li>
                            <li><a href="https://www.instagram.com/the_signaturesstore?utm_source=qr&igsh=MTZmNGkyNDJ1dnlqZg=="><i class="fa-brands fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/slick.js"></script> 
    <script src="assets/js/lightbox.js"></script> 
    <script src="assets/js/isotope.js"></script> 
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });

    </script>

  </body>
</html>