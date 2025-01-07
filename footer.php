   <style>
       .website-counter {
  background-color: #ff4957;
  height: 50px;
  width: 80px;
  color: white;
  border-radius: 30px;
  font-weight: 700;
  font-size: 25px;
  margin-top: 10px;
}
.website-counter {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
   </style>
   
   
   <footer class="site-footer">
            <div class="site-footer__top">
                <div class="container">
                    <div class="site-footer__top-inner">
                        <div class="site-footer-shape-1 float-bob-x"
                            style="background-image: url(assets/images/shapes/site-footer-shape-1.png);"></div>
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                                <div class="footer-widget__column footer-widget__about">
                                    <div class="footer-widget__logo">
                                         <div class="main-header__logo">
                        <a href="index.html"><img src="assets/images/resources/KrushiLogo.jpg"  alt="" width="130px" height="130px"></a>
                    </div>
                                    </div>
                                    <div class="footer-widget__about-text-box">
                                        <p class="footer-widget__about-text">Welcome to Atmamaharashtra. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                                <div class="footer-widget__column footer-widget__Explore">
                                    <div class="footer-widget__title-box">
                                        <h3 class="footer-widget__title">Explore</h3>
                                    </div>
                                    <ul class="footer-widget__Explore-list list-unstyled">
                                       <div>Website visit count:</div>
    <div class="website-counter"></div>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                                <div class="footer-widget__column footer-widget__news">
                                    <div class="footer-widget__title-box">
                                        <h3 class="footer-widget__title">Blog</h3>
                                    </div>
                                    <?php
                                    
                                    require_once "conn.php";
                                     $stmt_question_list = $conn->prepare("SELECT blog_id,blog_title,blog_title_image,added_on FROM blog WHERE blog_status=1 ORDER BY added_on DESC LIMIT 0,2");
                                    $stmt_question_list->execute();
                                    $row_question_list = $stmt_question_list->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($row_question_list AS $r)
                                    {
                                        ?>
                                    <ul class="footer-widget__news-list list-unstyled" onclick="startfootersession('blog_id',<?php echo $r['blog_id'];?>)">
                                        
                                        <li>
                                            <div class="footer-widget__news-img">
                                                <img src="uploaded_images/blog_title_images/<?php echo $r['blog_title_image'];?>" alt="">
                                            </div>
                                            <div class="footer-widget__news-content">
                                                <p class="footer-widget__news-date"><?php echo date('d M,Y',strtotime($r['added_on']));?></p>
                                                <h5 class="footer-widget__news-sub-title"><a href="#"><?php echo $r['blog_title'];?></a></h5>
                                            </div>
                                        </li>
                                    </ul>
                                    <?php
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                            <script>
                                    function startfootersession(name,value)
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
                            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                                <div class="footer-widget__column footer-widget__Contact">
                                    <div class="footer-widget__title-box">
                                        <h3 class="footer-widget__title">Contact</h3>
                                    </div>
                                    <ul class="footer-widget__Contact-list list-unstyled">
                                        <!--<li>
                                            <div class="icon">
                                                <span class="fas fa-phone-square-alt"></span>
                                            </div>
                                            <div class="text">
                                                <p><a href="tel:9100000000">+91 (0000) 0000</a></p>
                                            </div>
                                        </li>-->
                                        <li>
                                            <div class="icon">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                            <div class="text">
                                                <p><a href="mailto:info@atmamaharashtra.com">info@atmamaharashtra.com</a></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-pin"></span>
                                            </div>
                                            <div class="text">
                                                <p>ATMA</p>
                                            </div>
                                        </li>
                                    </ul>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-footer__bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="site-footer__bottom-inner">
                                <p class="site-footer__bottom-text">© Copyright 2023 by <a href="#">Atmamaharashtra</a></p>
                                 <div class="site-footer__bottom-scroll">
                                    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i
                                            class="icon-up-arrow"></i></a>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var counterContainer = document.querySelector(".website-counter");
var resetButton = document.querySelector("#reset");
var visitCount = localStorage.getItem("page_view");

// Check if page_view entry is present
if (visitCount) {
  visitCount = Number(visitCount) + 1;
  localStorage.setItem("page_view", visitCount);
} else {
  visitCount = 1;
  localStorage.setItem("page_view", 1);
}
counterContainer.innerHTML = visitCount;

// Adding onClick event listener
resetButton.addEventListener("click", () => {
  visitCount = 1;
  localStorage.setItem("page_view", 1);
  counterContainer.innerHTML = visitCount;
});
            </script>
        </footer>