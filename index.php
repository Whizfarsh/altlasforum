<?php include_once "includes/header.php" ?>
<?php include_once "includes/db.php" ?>
    <body style="background-color: #e6e6fa;">
<nav class="navbar navbar-light navbar-expand" style="height: 80px;background-color: #eb5d23;"><a class="navbar-brand text-center"><img class="img-fluid mx-auto d-block" src="assets/img/atlas200w.png" style="width: 200px;height: 88px;margin-top: -15%;"></a>
</nav>
<div class="container">
    <div class="text-center scroll menu overflow-auto" style="padding-right: 10px;background-color: rgba(249,224,224,0);margin-top: 30px;padding-left: 10px;padding-bottom: 10PX;padding-top: 10PX;margin-bottom: 50px;"><a href="../index.php" class="hmkey"><strong>HOME&nbsp;</strong></a><a href="register.php" class="hmkey"><strong>REGISTER</strong></a><a href="login.php" class="hmkey"><strong>LOGIN</strong></a>
        <a
                href="#" class="hmkey"><strong>HOW ATLAS FORUM WORKS</strong></a><a href="#" class="hmkey"><strong>GET COUPON</strong></a><a href="#" class="hmkey"><strong>SUPPORT</strong></a>
        <a
                href="#" class="hmkey"><strong>FAQ</strong></a>
    </div>
</div>
    <div class="container">
        <div class="text-center adsbig"><img src="assets/img/970.jpg"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="side sida" style="background-color: #ffffff;height: 100px;">
                    <p>adscode here</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="spacer" style="height: 100%;background-color: #ffffff;margin-top: 15px;">
                    <article class="hentry post">
                        <?php


                        if(isset($_GET['page'])){
                            $page = $_GET['page'];
                        }else{
                            $page = "1";
                        }

                        if($page == "" || $page ==1){

                            $page_1 = 0;
                        } else {
                            $page_1 = ($page * 5);
                        }
                        //
                        $post_count_query = "SELECT * FROM wp_posts WHERE `post_status` = 'publish'";
                        $find_count = mysqli_query($connection, $post_count_query);
                        $count = mysqli_num_rows($find_count);
                        $count = ceil($count / 20);


                        //                            $dbcheckr = "update wp_posts set post_title=replace(post_title,' - ','-')";
                        //                            $rcheck = mysqli_query($connection, $dbcheckr);

                        $query = "SELECT * FROM wp_posts WHERE `post_status` = 'publish' LIMIT $page_1, 15";
                        $sposts = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($sposts)){
                            $post_id = $row['ID'];
                            $post_title = $row['post_title'];
                            $post_title = str_replace("", "", $post_title);
//                                $sspost = str_replace("'", '', $post_title);
//                            $posttitle = mysqli_set_charset($post_title, 'utf8');
                            $post_author = $row['post_author'];
                            $post_name = $row['post_name'];
                            $post_status = $row['post_status'];
                            ?>

                            <div class="post__author author vcard inline-items">
                                <div class="text-left author-date"><a href="./p?id=<?php echo $post_id ?>" style="color: #eb5d23;"><strong><span style="text-decoration: none;"><?php echo $post_title ?></span></strong></a><br>
                                    <!--                                    <span style="color: black; font-size: 10px;">posted by <b style="font-size: 13px;">ADMIN</b></span>-->

                                </div>

                            </div><hr>
                        <?php } ?>
                        <div class="container">
                            <ul class="pagination">
                                <?php

                                for($i =1; $i <= $count; $i++){

//                                    echo "<li class='page-item'><a class='page-link' href='?page={$i}'>{$i}</a> </li>";

                                }
                                echo "<li><a href='?page=".($page+1)."' class='btn' style='background-color: #eb5d23;'>NEXT</a></li>";

                                ?>
                            </ul>
                        </div>

                    </article>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="side sida" style="background-color: #ffffff;height: 100px;">
                    <p>adscode here</p>
                </div>
            </div>
        </div>
    </div>
<?php include_once "includes/footer.php" ?>