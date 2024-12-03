<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Function.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php 
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];

Confirm_Login();
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard</title>
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
        <a href="#" class="navbar-brand">
                <img src="images/logo.jpg" alt="" width="45" height="45" class="d-inline-block align-middle"> DIMSHUBLOG</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarcollapseMD" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                
                <!-- list -->
                <div class="collapse navbar-collapse" id="navbarcollapseMD">
                <ul class="navbar-nav mr-auto">
                
                <li class="nav-item">
                    <a href="Dashboard.php" class="nav-link link-light">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="Posts.php" class="nav-link link-light">Posts</a>
                </li>
                <li class="nav-item">
                    <a href="Categories.php" class="nav-link link-light">Categories</a>
                </li>
                <li class="nav-item">
                    <a href="Admins.php" class="nav-link link-light">Manage Admins</a>
                </li>
                <li class="nav-item">
                    <a href="Comments.php" class="nav-link link-light">Comments</a>
                </li>
               
                <li class="nav-item">
                    <a href="users.php" class="nav-link link-light">Manage Users</a>
                </li>
               
               
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="LogOut.php" class="nav-link link-light"><i class="fas fa-sign-out-alt text-danger"></i> Log Out</a>
                </li>

            </ul>
        </div>
        </div>
       </nav>
        <!-- navbar end -->
        
        <!-- header -->
        
        <header class="bg-dark text-light py-3">
            <div class="container">
                <div class="row">
                    <div class=col-md-12>
                        <h1><i class="fas fa-cog"></i> Dashboard</h1>
                    </div>
                    <div class="col-lg-3 mb-2">
                        <a href="AddNewPost.php" class="btn btn-primary btn-own btn-block"><i class="fas fa-edit"></i> Add New Post</a>
                    </div>
                    <div class="col-lg-3 mb-2">
                        <a href="Categories.php" class="btn btn-own btn-outline-primary"><i class="fas fa-folder-plus"></i> Add New Category</a>
                    </div>
                    <div class="col-lg-3 mb-2">
                        <a href="Admins.php" class="btn btn-own btn-outline-info"><i class="fas fa-user-plus"></i> Add New Admin</a>
                    </div>
                    <div class="col-lg-3 mb-2">
                        <a href="Comments.php" class="btn btn-own btn-outline-success"><i class="fas fa-check"></i> Approve Comments</a>
                    </div>
                    <div class="col-lg-3 mb-2">
                        <a href="users.php" class="btn btn-own btn-outline-success"><i class="fas fa-check"></i> Manage Users</a>
                    </div>
                    
                   
                    
                </div>
            </div>
            
        </header>

        <!-- header end -->

        <!-- main area -->
        <section class="container py-2 mb-4">
            <div class="row">
                <div class="col-lg-2">
                   <div class="card text-center bg-dark text-white mb-3">
                       <div class="card-body">
                           <H1 class="lead">Posts</H1>
                           <h4 class="display-6"><i class="fab fa-readme"></i>
                           <?php TotalPost(); ?>
                        </h4>
                       </div>
                   </div> 
                   <div class="card text-center bg-dark text-white mb-3">
                       <div class="card-body">
                           <H1 class="lead">Categories</H1>
                           <h4 class="display-6"><i class="fas fa-folder"></i>
                           <?php TotalCategories(); ?>
                        </h4>
                       </div>
                   </div> 
                   <div class="card text-center bg-dark text-white mb-3">
                       <div class="card-body">
                           <H1 class="lead">Admins</H1>
                           <h4 class="display-6"><i class="fas fa-users"></i>
                           <?php TotalAdmins(); ?>
                        </h4>
                       </div>
                   </div> 
                   <div class="card text-center bg-dark text-white mb-3">
                       <div class="card-body">
                           <H1 class="lead">Comments</H1>
                           <h4 class="display-6"><i class="fas fa-comments"></i>
                           <?php TotalComments(); ?>
                        </h4>
                       </div>
                   </div> 
                   
                </div>
                <!-- right side -->
                <div class="col-lg-10">
                
                    <?php echo ErrorMessage();
                echo SuccessMessage();
                ?>
                <h1>Top Posts</h1>
                <table class="table table-hover">
                <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Banner</th>
                    <th>Title</th>
                    
                    <th>Date&Time</th>
                    <th>Author</th>
                    <th>Comments</th>
                    <th>Preview</th>
                </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
                $stmt = $ConnectingDB->query($sql);
                $Sr=0;
                while($DataRows = $stmt->fetch()){
                    $Id = $DataRows["id"];
                    $Image = $DataRows["image"];
                    $DateTime = $DataRows["datetime"];
                    $PostTitle = $DataRows["title"];
                    
                    $Admin = $DataRows["author"];
                    
                    $PostDescription = $DataRows["post"];
                    $Sr++;
                    ?>
                
                
                <tr>
                    <td><?php echo $Sr; ?></td>
                    <td><img src="Uploads/<?php echo $Image; ?>"  height="72px" style="width=100%;"></td>
                    <td>
                    <?php if (strlen($PostTitle)>15){$PostTitle=substr($PostTitle,0,15).'...';}
                     echo $PostTitle; ?></td>
                    
                    <td><?php echo $DateTime; ?></td>
                    <td><?php if (strlen($Admin)>10){$Admin=substr($PostTitle,0,10).'...';} echo $Admin; ?></td>
                    
                    <td><?php 
                    $Total=ApproveCommentsAccordingtoPost($Id);
                    if($Total>0){
                        ?>
                    <span class="badge alert-success">
                    <?php    
                    echo $Total;
                     ?></span>
                     <?php } ?>
                     <?php $Total = DisApproveCommentsAccordingtoPost($Id);
                    if ($Total>0) {  ?>
                    <span class="badge alert-danger">
                      <?php
                      echo $Total; ?>
                    </span>
                         <?php  }  ?>
                    
                    
                    </td>
                    
                    <td><a href="FullPost_1.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-outline-primary">Live Preview</span></a></td>
                    
                </tr>
                    <?php } ?>
                </table>
                </div>
            </div>
        </section>


        <!-- main area end -->

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
