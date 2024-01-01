<?php include "./layout/master.php"; ?>
    <!-- News With Sidebar Start -->
    <div class="container-fluid mt-5 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <?php 
                            require_once "./assets/config/db.php";
                            $cat_id = $_GET['cid'];
                            $cat_result = mysqli_query($conn, "SELECT * FROM category WHERE category_id = '$cat_id'");
                            if(mysqli_num_rows($cat_result)){
                                while($cat_row = mysqli_fetch_assoc($cat_result)){
                                    ?>
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold"><?php echo $cat_row['category_name']; ?></h4>
                            </div>
                            <?php 
                                }
                            }
                            ?>
                        </div>
                        <?php
                        

                        $result = mysqli_query($conn, "SELECT * FROM post
                        LEFT JOIN category ON post.post_category = category.category_id 
                        LEFT JOIN webmaster ON post.post_author = webmaster.id
                        WHERE post.post_category = '$cat_id' AND post.post_status = 'Active'
                        ORDER BY post.post_id DESC");
                        if(mysqli_num_rows($result)){
                           while($row = mysqli_fetch_assoc($result)){
                           ?>
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
                           <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                         <a class="text-text-decoration-none" style="color: black;" href="author.php?aid=<?php echo $row['post_author']; ?>">
                          <div class="d-flex align-items-center">
                          <small><?php echo $row['fname']; ?></small>
                         </div>
                     </a>
                     </div>
                            </div>
                        </div>
                        <?php 
                            }
                            }
                            ?>
                    </div>
                </div>
                
                <div class="col-lg-4">
                 <!-- Popular News Start -->
                    <div class="mb-3">
                        <?php 
                         $result = mysqli_query($conn, "SELECT * FROM post
                         LEFT JOIN category ON post.post_category = category.category_id 
                         WHERE post.post_status = 'Active'
                         ORDER BY post.post_id DESC LIMIT 3");
                         if(mysqli_num_rows($result)){
                        ?>
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">Recent News</h4>
                        </div>
                        <?php
                        while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <div class="bg-white border border-top-0 p-3">
                            <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                                <img class="img-thumbnai" src="./uploads/<?php echo $row['post_image']; ?>"  alt="" style="width: 120px;">
                                <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                                    <div class="mb-2">
                                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="category.php?cid=<?php echo $row['post_category']; ?>"><?php echo $row['category_name']; ?></a>
                                        <a class="text-body" href=""><small><?php echo $row['post_date']; ?></small></a>
                                    </div>
                                    <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="single.php?id=<?php echo $row['post_id'];?>"><?php echo substr($row['post_title'], 0, 45) . "..."; ?></a>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        }
                    ?>
                    </div>
                    <!-- Popular News End -->
                </div>
            </div>
        </div>
        <div>
    </div>
    </div>
    <!-- News With Sidebar End -->
    <?php include "./layout/footer.php"; ?>
