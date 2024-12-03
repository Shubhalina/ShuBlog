<div class="container">
                <div class="row">
                    <div class="col-sm-9">
                <div class="row mt-2">
                    <!-- main area   -->
                    
                    <h1 class="display-5 mt-1 mb-3">DIMSHUBLOG Blog Post</h1>
                    <?php 
                        echo ErrorMessage();
                    ?>
                    <?php 
                    // sql when search button is active
                    if(isset($_GET["SearchButton"])){
                        $Search = $_GET["Search"];
                        $sql = "SELECT * FROM posts
                        WHERE title LIKE :search
                        OR category LIKE :search
                        OR post LIKE :search";
                        $stmt = $ConnectingDB->prepare($sql);
                        $stmt->bindValue(':search','%'.$Search.'%');
                        $stmt->execute();
                    }
                    // Query When Pagination is Active i.e Blog.php?page=1
          elseif (isset($_GET["page"])) {
            $Page = $_GET["page"];
            if($Page==0||$Page<1){
            $ShowPostFrom=0;
          }else{
            $ShowPostFrom=($Page*6)-6;
          }
            $sql ="SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,6";
            $stmt=$ConnectingDB->query($sql);
          }



                    //default sql query
                        else{
                        $sql = "SELECT *  FROM posts ORDER BY id desc";
                        $stmt = $ConnectingDB->query($sql);
                        }   
                        while($DataRows = $stmt->fetch()){
                            $PostId = $DataRows["id"];
                            $DateTime = $DataRows["datetime"];
                            $PostTitle = $DataRows["title"];
                            $Category = $DataRows["category"];
                            $Admin = $DataRows["author"];
                            $Image = $DataRows["image"];
                            $PostDescription = $DataRows["post"];
                            ?>
                    
                        <div class="col-md-4">
                            <div class ="card mt-2 " style="width: 95%;"> <!-- style="width: 20rem;" -->
                            <img src="Uploads/<?php echo htmlentities($Image); ?>"  class="img-fluid card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlentities($PostTitle); ?></h5>
                                <small class="text-muted">written by <?php echo htmlentities($Admin); ?> On 
                            <?php if (strlen($DateTime)>16){$DateTime=substr($DateTime,0,16).'...';} echo htmlentities($DateTime); ?></small>
                                <span class="badge alert-dark" style="float:right;"><?php 
                            $Total=ApproveCommentsAccordingtoPost($PostId);
                            if($Total>0){
                            ?>
                            Comments:
                    
                        <?php    
                        echo $Total;
                        ?>
                     <?php } ?>
                     </span>
                            <hr>
                            <p class="card-text"><?php if (strlen($PostDescription)>26){$PostDescription=substr($PostDescription,0,26).'...';} echo htmlentities($PostDescription); ?></p>
                            <a href="FullPost_1.php?id=<?php echo $PostId?>" style="float:right;">
                            <span class="btn btn-sm btn-outline-info">Read More >></span>
                        </a>
                            </div>
                            </div>
                        </div>     

                            <?php } ?>
                    </div>
                    <!-- Pagination -->
          <nav>
            <ul class="pagination justify-content-center mt-3">
              <!-- Creating Backward Button -->
              <?php if( isset($Page) ) {
                if ( $Page>1 ) {?>
             <li class="page-item">
                 <a href="Blogs.php?page=<?php  echo $Page-1; ?>" class="page-link">&laquo;</a>
               </li>
             <?php } }?>
            <?php
            global $ConnectingDB;
            $sql           = "SELECT COUNT(*) FROM posts";
            $stmt          = $ConnectingDB->query($sql);
            $RowPagination = $stmt->fetch();
            $TotalPosts    = array_shift($RowPagination);
            // echo $TotalPosts."<br>";
            $PostPagination=$TotalPosts/6;
            $PostPagination=ceil($PostPagination);
            // echo $PostPagination;
            for ($i=1; $i <=$PostPagination ; $i++) {
              if( isset($Page) ){
                if ($i == $Page) {  ?>
              <li class="page-item active">
                <a href="Blogs.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
              </li>
              <?php
            }else {
              ?>  <li class="page-item">
                  <a href="Blogs.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
                </li>
            <?php  }
          } } ?>
          <!-- Creating Forward Button -->
          <?php if ( isset($Page) && !empty($Page) ) {
            if ($Page+1 <= $PostPagination) {?>
         <li class="page-item">
             <a href="Blogs.php?page=<?php  echo $Page+1; ?>" class="page-link">&raquo;</a>
           </li>
         <?php } }?>
            </ul>
          </nav>
        </div>





        
                     <!-- slide area -->


                     
                    <div class="col-sm-3">
                    
          <br><br><br><br>
          <div class="card">
            <div class="card-header bg-dark text-light">
              <h2 class="lead">Categories</h2>
              </div>
              <div class="card-body">
                <?php
                global $ConnectingDB;
                $sql = "SELECT * FROM category ORDER BY id desc";
                $stmt = $ConnectingDB->query($sql);
                while ($DataRows = $stmt->fetch()) {
                  $CategoryId = $DataRows["id"];
                  $CategoryName=$DataRows["title"];
                 ?>
                <a class="text-dark" href="Blog.php?category=<?php echo $CategoryName; ?>"> <span class="heading"> <?php echo $CategoryName; ?></span> </a><br>
               <?php } ?>
            </div>
          </div>
          <br>
          


                    </div>

                </div>
                </div>
                </div>
            
            
    
