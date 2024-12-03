<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Function.php"); ?>
<?php require_once("includes/Sessions.php"); ?>

<?php
    $PostIdFromURL = $_GET["id"];

    // Retrieve post data from database
    $sql = "SELECT * FROM posts WHERE id = :postId";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':postId', $PostIdFromURL);
    $stmt->execute();
    $postData = $stmt->fetch();

    if (!$postData) {
        $_SESSION["ErrorMessage"] = "Post not found!";
        Redirect_to("userPage.php");
    }

    $PostTitle = $postData["title"];
    $DateTime = $postData["datetime"];
    $Admin = $postData["author"];
    $Image = $postData["image"];
    $PostDescription = $postData["post"];

    // Handle form submission for comments
    if (isset($_POST["Submit"])) {
        $Name = $_POST["CommenterName"];
    $Email = $_POST["Email"];
    $Comment = $_POST["Comment"];
    $Admin = $_SESSION["UserName"];
    date_default_timezone_set("Asia/Calcutta");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

    if(empty($Name)||empty($Email)||empty($Comment)){
        $_SESSION["ErrorMessage"]= "Connot be empty";
        Redirect_to("FullPost_1.php?id=$PostIdFromURL");
    }

    elseif(strlen($Name)<3){
        $_SESSION["ErrorMessage"]= "Name should be greater than 2 characters";
        Redirect_to("FullPost_1.php?id=$PostIdFromURL");
    }

    elseif(strlen($Name)>49){
        $_SESSION["ErrorMessage"]= "Name should be less than 50 characters";
        Redirect_to("FullPost_1.php?id=$PostIdFromURL");
    }
    elseif(strlen($Email)<3){
        $_SESSION["ErrorMessage"]= "Email should be greater than 2 characters";
        Redirect_to("FullPost_1.php?id=$PostIdFromURL");
    }

    elseif(strlen($Email)>59){
        $_SESSION["ErrorMessage"]= "Email should be less than 60 characters";
        Redirect_to("FullPost_1.php?id=$PostIdFromURL");
    }
    elseif(strlen($Comment)<3){
        $_SESSION["ErrorMessage"]= "Email should be greater than 2 characters";
        Redirect_to("FullPost_1.php?id=$PostIdFromURL");
    }

    elseif(strlen($Comment)>499){
        $_SESSION["ErrorMessage"]= "Email should be less than 500 characters";
        Redirect_to("FullPost_1.php?id=$PostIdFromURL");
    }
    else{
        //query
        $sql = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id)";
        $sql .= "VALUES(:datetime,:name,:email,:comment, 'Pending', 'OFF',:postIdFromUrl)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt-> bindValue(':datetime', $DateTime);
        $stmt-> bindValue(':name', $Name);
        $stmt-> bindValue(':email', $Email);
        $stmt-> bindValue(':comment', $Comment);
        $stmt-> bindValue(':postIdFromUrl', $PostIdFromURL);
        $Execute=$stmt->execute();


        if($Execute){
            $_SESSION["SuccessMessage"]="Comment Added Successfully";
            Redirect_to("FullPost_1.php?id=$PostIdFromURL");
        }
        else{
            $_SESSION["ErrorMessage"]="Something went wrong !";
            Redirect_to("FullPost_1.php?id=$PostIdFromURL");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlentities($PostTitle); ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<!-- Navigation -->
<nav class="bg-white p-6 mb-10 shadow">
    <div class="container mx-auto flex items-center justify-between flex-wrap">
        <div class="flex items-center flex-shrink-0 text-black mr-6">
            <a href="#" class="font-semibold text-xl tracking-tight">DIMSHUBLOG</a>
        </div>
        <div class="block lg:hidden">
            <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-700 border-gray-700 hover:text-black hover:border-black">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 0h20v20H0V0zm2 2h16v2H2V2zm0 5h16v2H2V7zm0 5h16v2H2v-2zm0 5h16v2H2v-2z"/></svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto hidden" id="nav-content">
            <div class="text-sm lg:flex-grow">
                <a href="UserPage.php" class="block mt-4 lg:inline-block lg:mt-0 text-gray-700 hover:text-black mr-4">Home</a>
                <a href="index.html#contact" class="block mt-4 lg:inline-block lg:mt-0 text-gray-700 hover:text-black">Contact Us</a>
            </div>
        </div>
    </div>
</nav>
<!-- End Navigation -->

<!-- Main Content -->
<div class="container mx-auto">
    <div class="flex flex-wrap justify-center">
            
        <div class="w-full lg:w-2/3 px-4 mb-8">
            <?php
                echo ErrorMessage();
                echo SuccessMessage();
                ?>
            <!-- Blog Post -->
            <div class="bg-white mt-2 rounded-lg shadow-lg">
            <img src="Uploads/<?php echo htmlentities($Image); ?>" class="w-full h-auto object-center rounded-t-lg" alt="Blog Image">
            <div class="p-6">
                <h2 class="text-3xl font-bold mb-2"><?php echo htmlentities($PostTitle); ?></h2>
                <p class="text-gray-700 mb-2">Written by <?php echo htmlentities($Admin); ?> on <?php echo htmlentities($DateTime); ?></p>
                <div class="text-gray-700 mb-4"><?php echo $PostDescription; ?></div>
            </div>
        </div>
            <!-- End Blog Post -->

            <!-- Comment Section -->
            <div class="mt-6">
                <h2 class="text-2xl font-semibold mb-4">Comments</h2>
                <!-- Your comment section code here -->
                <!-- Example comment -->
                <div class="bg-white rounded-lg shadow-lg p-4 mb-4">
                <?php

                                $sql = "SELECT * FROM comments WHERE post_id='$PostIdFromURL' AND status='ON' ";
                                // $sql = "SELECT * FROM `marvick`.`posts` WHERE `id` = '$PostIdFromURL'";

                                $stmt = $ConnectingDB->query($sql);

                                while ($DataRows = $stmt->fetch()){
                                        $CommentDate = $DataRows['datetime'];
                                        $CommenterName = $DataRows['name'];
                                        $CommenterComment= $DataRows['comment'];

                                ?>
                    <div class="flex items-center mb-2 ">
                   
                        <div class="flex-shrink-0 mr-2">
                            <img class="w-8 h-8 rounded-full" src="https://static.vecteezy.com/system/resources/thumbnails/009/734/564/small_2x/default-avatar-profile-icon-of-social-media-user-vector.jpg" alt="User Avatar">
                        </div>
                        

                        <div>
                            <h3 class="text-gray-900 mt-2 font-semibold"><?php echo htmlentities($CommenterName);?></h3>
                            <p class="text-gray-600 text-sm">Posted on <?php echo htmlentities($CommentDate);?></p>
                        </div>
                    </div>
                    <p class="text-gray-800 bg-gray-50 p-4 rounded-lg"><?php echo htmlentities($CommenterComment); ?></p>
                    <?php } ?>
                </div>
                <!-- End Example comment -->
                
            </div>
            <!-- End Comment Section -->

            <!-- Comment Form -->
            <div class="mt-6">
                <h2 class="text-2xl font-semibold mb-4">Leave a Comment</h2>
                <!-- Your comment form code here -->
                <form action="FullPost_1.php?id=<?php echo $PostIdFromURL; ?>" method="post">
                    <div class="mb-4">
                        <label for="commenterName" class="block text-gray-700 font-semibold">Your Name</label>
                        <input type="text" id="commenterName" name="CommenterName" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-400" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-4">
                        <label for="commenterEmail" class="block text-gray-700 font-semibold">Your Email</label>
                        <input type="email" id="commenterEmail" name="Email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-400" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-4">
                        <label for="commentContent" class="block text-gray-700 font-semibold">Your Comment</label>
                        <textarea id="commentContent" name="Comment" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-400" rows="5" placeholder="Write your comment here" required></textarea>
                    </div>
                    <button type="submit" name="Submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Submit</button>
                </form>
            </div>
            <!-- End Comment Form -->
        </div>
    </div>
</div>
<!-- End Main Content -->

<!-- Footer -->
<footer class="bg-gray-800 text-white py-4">
    <div class="container mx-auto text-center">
        <p>&copy; <?php echo date("Y"); ?> DIMSHUBLOG. All rights reserved.</p>
    </div>
</footer>
<!-- End Footer -->

<!-- JavaScript for responsive navigation -->
<script>
    document.getElementById('nav-toggle').onclick = function(){
        document.getElementById("nav-content").classList.toggle("hidden");
    }
</script>
</body>
</html>
