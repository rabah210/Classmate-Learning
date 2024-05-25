<?php

include 'components/connect.php';


if(isset($_COOKIE['user_id'])){
   $users_id = $_COOKIE['user_id'];
}else{
   $users_id = '';
   // header('location:home.php');
}

if(isset($_POST['remove'])){

   if($users_id != ''){
      $content_id = $_POST['content_id'];
      $content_id = filter_var($content_id, FILTER_SANITIZE_STRING);

      $verify_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND content_id = ?");
      $verify_likes->execute([$users_id, $content_id]);

      if($verify_likes->rowCount() > 0){
         $remove_likes = $conn->prepare("DELETE FROM `likes` WHERE user_id = ? AND content_id = ?");
         $remove_likes->execute([$users_id, $content_id]);
         $message[] = 'removed from likes!';
      }
   }else{
      $message[] = 'please login first!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>liked videos</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/main_style.css">

</head>
<body>

<?php
                    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                    $select_profile->execute([$users_id]);
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                    ?>
    <!-- header section starts -->
        <header class="header">

            <section class="flex">

                <a href="likes.php" class="logo">Classmate</a>
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
                    <span>Student</span>
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
                        <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
                        <h3><?= $fetch_profile['name']; ?></h3>
                        <span>Student</span>
                        <a href="/Profile.php" class="btn">View Profile</a>
                    </div>

                    <nav class="navbar">
                        <a href="Home.php"><i class="fas fa-home"></i><span>home</span></a>
                        <a href="classes.php"><i class="fas fa-graduation-cap"></i><span>classes</span></a>
                        <a href="tutors.php"><i class="fas fa-chalkboard-user"></i><span>tutors</span></a>
                        <!-- <a href="/Home.html"><i class="fas fa-headset"></i><span>ِContact Us</span></a> -->
                        <!-- <a href="About.php"><i class="fas fa-question"></i><span>About Us</span></a> -->
                    </nav>
                </div>

                <!-- side bar section end  -->

<!-- courses section starts  -->

<section class="liked-videos">

   <h1 class="heading">liked videos</h1>

   <div class="box-container">

   <?php
      $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
      $select_likes->execute([$users_id]);
      if($select_likes->rowCount() > 0){
         while($fetch_likes = $select_likes->fetch(PDO::FETCH_ASSOC)){

            $select_contents = $conn->prepare("SELECT * FROM `content` WHERE id = ? ORDER BY date DESC");
            $select_contents->execute([$fetch_likes['content_id']]);

            if($select_contents->rowCount() > 0){
               while($fetch_contents = $select_contents->fetch(PDO::FETCH_ASSOC)){

               $select_tutors = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
               $select_tutors->execute([$fetch_contents['tutor_id']]);
               $fetch_tutor = $select_tutors->fetch(PDO::FETCH_ASSOC);
   ?>
   <div class="box">
      <div class="tutor">
         <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
         <div>
            <h3><?= $fetch_tutor['name']; ?></h3>
            <span><?= $fetch_contents['date']; ?></span>
         </div>
      </div>
      <img src="uploaded_files/<?= $fetch_contents['thumb']; ?>" alt="" class="thumb">
      <h3 class="title"><?= $fetch_contents['title']; ?></h3>
      <form action="" method="post" class="flex-btn">
         <input type="hidden" name="content_id" value="<?= $fetch_contents['id']; ?>">
         <a href="watch-video.php?get_id=<?= $fetch_contents['id']; ?>" class="inline-btn">watch video</a>
         <input type="submit" value="remove" class="inline-delete-btn" name="remove" style="border: #8e44ad solid 2px;color:red;background:none">
      </form>
   </div>
   <?php
            }
         }else{
            echo '<p class="emtpy">content was not found!</p>';         
         }
      }
   }else{
      echo '<p class="empty">nothing added to likes yet!</p>';
   }
   ?>

   </div>

</section>










<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>