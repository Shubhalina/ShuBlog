<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Function.php"); ?>
<?php require_once("includes/Sessions.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!--==================== UNICONS ====================-->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        
        <!--==================== SWIPER CSS ====================-->
        <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
        
        <!--==================== CSS ====================-->
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;900&display=swap" rel="stylesheet">

        <title>DIMSHUBLOG</title>
    </head>

<body>

       <!-- NAVBAR -->
       
          <header class="header" id="header">
            <nav class="nav container">
                <a href="#" class="nav__logo">Marvick</a>
                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list grid">
                        <li class="nav__item">
                            <a href="home_page.php#home" class="nav__link ">
                                <i class="uil uil-estate nav__icon"></i> Home
                            </a>
                        </li>
                        <li class="nav__item">
                            <a href="home_page.php#about" class="nav__link">
                                <i class="uil uil-user nav__icon"></i> About  
                            </a>
                        </li>
                        <li class="nav__item">
                            <a href="home_page.php#skills" class="nav__link">
                                <i class="uil uil-file-alt nav__icon"></i> Skills
                            </a>
                        </li>
                        <li class="nav__item">
                            <a href="home_page.php#services" class="nav__link">
                                <i class="uil uil-briefcase-alt nav__icon"></i> Services
                            </a>
                        </li>
                        <li class="nav__item">
                            <a href="home_page.php#portfolio" class="nav__link">
                                <i class="uil uil-scenery nav__icon"></i> Protfolio
                            </a>
                        </li>
                        <li class="nav__item">
                            <a href="#" class="nav__link active-link">
                                <i class="uil uil-monitor nav__icon"></i> Blogs
                            </a>
                        </li>
                        <li class="nav__item">
                            <a href="home_page.php#contact" class="nav__link">
                                <i class="uil uil-message nav__icon"></i> Contact us
                            </a>
                        </li>
                    </ul>
                    <i class="uil uil-times nav__close" id="nav-close"></i>
                </div>
                <div class="nav__btns">
                    <!-- Theme Change button -->
                    <i class="uil uil-moon change-theme" id="theme-button"></i>

                    <div class="nav__toggle" id="nav-toggle">
                        <i class="uil uil-apps"></i>
                    </div>
                </div>
            </nav>
          </header>
        
        <!-- Blog section -->
        <main class="main">
          <section class="Blogs section">
            <div class="blog__container container " >
              <div class="blog__content">
                <div class="blog__data">
                  <h1 class="blog__title">Welcome to My Blogging page</h1>
                  <h3 class="blog__subtitle">Where I keep my journal safe</h3>
                </div>
              </div>
              <hr class="hr_1">
            </div>
            
            <div class="b__container p_container ">
                <?php 
                $sql = "SELECT *  FROM posts ORDER BY id desc";
                $stmt = $ConnectingDB->query($sql);

                while($DataRows = $stmt->fetch()){
                $PostId = $DataRows["id"];
                $DateTime = $DataRows["datetime"];
                $PostTitle = $DataRows["title"];
                $Category = $DataRows["category"];
                $Admin = $DataRows["author"];
                $Image = $DataRows["image"];
                $PostDescription = $DataRows["post"];
                ?>
                
                    <div class="protfolio__content">
                        
                        <div>
                            <img src="Uploads/<?php echo htmlentities($Image); ?>" alt="logos"  class="protfolio_img">
                        </div>
                        <div>
                            <h3 class="b__title"><?php echo htmlentities($PostTitle); ?></h3>
                            <h4 class="b__category">>written by <?php echo htmlentities($Admin); ?> </h4>
                            <p class="b-desc"><?php if (strlen($PostDescription)>50){$PostDescription=substr($PostDescription,0,50).'...';} echo htmlentities($PostDescription); ?></p>
                            <a href="FullPost_1.php?id=<?php echo $PostId?>" style="float:right;">
                            <span class="btn btn-outline-info">Read More >></span>
                            </a>
                        </div>
                    </div>
                    
                    <?php } ?>
            </div>



          </section>

        </main>
        





          <footer class="footer">
              <div class="footer__bg">
                  <div class="footer__container container grid">
                      <div>
                          <h1 class="footer__title">Marvick</h1>
                          <span class="footer__subtitle">Graphic designer</span>
                      </div>
                      <ul class="footer__links">
                          <li>
                              <a href="#services" class="footer__link">Services</a>
                          </li>
                          <li>
                              <a href="#protfolio" class="footer__link">Protfolio</a>
                          </li>
                          <li>
                              <a href="#contact" class="footer__link">Contactme</a>
                          </li>
                      </ul>
                  </div>
                  <p class="footer__copy"> All right reserved</p>
              </div>
        
          </footer>
          
        
          <!-- footer end -->
        
        
        
        
      <!--==================== SWIPER JS ====================-->
<script src="assets/js/swiper-bundle.min.js"></script>

<!--==================== MAIN JS ====================-->
<script src="assets/js/main.js"></script>
</body>

</html>
