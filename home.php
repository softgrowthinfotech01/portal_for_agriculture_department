<?php
session_start();
require_once "conn.php";
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception; 

if(isset($_POST['submit_contact']))
{
    extract($_POST);
    $to='info@atmamaharashtra.com';
    require_once 'PHPMailer/src/Exception.php'; 
    require_once 'PHPMailer/src/PHPMailer.php'; 
    require_once 'PHPMailer/src/SMTP.php'; 
	$mail = new PHPMailer;
	$mail->setFrom('info@atmamaharashtra.com', 'Atma Maharashtra');
	$mail->addAddress($to);
//	$mail->addBCC('');
	$mail->isHTML(true);
	$mail->Subject  = "Atma Maharashtra Contact Request";
	$mail->Body     = "Name: ".$contact_name."<br> Email: ".$contact_email."<br> Phone No: ".$contact_phone."<br> Organization: ".$contact_organization."<br> Message: ".$contact_message;
	if($mail->send()) 
	{
		echo '<script>alert("Contact request sent. We will contact you soon.");window.location.href = "home";</script>';
	} 
	else 
	{
       	echo '<script>alert("There is some error. Please try again later.");window.location.href = "home";</script>';
	}
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Home ATMA</title>
    <!-- favicons Icons -->

    <meta name="description" content="" />

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
    <style rel="stylesheet">
    .main-slider .image-layer::before {
  
  background-color: transparent !important;
    }
    
    @media(max-width: 768px){
        .swiper-wrapper{
            height: 156px !important;
        }
        .main-slider .image-layer{
            /*background-size: contain;*/
            background-position: initial;
        }
    }
</style>
</head>

<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>





    <!-- /.preloader -->

<div class="page-wrapper">
       <?php include_once "header.php";?>
 
  
        <div class="stricky-header stricked-menu main-menu">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->

        <!--Main Slider Start-->
        <section class="main-slider clearfix">
            <div class="swiper-container thm-swiper__slider" data-swiper-options='{"slidesPerView": 1, "loop": true,
                "effect": "fade",
                "pagination": {
                "el": "#main-slider-pagination",
                "type": "bullets",
                "clickable": true
                },
                "navigation": {
                "nextEl": "#main-slider__swiper-button-next",
                "prevEl": "#main-slider__swiper-button-prev"
                },
                "autoplay": {
                "delay": 5000
                }}'>
                <div class="swiper-wrapper">
                <?php
                   $stmt_gallery_image = $conn->prepare("SELECT * FROM slider_image ORDER BY slider_image_id DESC");
                    $stmt_gallery_image->execute();
                    $row_gallery_show = $stmt_gallery_image->fetchAll(PDO::FETCH_ASSOC);
                    for($sl=0;$sl<count($row_gallery_show);$sl++) {
                  ?>
                    <div class="swiper-slide">
                        <div class="image-layer"
                            style="background-image: url(admin/images/slider/<?php echo $row_gallery_show[$sl]['slider_path'];?>);"></div>
                        <!-- /.image-layer -->
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="main-slider__content">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>

                   <!-- <div class="swiper-slide">
                        <div class="image-layer"
                            style="background-image: url(assets/images/backgrounds/main-slider-1-2.jpg);"></div>
                        
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="main-slider__content">
                                        <p class="main-slider__sub-title">We are Producing Natural Products</p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="image-layer"
                            style="background-image: url(assets/images/backgrounds/main-slider-1-3.jpg);"></div>
                        
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="main-slider__content">
                                        <p class="main-slider__sub-title">We are Producing Natural Products</p>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->


                </div>

                <div class="swiper-pagination" id="main-slider-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="main-slider__nav">
                    <div class="swiper-button-prev" id="main-slider__swiper-button-next">
                        <i class="icon-right-arrow"></i>
                    </div>
                    <div class="swiper-button-next" id="main-slider__swiper-button-prev">
                        <i class="icon-right-arrow"></i>
                    </div>
                </div>

            </div>
        </section>
        <!--Main Slider End-->



        <!--About One Start-->
        <!--<section class="about-one">-->
        <!--    <div class="about-one-shape-1 float-bob-x">-->
        <!--        <img src="assets/images/shapes/about-one-shape-1.png" alt="">-->
        <!--    </div>-->
        <!--    <div class="container">-->
        <!--        <div class="row">-->
        <!--            <div class="col-xl-6">-->
        <!--                <div class="about-one__left">-->
        <!--                    <div class="section-title text-left">-->
                               
        <!--                        <h2 class="section-title__title">Agriculture Technology Management Agency Yojana</h2>-->
        <!--                        <div class="section-title__icon">-->
        <!--                            <img src="assets/images/icon/section-title-icon-1.png" alt="">-->
        <!--                        </div>-->
        <!--                    </div>-->
                            
        <!--                    <p class="about-one__text-2">The need to grow more food was felt during the 19th Century because of the increasing pressure of population. According to the recommendation of Famine Commission(1881), Agriculture Department was established in 1883. Work started with the aim of helping the rural community to achieve higher productivity in agriculture. Agriculture and Land Records Departments were functioning together till 1907. After getting encouraging results in an effort made during 1915-16 to stop soil loss, Mr Kitting, the then Agriculture Director started soil conservation work from 1922.</p>-->
        <!--                    <ul class="list-unstyled about-one__points">-->
        <!--                        <li>-->
        <!--                            <div class="icon">-->
        <!--                                <span class="icon-tick"></span>-->
        <!--                            </div>-->
        <!--                            <div class="text">-->
        <!--                                <p>Agriculture Department took up various land development activities with the enactment in 1942 and subsequent enforcement of Land Development Act in 1943.</p>-->
        <!--                            </div>-->
        <!--                        </li>-->
        <!--                        <li>-->
        <!--                            <div class="icon">-->
        <!--                                <span class="icon-tick"></span>-->
        <!--                            </div>-->
        <!--                            <div class="text">-->
        <!--                                <p>Available but the majority alteration.</p>-->
        <!--                            </div>-->
        <!--                        </li>-->
        <!--                    </ul>-->
                            
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-xl-6">-->
        <!--                <div class="about-one__right">-->
        <!--                    <div class="about-one__img-box wow slideInRight" data-wow-delay="100ms"-->
        <!--                        data-wow-duration="2500ms">-->
        <!--                        <div class="about-one__img-one">-->
        <!--                            <img src="assets/images/resources/about-one-img-1.jpg" alt="">-->
        <!--                        </div>-->
        <!--                        <div class="about-one__img-two">-->
        <!--                            <img src="assets/images/resources/about-one-img-2.jpg" alt="">-->
        <!--                        </div>-->
        <!--                        <div class="about-one__video-link">-->
        <!--                            <a href="https://www.youtube.com/watch?v=Get7rqXYrbQ" class="video-popup">-->
        <!--                                <div class="about-one__video-icon">-->
        <!--                                    <span class="fa fa-play"></span>-->
        <!--                                    <i class="ripple"></i>-->
        <!--                                </div>-->
        <!--                            </a>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!--About One End-->
     <!-- blog section start -->
     <section class="blog-one">
            <div class="container">
                <div class="section-title text-center">
                   
                    <h2 class="section-title__title">Latest Blog</h2>
                    <div class="section-title__icon">
                        <img src="assets/images/icon/section-title-icon-1.png" alt="">
                    </div>
                </div>
                <div class="row">
                    <?php
                     $stmt_question_list = $conn->prepare("SELECT * FROM blog WHERE blog_status=1 ORDER BY added_on DESC LIMIT 0,30");
                    $stmt_question_list->execute();
                    $row_question_list = $stmt_question_list->fetchAll(PDO::FETCH_ASSOC);
                    foreach($row_question_list AS $r)
                    {
                        //get category name
                        $stmt_category = $conn->prepare("SELECT category_name FROM category WHERE category_id=".$r['category_id']);
                        $stmt_category->execute();
                        $row_category = $stmt_category->fetchAll(PDO::FETCH_ASSOC);
                        
                        $stmt_district = $conn->prepare("SELECT district_name FROM district WHERE district_id=".$r['district_id']);
                        $stmt_district->execute();
                        $row_district = $stmt_district->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <!--Blog One Single Start-->
                    <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="100ms" onclick="startsession('blog_id',<?php echo $r['blog_id'];?>)">
                        <div class="blog-one__single">
                            <div class="blog-one__img" style="height:14rem;">
                                <img src="uploaded_images/blog_title_images/<?php echo $r['blog_title_image'];?>" alt="">
                                <div class="blog-one__date d-flex">
                                    <span><?php echo date('d',strtotime($r['added_on']));?>&nbsp;</span>
                                    <p><?php echo date('M',strtotime($r['added_on']));?>&nbsp;</p>
                                     <p><?php echo date('Y',strtotime($r['added_on']));?></p>
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
        </section>
     <!-- Blog section end-->
       
<section >
     <?php include_once "weather.php";?>
    
</section>
        <!--Brand One Start-->
        <section class="brand-one">
            <div class="brand-one__inner">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="brand-one__carousel thm-owl__carousel owl-theme owl-carousel" data-owl-options='{
                                "margin": 0,
                                "smartSpeed": 700,
                                "loop":true,
                                "autoplay": 6000,
                                "nav":false,
                                "dots":false,
                                "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                                "responsive":{
                                    "0":{
                                        "items":1
                                    },
                                    "600":{
                                        "items":2
                                    },
                                    "800":{
                                        "items":3
                                    },
                                    "1024":{
                                        "items": 4
                                    },
                                    "1200":{
                                        "items": 5
                                    }
                                }
                            }'>
                                <!--Brand One Single-->
                                <div class="brand-one__single">
                                    <div style="padding-right: 10px;">
                                    <a href="https://www.smart-mh.org/">
                                            <img src="assets/images/brand/SMART.png" alt="smart" width="100px" height="150px">
                                    </a>
                                    </div>
                                </div>
                                <!--Brand One Single-->
                                <div class="brand-one__single">
                                    <div style="padding-right: 10px;" >
                                      <a href="https://krishi.maharashtra.gov.in/">  <img src="assets/images/resources/KrushiLogo.jpg" alt="krishi" width="100px" height="150px"></a>
                                    </div>
                                </div>
                                <!--Brand One Single-->
                                <div class="brand-one__single">
                                    <div style="padding-right: 10px;" >
                                   <a href="https://www.maharashtra.gov.in/">     <img src="assets/images/brand/MAHARSTRA.png" alt="maharashtra" width="100px" height="150px"></a>
                                    </div>
                                </div>
                                <!--Brand One Single-->
                                <div class="brand-one__single">
                                    <div style="padding-right: 10px;">
                                       
                                        <a href="https://www.pmkisan.gov.in/"> <img src="assets/images/brand/pm_mandhan.jpg" alt=""></a>
                                    </div>
                                </div>
                                <!--Brand One Single-->
                                <div class="brand-one__single">
                                    <div style="padding-right: 10px;">
                                        <a href="https://farmer.gov.in/"> <img src="assets/images/brand/2.jpg" alt="Farmer Portal"></a>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Brand One End-->

       

        
       


        <!--Contact One Start-->
        <section class="contact-one">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="contact-one__left">
                            <div class="section-title text-left">
                                <span class="section-title__tagline">Contact Now</span>
                                <h2 class="section-title__title">Get in touch now</h2>
                                <div class="section-title__icon">
                                    <img src="assets/images/icon/section-title-icon-1.png" alt="">
                                </div>
                            </div>
                            
                            <ul class="list-unstyled contact-one__contact-list">
                                <!--<li>
                                    <div class="icon">
                                        <span class="fas fa-phone-alt"></span>
                                    </div>
                                    <div class="content">
                                        <p>Have Question?</p>
                                        <h4><a href="tel:9100000000">Free +91 (0000)-0000</a></h4>
                                    </div>
                                </li>-->
                                <li>
                                    <div class="icon">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                    <div class="content">
                                        <p>Write Email</p>
                                        <h4><a href="mailto:info@atmamaharashtra.com">info@atmamaharashtra.com</a></h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="fas fa-map-marker"></span>
                                    </div>
                                    <div class="content">
                                        <p>Visit Now</p>
                                        <h4>ATMA Maharashtra</h4>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7">
                        <div class="contact-one__right">
                            <div class="contact-one__bg float-bob-x"
                                style="background-image: url(assets/images/shapes/contact-one-shape-1.png);"></div>
                            <div class="row">
                                <div class="contact-one__form-box">
                                    <form action=""
                                        class="contact-one__form" novalidate="novalidate" method="post">
                                         <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <div class="contact-one__input-box">
                                                    <input type="text" placeholder="Your Name" name="contact_name">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <div class="contact-one__input-box">
                                                    <input type="email" placeholder="Email Address" name="contact_email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <div class="contact-one__input-box">
                                                    <input type="text" placeholder="Phone Number" name="contact_phone">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <div class="contact-one__input-box">
                                                    <input type="text" placeholder="Organization Name" name="contact_organization">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="contact-one__input-box text-message-box">
                                                    <textarea name="contact_message" placeholder="Write a Message"></textarea>
                                                </div>
                                                <div class="contact-one__btn-box">
                                                    <button name="submit_contact" type="submit" class="thm-btn contact-two__btn">Send a Message<i
                                            class="icon-right-arrow"></i> </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Contact One End-->

        <!--Blog One Start-->
        
        <!--Blog One End-->

        <!--Cta One Start-->
       
        <!--Cta One End-->

        <!--Site Footer Start-->
      <?php include_once "footer.php";?>
        <!--Site Footer End-->


    </div>
    <!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

            <div class="logo-box">
                <a href="index.html" aria-label="logo image"><img src="assets/images/resources/logo-2.png" width="122"
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


<!-- Mirrored from layerdrops.com/agrionhtml/main-html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Jun 2023 06:04:10 GMT -->
</html>