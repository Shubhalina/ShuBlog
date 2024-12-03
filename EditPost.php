<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Function.php"); ?>
<?php require_once("includes/Sessions.php"); ?>

<?php
$SearchQueryParameter = $_GET["id"];
if(isset($_POST["Submit"])){
    $PostTitle = $_POST["PostTitle"];
    $Category = $_POST["Category"];
    $Image = $_FILES["Image"]["name"];
    //location of our image
    $Target = "uploads/".basename($_FILES["Image"]["name"]);
    //end
    $PostDescription =$_POST["PostDescription"];
    $Admin = $_SESSION["UserName"];
    date_default_timezone_set("Asia/Calcutta");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

    if(empty($PostTitle)){
        $_SESSION["ErrorMessage"]= "All fields must be filled out";
        Redirect_to("EditPost.php?id=$SearchQueryParameter");
    }
    elseif(strlen($PostTitle)<3){
        $_SESSION["ErrorMessage"]= "Post title should be greater than 2 characters";
        Redirect_to("EditPost.php?id=$SearchQueryParameter");
    }
    elseif(strlen($PostTitle)>49){
        $_SESSION["ErrorMessage"]= "Post title should be less than 50 characters";
        Redirect_to("EditPost.php?id=$SearchQueryParameter");
    }elseif(strlen($PostDescription)>9999){
        $_SESSION["ErrorMessage"]= "Post title should be less than 10000 characters";
        Redirect_to("EditPost.php?id=$SearchQueryParameter");
    }
    else{
        //query to update post in DB when everything is fine
        if(!empty($Image)){
            $sql ="UPDATE posts 
            SET title='$PostTitle',category='$Category', image='$Image',post='$PostDescription'
            WHERE id='$SearchQueryParameter '";
        }else{
            $sql ="UPDATE posts 
            SET title='$PostTitle',category='$Category', post='$PostDescription'
            WHERE id='$SearchQueryParameter '";
        }
        
        $Execute=$ConnectingDB->query($sql); //for update

        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
        
        if($Execute){
            $_SESSION["SuccessMessage"]="Post with id: ".$SearchQueryParameter." Updated Successfully";
            Redirect_to("EditPost.php?id=$SearchQueryParameter");
        }
        else{
            $_SESSION["ErrorMessage"]="Something went wrong !";
            Redirect_to("EditPost.php?id=$SearchQueryParameter");
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
        <title>Categories</title>
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
        
        <header class= "bg-dark text-light py-3">
            <div class="container">
                <div class="row">
                    <div class=col-md-12>
                    <?php 
                         if(!isset($SearchQueryParameter)){
                            $_SESSION["ErrorMessage"]="Bad Request !";
                            Redirect_to("Posts.php");
                        }
                        ?>
                        <h1><i class="fas fa-mail-bulk" style="color: #dadada;"></i> Edit Post</h1>
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
                
                // main edit function

                
                $sql = "SELECT * FROM posts WHERE id='$SearchQueryParameter'";
                $stmt = $ConnectingDB->query($sql);
                while($DataRows=$stmt->fetch()){
                    $TitleToBeUpdated =$DataRows['title'];
                    $CategoryToBeUpdated = $DataRows['category'];
                    $ImageToBeUpdated =$DataRows['image'];
                    $PostToBeUpdated =$DataRows['post'];

                }

                ?>
                <form class="" action="EditPost.php?id=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data" >
                        <div class="card bg-secondary text-light mb-3">
                            
                            <div class="card-body bg-dark">
                                <div class= "form-group mt-2">
                                    <label for="title"><span class="FieldInfo">Post Title:</span></label>
                                    <input class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo $TitleToBeUpdated; ?>">
                                </div>
                                <div class= "form-group mt-2">
                                     <span class="FieldInfo">Existing category:</span>
                                     <span class= "FieldInfo text-warning"><?php echo $CategoryToBeUpdated; ?></span>
                                     <br>
                                </div>
                                <div class= "form-group mt-2">
                                    <label for="Categorytitle"><span class="FieldInfo">Choose category:</span></label>
                                    <select  class="form-control" name="Category" id="Categorytitle">
                                        <?php

                                        //fetching all the categories
                                        global $ConnectingDB;
                                        $sql = "SELECT id,title FROM category";
                                        $stmt = $ConnectingDB->query($sql);
                                        while ($DataRows = $stmt->fetch()){
                                            $Id = $DataRows["id"];
                                            $CategoryName = $DataRows["title"];
                                            ?>
                                            <option><?php echo $CategoryName; ?></option>

                                            <?php } ?>

                        
                                    </select>
                                </div>
                                <div class= "form-group mt-2">
                                     <span class="FieldInfo">Existing Image:</span>
                                     <br>
                                     <span class= "FieldInfo"><img class="img-thumbnail" src="uploads/<?php echo $ImageToBeUpdated?>"  style="max-height: 300px;"></span>
                                     
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    
                                        <label for="ImageSelect" class="FieldInfo">Select Image: </label>
                                        <input class="form-control" type="File" name="Image" id="ImageSelect" value="">
                                        
                                    
                                </div>
                                <div class="form-group">
                                    <label for="Post"><span class="FieldInfo"> Post: </span></label>
                                    <textarea class="form-control" id="Post" name="PostDescription" row="8" cols="80"><?php echo $PostToBeUpdated?></textarea>
                                </div>
                                <div class="row">
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
