<?php

   include 'components/connect.php';

   if(isset($_COOKIE['tutor_id'])){
      $users_id = $_COOKIE['tutor_id'];
   }else{
      $users_id = '';
      // header('location:login.php');
   }

if(isset($_POST['submit'])){

   $select_tutor = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
   $select_tutor->execute([$users_id]);
   $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);

   $prev_pass = $fetch_tutor['password'];
   $prev_image = $fetch_tutor['image'];

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
//    $profession = $_POST['profession'];
//    $profession = filter_var($profession, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   if(!empty($name)){
      $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $users_id]);
      $message[] = 'username updated successfully!';
   }

//    if(!empty($profession)){
//       $update_profession = $conn->prepare("UPDATE `tutors` SET profession = ? WHERE id = ?");
//       $update_profession->execute([$profession, $tutor_id]);
//       $message[] = 'profession updated successfully!';
//    }

   if(!empty($email)){
      $select_email = $conn->prepare("SELECT email FROM `users` WHERE id = ? AND email = ?");
      $select_email->execute([$users_id, $email]);
      if($select_email->rowCount() > 0){
         $message[] = 'email already taken!';
      }else{
         $update_email = $conn->prepare("UPDATE `tutors` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $users_id]);
         $message[] = 'email updated successfully!';
      }
   }

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = create_unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/'.$rename;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image size too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `users` SET `image` = ? WHERE id = ?");
         $update_image->execute([$rename, $users_id]);
         move_uploaded_file($image_tmp_name, $image_folder);
         if($prev_image != '' AND $prev_image != $rename){
            unlink('uploaded_files/'.$prev_image);
         }
         $message[] = 'image updated successfully!';
      }
   }

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['conf_pass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `tutors` SET password = ? WHERE id = ?");
            $update_pass->execute([$cpass, $users_id]);
            $message[] = 'password updated successfully!';
         }else{
            $message[] = 'please enter a new password!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>

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
                    <a href="profile.php" class="btn">View Profile</a>
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
                        <a href="Home.php"><i class="fas fa-home"></i><span>Home</span></a>
                        <a href="courses.php"><i class="fas fa-graduation-cap"></i><span>Classes</span></a>
                        <a href="tutors.php"><i class="fas fa-chalkboard-user"></i><span>Teachers</span></a>
                        <!-- <a href="About.php"><i class="fas fa-question"></i><span>About Us</span></a> -->
                    </nav>
                </div>

                <!-- side bar section end  -->

<!-- register section starts  -->

<section class="form-container" style="min-height: calc(100vh - 19rem);margin-bottom:10rem;margin:0;margin-left:-2.6rem">

   <form class="form-box" action="" method="post" enctype="multipart/form-data" style="margin-bottom: 10rem;padding-bottom:2rem">
      <h3>update profile</h3>
      <label for="name">username</label>
                        <input type="text" name="name" id="name" placeholder="<?= $fetch_profile['name']; ?>" maxlength="100" class="box"> 

                        <label for="email">your email</label>
                        <input type="email" name="email" id="email" placeholder="<?= $fetch_profile['email']; ?>" maxlength="100" class="box"> 

                        <label for="password">your password</label>
                        <input type="password" name="old_pass" id="password" placeholder="enter your old password" maxlength="50" class="box">
 
                        <label for="new_password">new password</label>
                        <input type="password" name="new_pass" id="new_password" placeholder="enter your new password" maxlength="50" class="box"> 

                        <label for="conf_password">confirm new password</label>
                        <input type="password" name="conf_pass" id="conf_password" placeholder="confirm your new password" maxlength="50" class="box"> 

                        <label for="image">update picture</label>
                        <input type="file" name="image" id="img" class="box"> 
                        <input type="submit" name="submit" value="update profile"  class="btn"> 



<!-- 
      <p>update pic :</p>
      <input type="file" name="image" accept="image/*"  class="box">
      <input type="submit" name="submit" value="update now" class="btn"> -->
   </form>

</section>

<!-- registe section ends -->










<?php include 'components/footer.php'; ?>

<script src="js/admin_script.js"></script>
   
</body>
</html>