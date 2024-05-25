<?php

   include 'components/connect.php';

   if(isset($_COOKIE['user_id'])){
      $users_id = $_COOKIE['user_id'];
   }else{
      $users_id = '';
    //   header('location:login.php');
   }

   $select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
   $select_playlists->execute([$users_id]);
   $total_playlists = $select_playlists->rowCount();

//    $select_contents = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ?");
//    $select_contents->execute([$_COOKIE['tutor_id']]);
//    $total_contents = $select_contents->rowCount();

   $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
   $select_likes->execute([$users_id]);
   $total_likes = $select_likes->rowCount();

   $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
   $select_comments->execute([$users_id]);
   $total_comments = $select_comments->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <!-- font awsome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- custom css file link -->
    <link rel="stylesheet" href="CSS/main_style.css">
</head>
<body>

                    <?php
                    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                    $select_profile->execute([$_COOKIE['user_id']]);
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                    ?>
    <!-- header section starts -->
        <header class="header">

            <section class="flex">

                <a href="profile.php" class="logo">Classmate</a>
                <!-- <a href="Home.html" class="logo" ><img src="/logo_trial (1).png" style="width: 110px;height: 70px;" alt=""></a> -->
                    
                <form action="search_classes.php" method="post" class="search-form"  style="background-color: #eee;">
                    <input type="text" name="search_classes" placeholder="search classes..." required maxlength="100">
                    <button type="submit" class="fas fa-search" name="search_box"></button>
                </form>

                <div class="icons">
                    <div id="menu-btn" class="fas fa-bars"></div>
                    <div id="search-btn" class="fas fa-search"></div>
                    <div id="user-btn" class="fas fa-user"></div>
                    <div id="toggle-btn" class="fas fa-sun"></div>
                </div>

                <div class="profile">
                    <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
                    <h3><?= $fetch_profile['name']; ?></h3>
                    <span>Studnet</span>
                    <a href="update.php" class="btn">update Profile</a>
                    <div class="flex-btn">
                        <a href="components/user_logout.php" class="option-btn">Log Out</a>
                        <!-- <a href="/register.html" class="option-btn" >Register</a> -->
                    </div>
                </div>

            
            </section>
        </header>
        
    <!-- header section end -->


                <!-- side bar section starts  -->

                <div class="side-bar">

                    <div class="close-side-bar">
                        <i class="fas fa-times"></i>
                    </div>

                    <div class="profile">
                        <img  src="uploaded_files/<?= $fetch_profile['image']; ?>"  alt="">
                        <h3> <?= $fetch_profile['name']; ?></h3>

                        <span>Student</span>
                        <a href="Profile.php" class="btn">View Profile</a>
                    </div>

                    <nav class="navbar">
                        <a href="Home.php"><i class="fas fa-home"></i><span>home</span></a>
                        <a href="classes.php"><i class="fas fa-graduation-cap"></i><span>classes</span></a>
                        <a href="tutors.php"><i class="fas fa-chalkboard-user"></i><span>tutors</span></a>
                        <!-- <a href="About.php"><i class="fas fa-question"></i><span>About Us</span></a> -->
                    </nav>
                </div>

                <!-- side bar section end  -->


                <!-- profile section starts -->

                <div class="Profile">

                    <h1 class="heading">profile details</h1>

                    

                    <div class="details">
                        <div class="user">
                            <img src="uploaded_files/<?= $fetch_profile['image']; ?>"  alt="">
                            <h3><?= $fetch_profile['name']; ?></h3>
                            <p>Student</p>
                            <a href="update.php" class="inline-btn" >update profile</a>
                        </div>
                        
                        <div class="box-container">
                            
                            <div class="box">
                                <div class="flex">
                                    <i class="fas fa-bookmark"></i>
                                    <div>
                                        <h3><?= $total_playlists; ?></h3>
                                        <span>saved playlist</span>
                                </div>
                            </div>
                            <a href="Playlist.php" class="inline-btn">view playlist</a>
                        </div>
                        
                        <div class="box">
                            <div class="flex">
                                <i class="fas fa-heart"></i>
                                <div>
                                    <h3><?= $total_likes; ?></h3>
                                    <span>liked</span>
                                </div>
                            </div>
                            <a href="likes.php" class="inline-btn">view liked</a>
                        </div>
                        
                        <div class="box">
                            <div class="flex">
                                <i class="fas fa-comment"></i>
                                <div>
                                    <h3><?= $total_comments; ?></h3>
                                    <span>comments</span>
                                </div>
                            </div>
                            <a href="comments.php" class="inline-btn">view comments</a>
                        </div>
                    </div>
                        
                    </div>
                </div>
                
                <!-- profile section ends -->

                <!-- footer section starts -->

                <footer class="footer" style="position: fixed;bottom:0">

                    &copy; copyright @ 2024 by <span>Rabah & Ahcen</span> | all rights reserved !

                </footer>

                <!-- footer section end -->

    <!-- custom js file link -->
    <script src="JS/script.js"></script>
</body>
</html>