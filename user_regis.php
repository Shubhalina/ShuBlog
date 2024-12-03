    <?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Function.php"); ?>
<?php require_once("includes/Sessions.php"); ?>

<?php 
if(isset($_POST["submit"])){
    $UserName        = $_POST["Username"];
    $Password        = $_POST["Password"];
    $Email           = $_POST["Email"];
    $ConfirmPassword = $_POST["ConfirmPassword"];

    if(empty($UserName)||empty($Password)||empty($ConfirmPassword)){
        $_SESSION["ErrorMessage"]= "All fields must be filled out";
    } elseif (strlen($Password)<4) {
        $_SESSION["ErrorMessage"]= "Password should be greater than 3 characters";
    } elseif ($Password !== $ConfirmPassword) {
        $_SESSION["ErrorMessage"]= "Password and Confirm Password should match";
    } elseif (CheckUserNameExistsOrNot($UserName)) {
        $_SESSION["ErrorMessage"]= "Username Exists. Try Another One!";
    } else {
        // Query to insert new admin in DB When everything is fine
        $sql = "INSERT INTO user_info(username,email,password,status)";
        $sql .= "VALUES(:userName,:email,:password,0)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':userName',$UserName);
        $stmt->bindValue(':email',$Email);
        $stmt->bindValue(':password',$Password);

        $Execute=$stmt->execute();
        if($Execute){
            $_SESSION["SuccessMessage"]="New Admin with the name of ".$UserName." added Successfully";
        } else {
            $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
        }
    }
    Redirect_to("userlogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md max-w-md w-full">
        <h2 class="text-2xl font-semibold mb-4">Register</h2>
        <form class="mb-8" method="post">
            <?php 
            if(isset($_SESSION["ErrorMessage"])){
                echo '<div class="text-red-500 mb-4">'.$_SESSION["ErrorMessage"].'</div>';
                unset($_SESSION["ErrorMessage"]);
            }
            ?>
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-semibold mb-2">Username</label>
                <input type="text" id="username" name="Username"
                    class="border border-gray-300 rounded-md w-full px-3 py-2" placeholder="Enter your username">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                <input type="email" id="email" name="Email"
                    class="border border-gray-300 rounded-md w-full px-3 py-2" placeholder="Enter your email">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" id="password" name="Password"
                    class="border border-gray-300 rounded-md w-full px-3 py-2" placeholder="Enter your password">
            </div>
            <div class="mb-4">
                <label for="confirm-password" class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                <input type="password" id="confirm-password" name="ConfirmPassword"
                    class="border border-gray-300 rounded-md w-full px-3 py-2" placeholder="Confirm your password">
            </div>
            <button type="submit" name="submit"
                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition-colors duration-300">Register</button>
        </form>
        <div class="text-right">
            <a href="userlogin.php" class="text-gray-500 hover:underline">Go back to login</a>
        </div>
    </div>
</body>
</html>
