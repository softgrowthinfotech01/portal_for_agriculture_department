<?php
session_start();
require_once "conn.php";
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> ATMA </title>
    <!-- favicons Icons -->
   

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">

    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/custom-animate.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/vendors/jarallax/jarallax.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css" />
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="assets/vendors/nouislider/nouislider.pips.css" />
    <link rel="stylesheet" href="assets/vendors/odometer/odometer.min.css" />
    <link rel="stylesheet" href="assets/vendors/swiper/swiper.min.css" />
    <link rel="stylesheet" href="assets/vendors/agrion-icons/style.css">
    <link rel="stylesheet" href="assets/vendors/tiny-slider/tiny-slider.min.css" />
    <link rel="stylesheet" href="assets/vendors/reey-font/stylesheet.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.theme.default.min.css" />
    <link rel="stylesheet" href="assets/vendors/bxslider/jquery.bxslider.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-select/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="assets/vendors/vegas/vegas.min.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="assets/vendors/timepicker/timePicker.css" />
    <link rel="stylesheet" href="assets/vendors/nice-select/nice-select.css" />

    <!-- template styles -->
    <link rel="stylesheet" href="assets/css/agrion.css" />
    <link rel="stylesheet" href="assets/css/agrion-responsive.css" />
</head>

<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>





   
    <!-- /.preloader -->

<?php include_once "header.php";?>
    <!-- /.page-wrapper -->


  <section class="product">
            <div class="container">
                <!-- <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="product__sidebar">
                            <div class="shop-search product__sidebar-single">
                                <form action="#">
                                    <input type="text" placeholder="Search">
                                </form>
                            </div>
                            <div class="product__price-ranger product__sidebar-single">
                                <h3 class="product__sidebar-title">Price</h3>
                                <div class="price-ranger">
                                    <div id="slider-range"></div>
                                    <div class="ranger-min-max-block">
                                        <input type="text" readonly class="min">
                                        <span>-</span>
                                        <input type="text" readonly class="max">
                                        <input type="submit" value="Filter">
                                    </div>
                                </div>
                            </div> 
                           
                        </div>
                    </div>-->
                    <div class="col-xl-12 col-lg-12">
                        <div class="product__items">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="product__showing-result">
                                     <h2>District</h2>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="product__all" >
                                <div class="row" >
                                    <!--Product All Single Start-->
                                    <?php
                                    $stmt_city_list = $conn->prepare("SELECT d.district_name,d.district_id,b.blog_status,COUNT(b.blog_id) AS count_blog_districtwise FROM district d LEFT JOIN blog b ON d.district_id=b.district_id where b.blog_status=1 OR b.blog_status is null group by d.district_id ORDER BY district_name ASC; ");
                                    $stmt_city_list->execute();
                                    $row_city_list = $stmt_city_list->fetchAll(PDO::FETCH_ASSOC);
                                    for($r=0;$r<count($row_city_list);$r++) 
                                    {
                                        ?>
                                        <div class="col-xl-2 col-lg-2 col-md-3" onclick="startsession('district_id',<?php echo $row_city_list[$r]['district_id'];?>)">
                                            <div class="product__all-single">
                                                <div class="product__all-img-box" >
                                                    <div class="product__all-img m-3" style="background: linear-gradient(to bottom right, #070630 0%,#060454 100%);color:#fff;box-shadow: rgb(85, 91, 255) 0px 0px 0px 3px, rgb(31, 193, 27) 0px 0px 0px 6px, rgb(255, 217, 19) 0px 0px 0px 9px, rgb(255, 156, 85) 0px 0px 0px 12px, rgb(255, 85, 85) 0px 0px 0px 15px;">
                                                       <p class="p-4 text-light " style="white-space: nowrap;"><?php echo $row_city_list[$r]['district_name'];?></p>
                                                        <span class="product__all-sale"><?php echo $row_city_list[$r]['count_blog_districtwise'];?></span>
                                                       
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <script>
                                    function startsession(name,value)
                                    {
                                       // alert(name);
                                       // alert(value);
                                        $.ajax({
                                          url: "createsession.php",
                                          method:'POST',
                                          data: {name: name, value: value},
                                          success: function(data){
                                             window.location.href = "blog";
                                          }
                                       });
                                    }
                                    </script>
                                    <!--Product All Single End-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- /.mobile-nav__wrapper -->
    <?php require_once "search_box.php";?>
    <?php include_once "footer.php";?>
        <!-- /.search-popup -->



    <script src="assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/jarallax/jarallax.min.js"></script>
    <script src="assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js"></script>
    <script src="assets/vendors/jquery-appear/jquery.appear.min.js"></script>
    <script src="assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js"></script>
    <script src="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/vendors/jquery-validate/jquery.validate.min.js"></script>
    <script src="assets/vendors/nouislider/nouislider.min.js"></script>
    <script src="assets/vendors/odometer/odometer.min.js"></script>
    <script src="assets/vendors/swiper/swiper.min.js"></script>
    <script src="assets/vendors/tiny-slider/tiny-slider.min.js"></script>
    <script src="assets/vendors/wnumb/wNumb.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/vendors/isotope/isotope.js"></script>
    <script src="assets/vendors/countdown/countdown.min.js"></script>
    <script src="assets/vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/vendors/bxslider/jquery.bxslider.min.js"></script>
    <script src="assets/vendors/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="assets/vendors/vegas/vegas.min.js"></script>
    <script src="assets/vendors/jquery-ui/jquery-ui.js"></script>
    <script src="assets/vendors/timepicker/timePicker.js"></script>
    <script src="assets/vendors/circleType/jquery.circleType.js"></script>
    <script src="assets/vendors/circleType/jquery.lettering.min.js"></script>




    <!-- template js -->
    <script src="assets/js/agrion.js"></script>
</body>


<!-- Mirrored from layerdrops.com/agrionhtml/main-html/products.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Jun 2023 06:04:57 GMT -->
</html>