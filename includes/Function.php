<?php require_once("includes/DB.php"); ?>
<?php
global $ConnectingDB;
function Redirect_to($New_Location){
    header("Location:".$New_Location);
    exit;
}

function CheckUserNameExistsOrNot($UserName){
global $ConnectingDB;
$sql="SELECT username FROM admins WHERE username=:userName";

$stmt = $ConnectingDB->prepare($sql);
$stmt ->bindValue(':userName', $UserName);
$stmt-> execute();
$Result = $stmt->rowcount();
if($Result==1){
    return true;
}
else{
    return false;
}

}
function Login_Attempt($UserName,$Password){
    global $ConnectingDB;
    $sql = "SELECT * FROM admins WHERE username=:userName AND password=:passWord LIMIT 1";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue(':userName',$UserName);
            $stmt->bindValue(':passWord',$Password);
            $stmt->execute();
            $Result = $stmt->rowcount();
            if($Result==1){
                return $stmt->fetch();
            }else{
                return null;
            }
}
function Login_AttemptforUser($Email,$Password){
  global $ConnectingDB;
  $sql = "SELECT * FROM user_info WHERE email=:email AND password=:passWord AND status=1 LIMIT 1";
          $stmt = $ConnectingDB->prepare($sql);
          $stmt->bindValue(':email',$Email);
          $stmt->bindValue(':passWord',$Password);
          $stmt->execute();
          $Result = $stmt->rowcount();
          if($Result==1){
              return $stmt->fetch();
          }else{
              return null;
          }
}


function Confirm_Login(){
    if(isset($_SESSION["UserId"])){
        return true;
    }else{
        $_SESSION["ErrorMessage"]="Login Requires";
        Redirect_to("Login.php");
    }
}
function TotalPost(){
    global $ConnectingDB;
    $sql ="SELECT COUNT(*) FROM posts";
    $stmt = $ConnectingDB->query($sql);
    $TotalRows =$stmt->fetch();
    $TotalAdmins = array_shift($TotalRows);
    echo $TotalAdmins;
}
function TotalCategories(){
    global $ConnectingDB;
    $sql = "SELECT COUNT(*) FROM category";
    $stmt = $ConnectingDB->query($sql);
    $TotalRows= $stmt->fetch();
    $TotalCategories=array_shift($TotalRows);
    echo $TotalCategories;
  }
  
  function TotalAdmins(){
  
    global $ConnectingDB;
    $sql = "SELECT COUNT(*) FROM admins";
    $stmt = $ConnectingDB->query($sql);
    $TotalRows= $stmt->fetch();
    $TotalAdmins=array_shift($TotalRows);
    echo $TotalAdmins;
  
  }
  
  function TotalComments(){
    global $ConnectingDB;
    $sql = "SELECT COUNT(*) FROM comments";
    $stmt = $ConnectingDB->query($sql);
    $TotalRows= $stmt->fetch();
    $TotalComments=array_shift($TotalRows);
    echo $TotalComments;
  }
  
  function ApproveCommentsAccordingtoPost($PostId){
    global $ConnectingDB;
    $sqlApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='ON'";
    $stmtApprove =$ConnectingDB->query($sqlApprove);
    $RowsTotal = $stmtApprove->fetch();
    $Total = array_shift($RowsTotal);
    return $Total;
  }
  
  function DisApproveCommentsAccordingtoPost($PostId){
    global $ConnectingDB;
    $sqlDisApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='OFF'";
    $stmtDisApprove =$ConnectingDB->query($sqlDisApprove);
    $RowsTotal = $stmtDisApprove->fetch();
    $Total = array_shift($RowsTotal);
    return $Total;
  }

?>