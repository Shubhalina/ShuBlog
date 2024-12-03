<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Function.php"); ?>
<?php require_once("includes/Sessions.php"); ?>

<?php 
    if(isset($_GET["id"])){
        $id_From_URl = $_GET["id"];
        
        $Admin = $_SESSION["AdminName"];
        $sql = "UPDATE comments SET status='OFF', approvedby='$Admin' WHERE id='$id_From_URl'";
        $Execute = $ConnectingDB->query($sql);
         if ($Execute) {
         $_SESSION["SuccessMessage"]="Comment Disapproved Successfully ! ";
        Redirect_to("Comments.php");
    
        }else {
          $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
         Redirect_to("Comments.php");
  }

    }


?>