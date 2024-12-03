<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Function.php"); ?>
<?php require_once("includes/Sessions.php"); ?>

<?php 
    if(isset($_GET["id"])){
        $id_From_URl = $_GET["id"];
        
       
        $sql = "UPDATE user_info SET status=0 WHERE user_id='$id_From_URl'";
        $Execute = $ConnectingDB->query($sql);
         if ($Execute) {
          $_SESSION["SuccessMessage"]="User Disapproved Successfully ! ";
          Redirect_to("users.php");
        }else {
          $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
         Redirect_to("users.php");
  }

    }


?>