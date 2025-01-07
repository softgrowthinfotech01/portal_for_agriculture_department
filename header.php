 <style>
 body, html{
     overflow-x: hidden;
 }
 .main-header__wrapper
     {
        /*background:#E8620C; */
   background: rgb(207,53,65);
background: linear-gradient(90deg, rgba(207,53,65,1) 0%, rgba(165,108,28,0.9960316890428046) 32%, rgba(149,13,13,1) 100%);
 
     }
     .main-menu .mobile-nav__toggler{
         color: white;
     }
     .main-menu .main-menu__list > li > a, .stricky-header .main-menu__list > li > a
     {
         color: black;
     }
     .main-menu .main-menu__list>li.current>a,
    .main-menu .main-menu__list>li:hover>a,
    .stricky-header .main-menu__list>li.current>a,
    .stricky-header .main-menu__list>li:hover>a{
        background: var(--agrion-base);
        color: white;
        padding: 2px 10px;
        border-radius: 10px;
    }
     .main-header__menu-box-bottom{
         border-top: 3px solid white;
     }
     .main-header__wrapper-inner{
         align-items: inherit;
     }
     .main-menu__wrapper-inner{
         justify-content: center;
     }
     .main-header__wrapper-inner{
         justify-content: flex-start;
     }
     .main-header__menu-box-top{
         background: transparent;
         padding: 0;
     }
     .main-header__menu-box-top h4{
         font-size: 2.1rem;
         color: white;
  /*       font-size: 1.8rem;*/
  /*color: white;*/
  /*font-family: var(--agrion-font);*/
     }
     .main-header__menu-box-top .center{
         font-size: 1.1rem;
     }
     .main-header__logo{
         padding: 15px 0 5px;
     }
     .main-header__logo img{
         width: 100px;
         height: 100px;
     }
     .head_title{
         display: flex;
         justify-content: space-between;
        
     }
     .symbol{
         padding: 15px 0 5px;
     }
     .section-title__title {
  margin: 0;
    margin-bottom: 0px;
  color: var(--agrion-black);
  font-size: 43px;
  line-height: 50px;

  margin-bottom: 2px;
  text-transform: uppercase;
  font-family: var(--agrion-font);
}
     .symbol img{
         width: 65px;
         height: 100px;
     }
     .main-header__contact-list{
         display: block;
     }

     @media (max-width: 767px)
     {
        .main-header__logo img{
            width: 50px;
            height: 50px;
        }
        .symbol img{
            width: 32px;
            height: 50px;
        }
        .main-header__menu-box-bottom{
            border-top: none;
        }
         .main-header__menu-box-top
         {
             display:content !important;
             background:none;
             padding:0px;
         }
         .main-header__menu-box-top li
         {
            font-size:12px;
         }
         .main-header__menu-box-top h4{
             font-size: 14px;
             padding: 7px;
         }
         .main-header__menu-box-top .center{
             font-size: 9px;
         }
         .main-menu__wrapper-inner{
            justify-content: end;
         }
         .english_title{
             display: none !important;
         }
     }

 </style>
 
 <header class="main-header">
            <div class="main-header__wrapper">
                <div class="head_title">
                    <div class="for_logo">
                        <div class="main-header__logo">
                        <a href="home"><img src="assets/images/resources/KrushiLogo.jpg"  alt="" width="" height="" style="border-radius: 100%;"></a>
                    </div>
                    </div>
                    <div class="for_heading">
                        <div class="main-header__menu-box">
                        <div class="main-header__menu-box-top">
                            <ul class="list-unstyled main-header__contact-list">
                               <!--<li> <H4 style="color:#fff;font-family:Georgia, serif;font-size: 1.1rem;">Agricultural Technology Management Agency (ATMA), Maharashtra</H4></li>-->
                               <li><h4> 
                	       कृषि तंत्रज्ञान व्यवस्थापन यंत्रणा ( आत्मा )  
                	    <span class="center">" शेतकरी गट करा बळकट "</span>
                	</h4></li>
                	<br>
                	<li class="english_title"><h4> 
                	       Agricultural Technology Management Agency (ATMA), Maharashtra
                	    <span class="center"></span>
                	</h4></li>
                            </ul>
                            
                        </div>
                        
                    </div>
                    </div>
                    <div class="for_logo">
                        <div class="symbol">
                        <a href="https://www.india.gov.in/" target="_blank"><img src="assets/images/favicons/pngegg.png"  alt="" width="" height=""></a>
                    </div>
                    </div>
                </div>
                <div class="main-header__wrapper-inner">
                    
                    <div class="main-header__phone-contact-box">
                        <!--<div class="main-header__phone-number">-->
                        <!--    <a href="tel:9200886823">+92 (0088) 6823</a>-->
                        <!--</div>-->
                        <!--<div class="main-header__call-box">-->
                        <!--    <div class="main-header__call-inner">-->
                        <!--        <div class="main-header__call-icon">-->
                        <!--            <span class="fas fa-phone"></span>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="main-header__menu-box-bottom">
                            <nav class="main-menu">
                                <div class="main-menu__wrapper">
                                    <div class="main-menu__wrapper-inner">
                                        <div class="main-menu__left">
                                            <div class="main-menu__main-menu-box">
                                                <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                                                <ul class="main-menu__list">
                                                    <li class="dropdown megamenu">
                                                        <a href="home">Home </a>

                                                    </li>
                                                    <li>
                                                        <a href="about">About</a>
                                                    </li>
                                                    <!--<li class="dropdown">-->
                                                    <!--    <a href="#">Schemes</a>-->
                                                    <!--    <ul class="shadow-box">-->
                                                    <!--        <li><a href="services.html">महामिलेट्स आंतरराष्ट्रीय पौष्टिक तृणधान्य वर्ष 2023</a>-->
                                                    <!--        </li>-->
                                                    <!--        <li><a href="services-carousel.html">महामिलेट्स आंतरराष्ट्रीय पौष्टिक तृणधान्य वर्ष 2023</a>-->
                                                    <!--        </li>-->
                                                    <!--        <li><a href="agriculture-products.html">महामिलेट्स आंतरराष्ट्रीय पौष्टिक तृणधान्य वर्ष 2023</a></li>-->
                                                    <!--        <li><a href="organic-products.html">महामिलेट्स आंतरराष्ट्रीय पौष्टिक तृणधान्य वर्ष 2023</a>-->
                                                    <!--        </li>-->
                                                            
                                                    <!--    </ul>-->
                                                    <!--</li>-->
                                                    <!--<li class="dropdown">-->
                                                    <!--    <a href="#">Projects</a>-->
                                                    <!--    <ul class="shadow-box">-->
                                                    <!--        <li><a href="project-01.html">Projects 01</a></li>-->
                                                    <!--        <li><a href="project-02.html">Projects 02</a></li>-->
                                                            
                                                    <!--    </ul>-->
                                                    <!--</li>-->
                                                    
                                                    <!-- <li class="dropdown">
                                                        <a href="#">Pages</a>
                                                        <ul class="shadow-box">
                                                            <li><a href="farmers.html">Farmers</a></li>
                                                            <li><a href="farmers-carousel.html">Farmers Carousel</a>
                                                            </li>
                                                            <li><a href="testimonials.html">Testimonials</a></li>
                                                            <li><a href="testimonials-carousel.html">Testimonial
                                                                    Carousel</a></li>
                                                            <li><a href="faq.html">FAQs</a></li>
                                                            <li><a href="404.html">404 Error</a></li>
                                                        </ul>
                                                    </li> -->
                                                    <li>
                                                        <a href="districts">Blog</a>
                                                      <!--  <ul class="shadow-box">
                                                            <li><a href="blog">Blog</a></li>
                                                            
                                                        </ul>-->
                                                    </li>
                                                    <!-- <li class="dropdown">
                                                        <a href="#">Shop</a>
                                                        <ul class="shadow-box">
                                                            <li><a href="products.html">Products</a></li>
                                                            <li><a href="product-details.html">Product Details</a></li>
                                                            <li><a href="cart.html">Cart</a></li>
                                                            <li><a href="checkout.html">Checkout</a></li>
                                                        </ul>
                                                    </li> -->
                                                    <li>
                                                        <a href="contact">Contact</a>
                                                    </li>
                                                     <li>
                                                        <a href="jobs">Jobs</a>
                                                    </li>
                                                    <li>
                                                        
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="main-menu__right">
                                            <div class="main-menu__search-cart-btn-box">
                                                <div class="main-menu__search-box">
                                                    <a href="#"
                                                      class="main-menu__search search-toggler icon-magnifying-glass"></a>
                                                       
                                                </div>

                                            </div>
                                        </div> 
                                       
                                    </div>
                                </div>
                            </nav>
                        </div>
            </div>
        </header>