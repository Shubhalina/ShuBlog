<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Function.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php 
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login();?>
<?php
if(isset($_POST["Submit"])){
    $UserName        = $_POST["Username"];
    $Name            = $_POST["Name"];
    $Password        = $_POST["Password"];
     $ConfirmPassword = $_POST["ConfirmPassword"];
     $Admin           = $_SESSION["UserName"];
    date_default_timezone_set("Asia/Calcutta");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

    if(empty($UserName)||empty($Password)||empty($ConfirmPassword)){
        $_SESSION["ErrorMessage"]= "All fields must be filled out";
        Redirect_to("Admins.php");
      }elseif (strlen($Password)<4) {
        $_SESSION["ErrorMessage"]= "Password should be greater than 3 characters";
        Redirect_to("Admins.php");
      }elseif ($Password !== $ConfirmPassword) {
        $_SESSION["ErrorMessage"]= "Password and Confirm Password should match";
        Redirect_to("Admins.php");
      }elseif (CheckUserNameExistsOrNot($UserName)) {
        $_SESSION["ErrorMessage"]= "Username Exists. Try Another One! ";
        Redirect_to("Admins.php");
      }else{
        // Query to insert new admin in DB When everything is fine
        global $ConnectingDB;
        $sql = "INSERT INTO admins(datetime,username,password,aname,addedby)";
        $sql .= "VALUES(:dateTime,:userName,:password,:aName,:adminName)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':dateTime',$DateTime);
        $stmt->bindValue(':userName',$UserName);
        $stmt->bindValue(':password',$Password);
        $stmt->bindValue(':aName',$Name);
        $stmt->bindValue(':adminName',$Admin);
        $Execute=$stmt->execute();
        if($Execute){
          $_SESSION["SuccessMessage"]="New Admin with the name of ".$Name." added Successfully";
          Redirect_to("Admins.php");
        }else {
          $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
          Redirect_to("admins.php");
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
        <title>Admins</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        
        <header class= "bg-dark text-light py-3">
            <div class="container">
                <div class="row">
                    <div class=col-md-12>
                        <h1><i class="fas fa-users" style="color: #dadada;"></i> Manage Admins</h1>
                    </div>

                </div>
            </div>
            
        </header>

        <!-- header end -->

        <!-- main area -->
        
        <section class="container py-2 mb-4" style="min-height: 400px;">
            <div class="row">
                <div class="offset-lg-1 col-lg-10">
                <?php 
                echo ErrorMessage();
                echo SuccessMessage();
                ?>
                <form class="" action="Admins.php" method="post" >
                        <div class="card bg-secondary text-light mb-3">
                            <div class="card-header">
                                <h1>Add New Admin</h1>
                            </div>
                            <div class="card-body bg-dark">
                                <div class= "form-group mt-2">
                                    <label for="username"><span class="FieldInfo">Username: </span></label>
                                    <input class="form-control" type="text" name="Username" id="username" placeholder="Type title here" value="">
                                </div>
                                <div class= "form-group  mt-2">
                                    <label for="Name"><span class="FieldInfo">Name: </span></label>
                                    <input class="form-control" type="text" name="Name" id="Name" placeholder="Type title here" value="">
                                </div>
                                <div class= "form-group  mt-2">
                                    <label for="Password"><span class="FieldInfo">Password: </span></label>
                                    <input class="form-control" type="password" name="Password" id="Password" placeholder="Type title here" value="">
                                </div>
                                <div class= "form-group mt-2">
                                    <label for="ConfirmPassword"><span class="FieldInfo">Confirm Password: </span></label>
                                    <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword" placeholder="Type title here" value="">
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-6 mt-1">
                                        <a href="Dashboard.php" class="btn btn-outline-warning btn-own" ><i class="fas fa-arrow-left"></i> Back to Dashboard</a> 
                                    </div>
                                    <div class="col-lg-6 mt-1 ">
                                        <button type="submit" name="Submit" class="btn btn-success btn-own">
                                            <i class="fas fa-check"></i> Publish
                                        </button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                  </form>
                  <h3 class="display-6 mb-3 mt-3">List of Admins</h3>
                <table class="table table-hover mt-2 ">
                <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Date&Time</th>
                    <th>Admin Name</th>
                    <th>Username</th>
                    <th>Added By</th>
                    
                    <th>Action</th>
                    
                </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM admins ORDER BY id desc";
                $stmt = $ConnectingDB->query($sql);
                $Sr=0;
                while($DataRows = $stmt->fetch()){
                    $Id = $DataRows["id"];
                    
                    $DateTime = $DataRows["datetime"];
                    $AdminName = $DataRows["aname"];
                    $UserName = $DataRows["username"];
                    $AddedBy = $DataRows["addedby"];
                    
                    
                    
                    $Sr++;
                    ?>
                
                
                <tr>
                    <td><?php echo htmlentities($Sr); ?></td>
                    <td><?php echo htmlentities($DateTime); ?></td>
                    <td ><?php echo htmlentities($AdminName); ?></td>
                    <td ><?php echo htmlentities($UserName); ?></td>
                    <td ><?php echo htmlentities($AddedBy); ?></td>
                    <script>
                        function confirmDelete(id) {
                        Swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // If confirmed, redirect to DeleteComments.php with the id
                                window.location.href = `DeleteAdmin.php?id=${id}`;
                            }
                        });
                    }

                    </script>
                    
                    <td><a class="btn btn-outline-danger" onclick="confirmDelete(<?php echo $Id?>)">Delete</a></td>
                    


                    
                </tr>
                
                    <?php } ?>
                </table>
                </div>
            </div>
        </section>






        <!-- footer -->
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
              <div class="col-md-4 d-flex align-items-center">
                <a class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                    <img src="images/logo.jpg" alt="" width="45" height="45" class="d-inline-block align-middle">
                </a>
                <span class="text-muted">DIMSHUBLOG</span>
              </div>
          
              <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-1"><a class="text-muted" href="https://www.instagram.com/s_hubhalina_?igsh=MWIwdm41MjdwbTNqNw%3D%3D&utm_source=qr"><img src="images/instagram-brands.svg" class="bi" alt="" width="24" height="24" class="d-inline-block align-middle"></a></li>
              </ul>
            </footer>
          </div>
        
          <!-- footer end -->
        
        
        
        
       <script src="https://kit.fontawesome.com/656d645cb5.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

</html>
