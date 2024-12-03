<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Function.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php 
    if(isset($_SESSION["UserId"])){
        Redirect_to("Dashboard.php");
      }
    if (isset($_POST["Submit"])) {
        $UserName = $_POST["Username"];
        $Password = $_POST["Password"];
        if(empty($UserName)||empty($Password)){
            $_SESSION["ErrorMessage"]="Please enter all the fields";
            Redirect_to("Login.php");
        }else{
            $Login_Attempt=Login_Attempt($UserName,$Password);
            if($Login_Attempt){
                $_SESSION["UserId"]=$Login_Attempt["id"];
                $_SESSION["UserName"]=$Login_Attempt["username"];
                $_SESSION["AdminName"]=$Login_Attempt["aname"];

                $_SESSION["SuccessMessage"]="Welcome ".$_SESSION["UserName"];
                if (isset($_SESSION["TrackingURL"])) {
                    Redirect_to($_SESSION["TrackingURL"]);
                  }else{
                  Redirect_to("Dashboard.php");
                }
                
            }else{
                $_SESSION["ErrorMessage"]="Account does not exist";
                Redirect_to("Login.php");
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
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    </head>

    <body>

       <!-- NAVBAR -->
       
       <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
          <h5 class="text-white h4">Collapsed content</h5>
          <span class="text-muted">Toggleable via the navbar brand.</span>
        </div>
      </div>
       <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="index.html" class="navbar-brand"></a>
                <div style="font-weight: bold;">DIMSHUBLOG</div>
                
                
                
                <!-- list -->
                <div class="collapse navbar-collapse" id="navbarcollapseMD">
               
        </div>
        </div>
       </nav>
        <!-- navbar end -->
        
        <!-- header -->
        
        <header>
            <div class="container">
            
                <div class="row">
                    <div class=col-md-12>
                    
                        
                    </div>

                </div>
            </div>
            
        </header>

        <!-- header end -->
        <!-- main area -->
        <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
        
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
        <div class="card rounded-3 text-black">
        <div class="row g-0">
            <div class="col-lg-6">
            <?php
                echo ErrorMessage();
                echo SuccessMessage();
                ?>
                <!-- <div class="card bg-dark text-light">
                    <div class="card-header">
                        <h2>Login:</h2>
                    </div> -->
                <div class="card-body p-md-5 mx-md-4">
                 <div class="text-center">
                  <img src="images/logo.jpg" style="width: 165px; border-radius:50%;" alt="logo">
                  <h4 class=" mb-4 pb-1">Login to your account</h4>
                     </div>
                        <form action="login.php" method="post">
                            <div class="form-outline mb-3">
                                <input class="form-control" type="text" name="Username" id="username" placeholder="Username">
                                
                            </div>
                            <div class="form-outline mb-3">
                                <input class="form-control" type="password" name="Password" id="password" placeholder="Password">
                            </div>
                           
                            
                            <div class="form-outline mb-2">
                                <input class="btn btn-primary btn-own" type="submit" name="Submit" id="submit" placeholder="Password" value="Login">
                            </div>
                           
</form>
                    </div>
                    
                </div>
                
                
                <div class="col-lg-6 d-flex align-items-center bg-dark">
                    
              <div class="text-white px-3 py-4 p-md-5 mx-md-4  ">
                <h4 class="mb-4">MCA 2nd semester, 2024</h4>
                <p class="small mb-0">This Project is based on Blog posting media.</p>
              
            </div>
              </div>
            </div>
            </div>
             
        </div> <!--rowend -->
 </div>
</div>
</div>
</div>
</div>

        </section>


        <!-- footer -->
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
              <div class="col-md-4 d-flex align-items-center">
                <span class="text-muted">© DIMSHUBLOG, 2024</span>
              </div>
          
            </footer>
          </div>
        
          <!-- footer end -->
        
        
       <script src="https://kit.fontawesome.com/656d645cb5.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

</html>
