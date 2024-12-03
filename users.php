<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Function.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"]; 
Confirm_Login();?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Users</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    </head>

    <body>
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
                                    window.location.href = `UserDelete.php?id=${id}`;
                                }
                            });
                        }

                    </script>
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
        
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h1><i class="fas fa-comments" style="color: #dadada;"></i> Manage Users</h1>
          </div>
        </div>
      </div>
    </header>

        <!-- header end -->
<!-- Main Area Start -->
        <section class="container py-2 mb-4">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo ErrorMessage();
                    echo SuccessMessage();
                    ?>
                    <h2 class="display-6 mb-3 mt-3">Disapproved Users</h2>
                    <table class="table table-hover mt-2 ">
                    <thead class="thead-light">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Approve</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <?php
                    $sql = "SELECT * FROM user_info WHERE status=0 ORDER BY user_id desc";
                    $stmt = $ConnectingDB->query($sql);
                    $Sr=0;
                    while($DataRows = $stmt->fetch()){
                        $Id = $DataRows["user_id"]; 
                        $userName = $DataRows["username"];
                        $Email = $DataRows["email"];
                        $Sr++;
                        ?>    
                    <tr>
                        <td><?php echo htmlentities($Sr); ?></td>
                        <td><?php echo htmlentities($userName); ?></td>
                        <td ><?php echo htmlentities($Email); ?></td>
                        <td><a class="btn btn-outline-success" href="UserApproved.php?id=<?php echo $Id;?>" >Approve</a></td>
                        <td><a class="btn btn-outline-danger" onclick="confirmDelete(<?php echo $Id?>)">Delete</a></td>

                        

                        
                    </tr>
                        <?php } ?>
                    </table>

                    <div class="mt-5">
                            <h2 class=" display-6 mb-3 mt-3">Approved Users</h2>
                            <table class="table table-hover mt-2 ">
                                <thead class="thead-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Disapprove</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <?php
                                $sql = "SELECT * FROM user_info WHERE status=1 ORDER BY user_id desc";
                                $stmt = $ConnectingDB->query($sql);
                                $Sr=0;
                                while($DataRows = $stmt->fetch()){
                                    $Id = $DataRows["user_id"]; 
                                    $userName = $DataRows["username"];
                                    $Email = $DataRows["email"];
                                    $Sr++;
                                    ?>    
                                <tr>
                                    <td><?php echo htmlentities($Sr); ?></td>
                                    <td><?php echo htmlentities($userName); ?></td>
                                    <td ><?php echo htmlentities($Email); ?></td>
                                    <td><a class="btn btn-outline-success" href="UserDisapproved.php?id=<?php echo $Id;?>" >Disapprove</a></td>
                                    <td><a class="btn btn-outline-danger" onclick="confirmDelete(<?php echo $Id?>)">Delete</a></td>



                                    
                                </tr>
                                    <?php } ?>
                                </table>
                    </div>
                    
                    


                </div>
            </div>
        </section>



<!-- Main Area End -->
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
                <li class="ms-1"><a class="text-muted" href="https://www.instagram.com/marvick_ps/"><img src="images/instagram-brands.svg" class="bi" alt="" width="24" height="24" class="d-inline-block align-middle"></a></li>
              </ul>
            </footer>
          </div>
        
          <!-- footer end -->
        
        
        
        
       <script src="https://kit.fontawesome.com/656d645cb5.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

</html>
