<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Function.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Blog</title>
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
                <a href="#" class="block mt-4 lg:inline-block lg:mt-0 text-gray-700 hover:text-black mr-4">
                    Home
                </a>
                <a href="index.html#contact" class="block mt-4 lg:inline-block lg:mt-0 text-gray-700 hover:text-black">
                    Contact
                </a>
            </div>
            <div>
                <a href="Logoutuser.php" class="inline-block text-sm px-4 py-2 leading-none border rounded text-gray-700 border-gray-700 hover:border-transparent hover:text-white hover:bg-black mt-4 lg:mt-0">Log Out</a>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mx-auto">
    <div class="flex flex-wrap">
        <!-- Blog Entries -->
        <div class="w-full px-4 mb-8">
            <div class="flex flex-wrap -mx-4">
                <!-- PHP Loop for Blog Posts -->
                <?php
                // Include database connection or connect to database here
                
                // Assuming the $ConnectingDB is your database connection object

                $sql = "SELECT *  FROM posts ORDER BY id desc";
                $stmt = $ConnectingDB->query($sql);

                while($DataRows = $stmt->fetch()){
                    $PostId = $DataRows["id"];
                    $DateTime = $DataRows["datetime"];
                    $PostTitle = $DataRows["title"];
                    $Admin = $DataRows["author"];
                    $Image = $DataRows["image"];
                    $PostDescription = $DataRows["post"];
                ?>
                <!-- Blog Post -->
                <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                    <div class="bg-white rounded-lg shadow-lg">
                        <img class="w-full h-40 object-cover object-center rounded-t-lg" src="Uploads/<?php echo htmlentities($Image); ?>" alt="Blog Image">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold mb-2"><?php echo htmlentities($PostTitle); ?></h2>
                            <h4 class="text-gray-700 mb-2">Written by <?php echo htmlentities($Admin); ?></h4>
                            <p class="text-gray-700 mb-4"><?php if (strlen($PostDescription)>50){$PostDescription=substr($PostDescription,0,50).'...';} echo htmlentities($PostDescription); ?></p>
                            <a href="FullPost_1.php?id=<?php echo $PostId?>" class="inline-block bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800">Read More</a>
                        </div>
                    </div>
                </div>
                <!-- End Blog Post -->
                <?php } // End of while loop ?>
                <!-- End PHP Loop for Blog Posts -->
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-4">
    <div class="container mx-auto text-center">
        <p>&copy; 2024 Modern Blog. All rights reserved.</p>
    </div>
</footer>

<!-- JavaScript for responsive navigation -->
<script>
    document.getElementById('nav-toggle').onclick = function(){
        document.getElementById("nav-content").classList.toggle("hidden");
    }
</script>

</body>
</html>
