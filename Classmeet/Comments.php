<?php

include 'components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   // header('location:login.php');
}

if(isset($_POST['delete_comment'])){

   $delete_id = $_POST['comment_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_comment = $conn->prepare("SELECT * FROM `comments` WHERE id = ?");
   $verify_comment->execute([$delete_id]);

   if($verify_comment->rowCount() > 0){
      $delete_comment = $conn->prepare("DELETE FROM `comments` WHERE id = ?");
      $delete_comment->execute([$delete_id]);
      $message[] = 'comment deleted successfully!';
   }else{
      $message[] = 'comment already deleted!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>comments</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/main_style.css">

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
                        <h3><?= $fetch_profile['name']; ?></h3>
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

<section class="comments" style="margin-top:-5rem;margin-left:-2.2rem;margin-bottom:20rem">

   <h1 class="heading">user comments</h1>

   
   <div class="show-comments">
      <?php
         $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
         $select_comments->execute([$_COOKIE['user_id']]);
         // echo $select_comments->rowCount();
         if($select_comments->rowCount() > 0){
            while($fetch_comment = $select_comments->fetch(PDO::FETCH_ASSOC)){
               $select_content = $conn->prepare("SELECT * FROM `content` WHERE id = ?");
               $select_content->execute([$fetch_comment['content_id']]);
               $fetch_content = $select_content->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="box" style="<?php if($fetch_comment['tutor_id'] == $tutor_id){echo 'order:-1;';} ?>">
         <div class="content">
            <span><?= $fetch_comment['date']; ?></span>
            <p> - <?= $fetch_content['title']; ?> - </p>
            <a href="view_content.php?get_id=<?= $fetch_content['id']; ?>" style="color:#8e44ad">view content</a>
         </div>
         <p class="text"><?= $fetch_comment['comment']; ?></p>
         <form action="" method="post">
            <input type="hidden" name="comment_id" value="<?= $fetch_comment['id']; ?>">
            <button type="submit" name="delete_comment" class="inline-delete-btn" onclick="return confirm('delete this comment?');" style="border:#8e44ad solid 2px;color:red;background:none;margin-bottom:4.5rem">delete comment</button>
         </form>
      </div>
      <?php
       }
      }else{
         echo '<p class="empty" style="color:red">no comments added yet!</p>';
      }
      ?>
      </div>
   
</section>














<?php include 'components/footer.php'; ?>

<script src="js/admin_script.js"></script>

</body>
</html>