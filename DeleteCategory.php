<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Function.php"); ?>
<?php require_once("includes/Sessions.php"); ?>

<?php 
    if(isset($_GET["id"])){
        $id_From_URL = $_GET["id"];
        
        
        $sql = "DELETE FROM category WHERE id='$id_From_URL'";

        $Execute = $ConnectingDB->query($sql);
         if ($Execute) {
         $_SESSION["SuccessMessage"]="Category Deleted Successfully ";
        Redirect_to("Categories.php");
    
        }else {
          $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
         Redirect_to("Categories.php");
  }

    }


?>