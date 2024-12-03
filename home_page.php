<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Function.php"); ?>
<?php require_once("includes/Sessions.php"); ?>

<?php
    

    // contact section

    if(isset($_POST["Submit"])){
    $Name = $_POST["contactName"];
    $Email = $_POST["contactEmail"];
    $message = $_POST["message"];
    $contactProject = $_POST["contactProject"];
    
    date_default_timezone_set("Asia/Calcutta");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

    if(empty($Name)||empty($Email)||empty($message)){
        $_SESSION["ErrorMessage"]= "Connot be empty";
        Redirect_to("home_page.php#contact");
    }

    elseif(strlen($Name)<3){
        $_SESSION["ErrorMessage"]= "Name should be greater than 2 characters";
        Redirect_to("home_page.php#contact");
    }

    elseif(strlen($Name)>49){
        $_SESSION["ErrorMessage"]= "Name should be less than 50 characters";
        Redirect_to("home_page.php#contact");
    }
    elseif(strlen($Email)<3){
        $_SESSION["ErrorMessage"]= "Email should be greater than 2 characters";
        Redirect_to("home_page.php#contact");
    }

    elseif(strlen($Email)>59){
        $_SESSION["ErrorMessage"]= "Email should be less than 60 characters";
        Redirect_to("home_page.php#contact");
    }
    elseif(strlen($message)<3){
        $_SESSION["ErrorMessage"]= "Email should be greater than 2 characters";
        Redirect_to("home_page.php#contact");
    }

    elseif(strlen($message)>499){
        $_SESSION["ErrorMessage"]= "Email should be less than 500 characters";
        Redirect_to("home_page.php#contact");
    }
    else{
        //query
        $sql = "INSERT INTO contact(name,email,project,message,datetime)";
        $sql .= "VALUES(:name,:email,:project,:message,:datetime)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt-> bindValue(':datetime', $DateTime);
        $stmt-> bindValue(':name', $Name);
        $stmt-> bindValue(':email', $Email);
        $stmt-> bindValue(':project', $contactProject);
        $stmt-> bindValue(':message', $message);
        
        $Execute=$stmt->execute();


        if($Execute){
            $_SESSION["SuccessMessage"]="message with Added Successfully";
            Redirect_to("home_page.php#contact");
        }
        else{
            $_SESSION["ErrorMessage"]="Something went wrong !";
            Redirect_to("home_page.php#contact");
        }
    }
}
?>

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
        <!--==================== HEADER ====================-->
        <header class="header" id="header">
            <nav class="nav container">
                <a href="#" class="nav__logo">DIMSHUBLOG</a>
                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list grid">
                        <li class="nav__item">
                            <a href="#home" class="nav__link active-link">
                                <i class="uil uil-estate nav__icon"></i> Home
                            </a>
                        </li>
                        <li class="nav__item">
                            <a href="#about" class="nav__link">
                                <i class="uil uil-user nav__icon"></i> About  
                            </a>
                        </li>
                       
                        <li class="nav__item">
                            <a href="#services" class="nav__link">
                                <i class="uil uil-briefcase-alt nav__icon"></i> Services
                            </a>
                        </li>
                        <li class="nav__item">
                            <a href="#portfolio" class="nav__link">
                                <i class="uil uil-scenery nav__icon"></i> Portfolio
                            </a>
                        </li>
                        <li class="nav__item">
                            <a href="Blogs.php" class="nav__link">
                                <i class="uil uil-monitor nav__icon"></i> Blogs
                            </a>
                        </li>
                        <li class="nav__item">
                            <a href="#contact" class="nav__link">
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

        <!--==================== MAIN ====================-->
        <main class="main">
            <!--==================== HOME ====================-->
            <section class="home section" id="home">
                <div class="home__container container grid" >
                    <div class="home__content grid">
                        <div class="home__social">
                            <a href="https://www.instagram.com/s_hubhalina_?igsh=MWIwdm41MjdwbTNqNw%3D%3D&utm_source=qr" target="_blank" class="home__social-icon">
                                <i class="uil uil-instagram"></i>
                            </a>
                        </div>
                        <div class="home__img" style="width: 75%; height:auto;"">
                            <!-- <svg class="home__blob" viewBox="0 0 200 187" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <mask id="mask0" mask-type="alpha">
                                    <path d="M190.312 36.4879C206.582 62.1187 201.309 102.826 182.328 134.186C163.346 165.547 
                                    130.807 187.559 100.226 186.353C69.6454 185.297 41.0228 161.023 21.7403 129.362C2.45775 
                                    97.8511 -7.48481 59.1033 6.67581 34.5279C20.9871 10.1032 59.7028 -0.149132 97.9666 
                                    0.00163737C136.23 0.303176 174.193 10.857 190.312 36.4879Z"/>
                                </mask>
                                <g mask="url(#mask0)">
                                    <path d="M190.312 36.4879C206.582 62.1187 201.309 102.826 182.328 134.186C163.346 
                                    165.547 130.807 187.559 100.226 186.353C69.6454 185.297 41.0228 161.023 21.7403 
                                    129.362C2.45775 97.8511 -7.48481 59.1033 6.67581 34.5279C20.9871 10.1032 59.7028 
                                    -0.149132 97.9666 0.00163737C136.23 0.303176 174.193 10.857 190.312 36.4879Z"/>
                                    <image class="home__blob-img" x='8' y='18' xlink:href="assets/img/home.png"/>
                                </g>
                            </svg> -->
                          <img src="images/logo.jpg" alt="home-image" style="border-radius: 50%; box-shadow: 0 4px 6px rgba(0, 0, 0, .5);">
                        </div>
                        <div class="home__data">
                            <h1 class="home__title">Hi, Welcome to DIMSHUBLOG</h1>
                            <h3 class="home__subtitle">Where all your digital needs are fulfilled</h3>
                            <p class="home__description">Producing quality work, High level experience in Graphic design.</p>
                            <a href="#contact" class="button button--flex">
                                Contact Now &#160 <i class="uil uil-message"></i>
                            </a>
                        </div>
                    </div>
                    <div class="home__scroll">
                        <a href="#about" class="home__scroll-button button--flex">
                            <i class="uil uil-mouse-alt home__scroll-mouse"></i>
                            <span class="home__scroll-name">Scroll down</span>
                            <i class="uil uil-arrow-down home__scroll-arrow"></i>
                        </a>
                    </div>
                </div>
            </section>

            <!--==================== ABOUT ====================-->
            <section class="about section" id="about">
                <h2 class="section__title">About Us</h2>
                <span class="section__subtitle">My Introduction</span>

                <div class="about__container container grid">
                    <img src="uploads/dimshu_ps/social-media-1989152_1280.jpg" alt="" class="about__img">
                    <div class="about__data">
                        <p class="about__description">
                            Graphic designer, with extensive knowledge of Computers and digital media
                            with years of experience, working in design and Computer science.
                        </p>
                        <div class="about__info">
                            <div>
                                <span class="about__info-title">02+</span>
                                <span class="about__info-name">Years <br> experience</span>
                            </div>
                            <div>
                                <span class="about__info-title">10+</span>
                                <span class="about__info-name">Completed <br> project</span>
                            </div>
                            <div>
                                <span class="about__info-title">03+</span>
                                <span class="about__info-name">Companies <br> worked</span>
                            </div>
                        </div>

                        <div class="about__button">
                            <a download="" href="assets/pdf/Marvick_CV.pdf" class="button button--flex">
                                Download CV<i class="uil uil-download-alt button__icon">

                                </i>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

         

            <!--==================== SERVICES ====================-->
            <section class="services section" id="services">
                <h2 class="section__title">Services</h2>
                <span class="section__subtitle">What you can expect from me</span>
                
                <div class="services__container container grid">
                    <!-- services 1 -->
                    <div class="services__content">
                        <div>
                            <i class="uil uil-megaphone services__icon"></i>
                            <h3 class="services__title">Marketing & Advertising <br> designer</h3>
                        </div>

                        <span class="button button--flex button--small button--link services__button">
                            View More
                            <i class="uil uil-arrow-right button__icon"></i>
                        </span> 

                        <div class="services__modal">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Marketing & Advertising <br> designer</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <li class="services__modal-service">
                                        <i class="uil uil-check-circle services__modal-icon"></i>
                                        <p>Postcards and flyers</p>
                                    </li>
                                    <li class="services__modal-service">
                                        <i class="uil uil-check-circle services__modal-icon"></i>
                                        <p>Magazine and newspaper ads</p>
                                    </li>
                                    <li class="services__modal-service">
                                        <i class="uil uil-check-circle services__modal-icon"></i>
                                        <p>Posters, banners and billboards</p>
                                    </li>
                                    <li class="services__modal-service">
                                        <i class="uil uil-check-circle services__modal-icon"></i>
                                        <p>Infographics</p>
                                    </li>
                                    <li class="services__modal-service">
                                        <i class="uil uil-check-circle services__modal-icon"></i>
                                        <p>Brochures (print and digital)</p>
                                    </li>
                                    <li class="services__modal-service">
                                        <i class="uil uil-check-circle services__modal-icon"></i>
                                        <p>Social media ads, banners and graphics</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- services 2 -->
                    <div class="services__content">
                        <div>
                            <i class="uil uil-megaphone services__icon"></i>
                            <h3 class="services__title">Publication & Packaging <br> designer</h3>
                        </div>

                        <span class="button button--flex button--small button--link services__button">
                            View More
                            <i class="uil uil-arrow-right button__icon"></i>
                        </span> 

                        <div class="services__modal">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Publication & Packaging <br> designer</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <li class="services__modal-service">
                                        <i class="uil uil-check-circle services__modal-icon"></i>
                                        <p>Book covers</p>
                                    </li>
                                    <li class="services__modal-service">
                                        <i class="uil uil-check-circle services__modal-icon"></i>
                                        <p>Magazines, Catalogs, Newsletters</p>
                                    </li>
                                    
                                    <li class="services__modal-service">
                                        <i class="uil uil-check-circle services__modal-icon"></i>
                                        <p>Product Packaging design</p>
                                    </li>
                                    <li class="services__modal-service">
                                        <i class="uil uil-check-circle services__modal-icon"></i>
                                        <p>Mockup design</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- services 3 -->
                    <div class="services__content">
                        <div>
                            <i class="uil uil-megaphone services__icon"></i>
                            <h3 class="services__title">Web development</h3>
                        </div>

                        <span class="button button--flex button--small button--link services__button">
                            View More
                            <i class="uil uil-arrow-right button__icon"></i>
                        </span> 

                        <div class="services__modal">
                            <div class="services__modal-content">
                                <h4 class="services__modal-title">Web development</h4>
                                <i class="uil uil-times services__modal-close"></i>

                                <ul class="services__modal-services grid">
                                    <li class="services__modal-service">
                                        <i class="uil uil-check-circle services__modal-icon"></i>
                                        <p>I will wireframe design your website</p>
                                    </li>
                                    <li class="services__modal-service">
                                        <i class="uil uil-check-circle services__modal-icon"></i>
                                        <p>I will develop Frontend of the website</p>
                                    </li>
                                    <li class="services__modal-service">
                                        <i class="uil uil-check-circle services__modal-icon"></i>
                                        <p>I will develop Backend of the website</p>
                                    </li>
                                    <li class="services__modal-service">
                                        <i class="uil uil-check-circle services__modal-icon"></i>
                                        <p>I can also provide Wordpress websites</p>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    
  
                </div>
            
            </section>
            <!--==================== PORTFOLIO ====================-->
            <section class="portfolio section" id="portfolio">
                <h2 class="section__title">Featured Work</h2>
                <span class="section__subtitle">Some of my work has been featured below.</span>
            
                <div class="protfolio__container container ">
                    <div class="protfolio__content">
                        
                        <div>
                            <img src="uploads/Marvick_ps/art/ILLUSTRATION2.jpg" alt="logos"  class="protfolio_img">
                        </div>
                        <div>
                            <h3 class="protfolio__title">BIOTECH</h3>
                            <h4 class="protfolio__category">Logos, Monogram</h4>
                        </div>
                    </div>
                    <div class="protfolio__content">
                        <div>
                            <img src="uploads/Marvick_ps/logos/MARVICK GAMING.jpg" alt="logos"  class="protfolio_img">
                        </div>
                        <div>
                            <h3 class="protfolio__title">SHUBH GAMING</h3>
                            <h4 class="protfolio__category">Logos, GAMING</h4>
                        </div>
                    </div>
                    <div class="protfolio__content">
                        <div>
                            <img src="uploads/Marvick_ps/flyer-and-broucher/flyer 17-58.JPG" alt="logos"  class="protfolio_img">
                        </div>
                        <div>
                            <h3 class="protfolio__title">BIOTECH</h3>
                            <h4 class="protfolio__category">Logos, Monogram</h4>
                        </div>
                    </div>
                    <div class="protfolio__content">
                        <div>
                            <img src="uploads/Marvick_ps/flyer-and-broucher/KNR/cover.jpg" alt="logos"  class="protfolio_img">
                        </div>
                        <div>
                            <h3 class="protfolio__title">BIOTECH</h3>
                            <h4 class="protfolio__category">Logos, Monogram</h4>
                        </div>
                    </div>
                    <div class="protfolio__content">
                        <div>
                            <img src="uploads/Marvick_ps/logos/B4.jpg" alt="logos"  class="protfolio_img">
                        </div>
                        <div>
                            <h3 class="protfolio__title">BIOTECH</h3>
                            <h4 class="protfolio__category">Logos, Monogram</h4>
                        </div>
                    </div>
                    <div class="protfolio__content">
                        <div>
                            <img src="uploads/Marvick_ps/banner-etc/calvin jun.png" alt="logos"  class="protfolio_img">
                        </div>
                        <div>
                            <h3 class="protfolio__title">BIOTECH</h3>
                            <h4 class="protfolio__category">Logos, Monogram</h4>
                        </div>
                    </div>
                    
                </div>
                
                
                
            </section>
            <!--==================== PROJECT IN MIND ====================-->
            <section class="project section">
                <div class="project__bg">
                    <div class="project__container container grid">
                        <div class="project__data">
                            <h2 class="project__title">You have a new project</h2>
                            <p class="project__desc">Contact me now and get a 30% off on your first project</p>
                            <a href="#contact" class="button button--flex button--white">
                                Contact Me 
                                <i class="uil uil-message project__icon button__icon"></i>
                            </a>
                        </div>
                        <div>
                            <img src="assets/img/project.png" alt="" class="project__img">
                        </div>
                        
                    </div>
                </div>
            </section>

            <!--==================== CONTACT ME ====================-->
            <section class="contact section" id="contact">
                <h2 class="section__title">Contact Us</h2>
                <span class="section__subtitle">Get in touch</span>

                <div class="contact__container container grid">
                    <div>
                        <div class="contact__information">
                            <i class="uil uil-phone contact__icon"></i>

                            <div>
                                <h3 class="contact__title">Call Us</h3>
                                <span class="contact__subtitle">+91 789-672-5867</span>
                                
                            </div>
                        </div>

                        <div class="contact__information">
                            <i class="uil uil-envelope contact__icon"></i>

                            <div>
                                <h3 class="contact__title">Email</h3>
                                <span class="contact__subtitle">shubhalinaradukakaty@gmail.com</span>
                             
                            </div>
                        </div>
                        <div class="contact__information">
                            <i class="uil uil-map-marker contact__icon"></i>

                            <div>
                                <h3 class="contact__title">Location</h3>
                                <span class="contact__subtitle">785001, JORHAT, Assam - India</span>
                            </div>
                        </div>
                    </div> 
                    <div>
                        <form action="home_page.php" class="contact__form grid" method="post">
                            <div class="contact__inputs grid">
                                <div class="contact__content">
                                    <label for="" class="contact__label">Name</label>
                                    <input type="text" name="contactName" class="contact__input">
                                </div>
                                <div class="contact__content">
                                    <label for="" class="contact__label">Email</label>
                                    <input type="email" name="contactEmail" class="contact__input">
                                </div>
                            </div>
                            <div class="contact__content">
                                <label for="" class="contact__label">Project</label>
                                <input type="text" name="contactProject" class="contact__input">
                            </div>
                            <div class="contact__content">
                                <label for="" class="contact__label">Message</label>
                                <textarea name="message" id="" cols="0" rows="7" class="contact__input"></textarea>
                            </div>
                            <div>
                                <button type="submit" name="Submit" class="button_submit button--flex">
                                    Send Message &#160
                                    <i class="uil uil-message button-icon"></i>
                                </button>
                            
                        </form>
                    </div>   
                    </div>
                </div>
            </section>
            

            

            <!--==================== TESTIMONIAL ====================-->
            <!-- <section class="testimonial section">
                
            </section> -->

            
        </main>

        <!--==================== FOOTER ====================-->
        <footer class="footer">
            <div class="footer__bg">
                <div class="footer__container container grid">
                    <div>
                        <h1 class="footer__title">DIMSHUBLOG</h1>
                        <span class="footer__subtitle">Graphic designer</span>
                    </div>
                    <ul class="footer__links">
                        <li>
                            <a href="#services" class="footer__link">Services</a>
                        </li>
                        <li>
                            <a href="#portfolio" class="footer__link">Portfolio</a>
                        </li>
                        <li>
                            <a href="#contact" class="footer__link">Contactme</a>
                        </li>
                    </ul>
    
    
                    <div class="footer__socials">
                        <a href="https://www.instagram.com/s_hubhalina_?igsh=MWIwdm41MjdwbTNqNw%3D%3D&utm_source=qr" target="_blank" class="footer__social">
                            <i class="uil uil-instagram"></i>
                        </a>
                    </div>
                </div>
                <p class="footer__copy">&#169; DIMSHUBLOG. All right reserved</p>
            </div>
        
        </footer>
        
        <!--==================== SCROLL TOP ====================-->
        <a href="#" class="scrollup" id="scroll-up">
            <i class="uil uil-arrow-up scrollup__icon"></i>
        </a>

        <!--==================== SWIPER JS ====================-->
        <script src="assets/js/swiper-bundle.min.js"></script>

        <!--==================== MAIN JS ====================-->
        <script src="assets/js/main.js"></script>
    </body>
</html>