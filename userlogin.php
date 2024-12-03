<?php require_once("dbconnect.php"); ?>
<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Function.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php
    if (isset($_POST["login"])) {
        $Email = $_POST["email"];
        $Password = $_POST["password"];
        if(empty($Email)||empty($Password)){
            $_SESSION["ErrorMessage"]="Please enter all the fields";
            Redirect_to("userlogin.php");
        }else{
            $Login_Attempt=Login_AttemptforUser($Email,$Password);
            if($Login_Attempt){
                // $_SESSION["UserId"]=$Login_Attempt["id"];
                $_SESSION["UserName"]=$Login_Attempt["username"];
                // $_SESSION["AdminName"]=$Login_Attempt["aname"];

                $_SESSION["SuccessMessage"]="Welcome ".$_SESSION["UserName"];
                
                  Redirect_to("userPage.php");
                
                
            }else{
                $_SESSION["ErrorMessage"]="Account does not exist";
                Redirect_to("userlogin.php");
            }


        }
    }?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DS BLOG</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="logincss.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto">
        <div class="flex justify-center items-center h-screen">
            <div class="bg-white rounded-lg shadow-lg p-8 w-full sm:w-1/2 md:w-1/3 lg:w-1/3">
                <h2 class="text-center text-2xl font-semibold mb-4">LOG IN</h2>
                <div class="mb-4">
                    <?php echo SuccessMessage();
                          echo ErrorMessage(); ?>
                </div>
                <form method="POST" action="userlogin.php">
                    <div class="mb-4">
                        <input type="text" name="email" id="username" class="form__input w-full p-2 border border-gray-300 rounded-md" placeholder="Email">
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password" id="password" class="form__input w-full p-2 border border-gray-300 rounded-md" placeholder="Password">
                    </div>
                    <div class="mb-4">
                        <button type="submit" name="login" class="w-full bg-green-500 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out hover:bg-green-600">Login</button>
                    </div>
                </form>
                <div class="text-center">
                    <p>Don't have an account? <a href="user_regis.php" class="text-blue-500">Register Here</a></p>
                    <p>Go back to <a href="index.html" class="text-blue-500">Home</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</body>

</html>
