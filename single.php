<?php include "./layout/master.php"; ?>

    <!-- News With Sidebar Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <?php 
                require "./assets/config/db.php";

                $post_id = $_GET['id'];
          
                $result11 = mysqli_query($conn, "SELECT post.post_date, post.post_id, post.post_title, post.post_category, post.post_slug, post.post_descp, post.post_category, post.post_image, category.category_id, category.category_name FROM post
                LEFT JOIN category ON post.post_category = category.category_id 
                LEFT JOIN webmaster ON post.post_author = webmaster.id WHERE post.post_id = '$post_id'");
                $postRow = mysqli_fetch_assoc($result11);
                ?>
                <div class="col-lg-8">
                    <!-- News Detail Start -->
                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100" src="./uploads/<?php echo $postRow ['post_image']; ?>" style="object-fit: cover;">
                        <div class="bg-white border border-top-0 p-4">
                            <div class="mb-3">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    href="category.php?cid=<?php echo $postRow['post_category']; ?>"><?php echo $postRow ['category_name']; ?></a>
                                <h6  class="text-body mt-3" href="#"><?php echo $postRow ['post_date']; ?></h6>
                            </div>
                            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold"><?php echo $postRow ['post_title'];?></h1>
                            <p><?php echo $postRow ['post_descp']; ?></p>
                        </div>
                    </div>
                    <!-- News Detail End -->
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
        </div>
    </div>
    <!-- News With Sidebar End -->

    <?php include "./layout/footer.php"; ?>