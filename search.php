 <?php 
 include "./layout/master.php";
 ?>
 <!-- News With Sidebar Start -->
 <div class="container-fluid mt-5 pt-3">
        <div class="container">
        <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                        <?php
                        require_once "./assets/config/db.php";
                        $search_term = mysqli_real_escape_string($conn, $_GET['search']);

                        $result = mysqli_query($conn, "SELECT * FROM post
                        LEFT JOIN category ON post.post_category = category.category_id 
                        LEFT JOIN webmaster ON post.post_author = webmaster.id
                        WHERE (post.post_title LIKE '%$search_term%' OR post.post_descp LIKE '%$search_term%') AND post.post_status = 'Active'
                        ORDER BY post.post_id DESC");
                        if (!$result) {
                            die("Query failed: " . mysqli_error($conn));
                        }
                        if(mysqli_num_rows($result)){
                           ?>
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Search: <?php echo $search_term; ?></h4>
                            </div>
                        </div>
                        <?php while($row = mysqli_fetch_assoc($result)){?>
                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="./uploads/<?php echo $row['post_image']; ?>" style="object-fit: cover;">
                                <div class="bg-white border border-top-0 p-4">
                            <div class="mb-2">
                           <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                             href="category.php?cid=<?php echo $row['post_category']; ?>"><?php echo $row['category_name']; ?></a>
                            <h6 class="text-body mt-2" href=""><small><?php echo $row['post_date']; ?></small></h6>
                         </div>
                           <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="single.php?id=<?php echo $row['post_id'];?>"><?php echo substr($row['post_title'], 0, 45) . "..."; ?> </a>
                           <p class="m-0"><?php echo substr($row['post_descp'], 0, 90) . "..."; ?> ></p>
                           </div>
                            </div>
                            
                        </div>
                        <?php 
                            }
                            }
                            else{
                               echo "<h1>No Record Found</h1>"; 
                            }
                            ?>
                            
                    </div>
                    
                </div>
                
        </div>
        
    </div>
    <!-- News With Sidebar End -->
    
    <?php 
 include "./layout/footer.php";
 ?>