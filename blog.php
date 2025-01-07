<?php
session_start();
require_once "conn.php";
if(isset($_SESSION['district_id']))
{
    $district_id=$_SESSION['district_id'];
    //get district name
    $stmt_district = $conn->prepare("SELECT district_name FROM district WHERE district_id=$district_id");
    $stmt_district->execute();
    $row_district = $stmt_district->fetchAll(PDO::FETCH_ASSOC);
    
    
    //get all blogs from this district
    $stmt_question_list = $conn->prepare("SELECT * FROM blog WHERE district_id=$district_id AND blog_status=1 ORDER BY added_on DESC");
    $stmt_question_list->execute();
    $row_question_list = $stmt_question_list->fetchAll(PDO::FETCH_ASSOC);
    //print_r($row_question_list);exit;
}
else
{
    echo '<script>alert("District Id not found.");window.location.href = "districts";</script>';
}
?>
<style>
    .blog-layout
    {
        height:14rem;
         overflow: hidden;
  text-overflow: ellipsis;
    }
    .sr-32px a{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .sr-icon-white.socializer a, .sr-icon-white.socializer a:visited{
        display: flex;
    }
</style>
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

    <!-- template styles -->
    <link rel="stylesheet" href="assets/css/agrion.css" />
    <link rel="stylesheet" href="assets/css/agrion-responsive.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/vaakash/socializer@2f749eb/css/socializer.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
</head>

<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>


<?php include_once "header.php";?>


    <!-- /.stricky-header -->

        <!--Page Header Start-->
        <section class="page-header p-0">
            <!--<div class="page-header-bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg)">-->
            <!--</div>-->
            <div class="container">
                <div class="page-header__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="home">Home</a></li>
                        <li><span>/</span></li>
                        <li>Blog</li>
                    </ul>
                    <h2><?php echo $row_district[0]['district_name'];?></h2>
                </div>
            </div>
        </section>
        <!--Page Header End-->

        <!--Blog Page Start-->
        <section class="blog-page">
            <div class="container">
                <div class="row">
                    <?php
                if($row_question_list)
                {
                    foreach($row_question_list AS $r)
                    {
                        //get category name
                        $stmt_category = $conn->prepare("SELECT category_name FROM category WHERE category_id=".$r['category_id']);
                        $stmt_category->execute();
                        $row_category = $stmt_category->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <!--Blog One Single Start-->
                    <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="100ms" onclick="startsession('blog_id',<?php echo $r['blog_id'];?>)">
                        <div class="blog-one__single">
                            <div class="blog-one__img img-fluid" style="height:14rem;">
                                <img src="uploaded_images/blog_title_images/<?php echo $r['blog_title_image'];?>" alt="">
                                <div class="blog-one__date">
                                    <span><?php echo date('d',strtotime($r['added_on']));?></span>
                                    <p><?php echo date('M',strtotime($r['added_on']));?></p>
                                </div>
                            </div>
                            <div class="blog-one__content blog-layout">
                                <ul class="blog-one__meta list-unstyled">
                                    <li>
                                        <a href="blog_details"><i class="fas fa-user-circle"></i><?php echo $row_district[0]['district_name'];?></a>
                                    </li>
                                    <li>
                                        <a href="blog_details"><i class="fas fa-comments"></i><?php echo $row_category[0]['category_name'];?></a>
                                    </li>
                                </ul>
                                <h3 class="blog-one__title"><?php echo $r['blog_title'];?></h3>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }
                else
                {
                    echo "<h1>No blogs found for this district.</h1>";
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
                                             window.location.href = "blog_details";
                                          }
                                       });
                                    }
                                    </script>
                </div>
            </div>
<?php
// if no blogs exist then dont show social media
if($row_question_list)
{
?>
            <div class="socializer a sr-32px sr-opacity sr-icon-white sr-pad" style="padding-left:219px;"><span class="sr-facebook"><a href="https://www.facebook.com/share.php?u=https://atmachandrapur.in/atma/blog" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></span>
     <span class="sr-email"><a href="mailto:?subject=ATMA&amp;body=https://atmachandrapur.in/atma/blog" target="_blank" title="Email"><i class="fa fa-envelope"></i></a></span>
     
    
     
     <span class="sr-whatsapp"><a href="whatsapp://send?text=https://atmachandrapur.in/atma/blog" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a></span></div>
        </section>
<?php
}
?>
        <!--Blog Page End-->

        <!--Site Footer Start-->
      <?php include_once "footer.php";?>
        <!--Site Footer End-->


    </div><!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

            <div class="logo-box">
                <a href="index.html" aria-label="logo image"><img src="assets/images/resources/logo-2.png" width="143"
                        alt="" /></a>
            </div>
            <!-- /.logo-box -->
            <div class="mobile-nav__container"></div>
            <!-- /.mobile-nav__container -->

            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="fa fa-envelope"></i>
                    <a href="mailto:needhelp@packageName__.com">needhelp@agrion.com</a>
                </li>
                <li>
                    <i class="fa fa-phone-alt"></i>
                    <a href="tel:666-888-0000">666 888 0000</a>
                </li>
            </ul><!-- /.mobile-nav__contact -->
            <div class="mobile-nav__top">
                <div class="mobile-nav__social">
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-facebook-square"></a>
                    <a href="#" class="fab fa-pinterest-p"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div><!-- /.mobile-nav__social -->
            </div><!-- /.mobile-nav__top -->



        </div>
        <!-- /.mobile-nav__content -->
    </div>
    <!-- /.mobile-nav__wrapper -->

    <?php require_once "search_box.php";?>
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


<!-- Mirrored from layerdrops.com/agrionhtml/main-html/blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Jun 2023 06:04:53 GMT -->
</html>