<?php

   include 'components/connect.php';

   if(isset($_COOKIE['tutor_id'])){
      $users_id = $_COOKIE['tutor_id'];
   }else{
      $users_id = '';
      header('location:login.php');
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <!-- font awsome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- custom css file link -->
    <link rel="stylesheet" href="CSS/main_style.css">
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

                <a href="About.php" class="logo">Classmate</a>
                <!-- <a href="Home.html" class="logo" ><img src="/logo_trial (1).png" style="width: 110px;height: 70px;" alt=""></a> -->
                    
                <form action="" method="post" class="search-form"  style="background-color: #eee;">
                    <input type="text" name="search-box" placeholder="Search ...Classes" required maxlength="100">
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
                    <a href="Profile.html" class="btn">View Profile</a>
                    <div class="flex-btn">
                        <a href="components/user_logout.php" class="option-btn">Log Out</a>
                        <!-- <a href="register.html" class="option-btn" >Register</a> -->
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
                        <a href="Profile.php" class="btn">View Profile</a>
                    </div>

                    <nav class="navbar">
                        <a href="Home.php"><i class="fas fa-home"></i><span>Home</span></a>
                        <a href="Classes.php"><i class="fas fa-graduation-cap"></i><span>Classes</span></a>
                        <a href="Teachers.php"><i class="fas fa-chalkboard-user"></i><span>Teachers</span></a>
                        <!-- <a href="/Home.html"><i class="fas fa-headset"></i><span>ِContact Us</span></a> -->
                        <a href="About.php"><i class="fas fa-question"></i><span>About Us</span></a>
                    </nav>
                </div>

                <!-- side bar section end  -->

                <!-- about section starts -->

                <section class="about">
                    <div class="row">

                        <div class="image">
                            <img src="/undraw_learning_sketching_nd4f.svg" alt="">
                        </div>

                        <div class="content">
                            <h3>Why choose us?</h3>
                            <p>Text messaging, or texting, is the act of composing and sending electronic messages, typically consisting of alphabetic and numeric characters</p>
                            <a href="Classes.html" class="inline-btn">our Classes</a>
                        </div>

                    </div>

                    <div class="box-container">

                        <div class="box">
                            <i class="fas fa-graduation-cap" ></i>
                            <div>
                                <h3>+1k</h3>
                                <span>online classes</span>
                            </div>
                        </div>

                        <div class="box">
                            <i class="fas fa-user-graduate" ></i>
                            <div>
                                <h3>+25k</h3>
                                <span>students</span>
                            </div>
                        </div>

                        <div class="box">
                            <i class="fas fa-chalkboard-user" ></i>
                            <div>
                                <h3>+5k</h3>
                                <span>teachers</span>
                            </div>
                        </div>

                        <div class="box">
                            <i class="fas fa-briefcase" ></i>
                            <div>
                                <h3>100%</h3>
                                <span>study placement</span>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- about section ends -->

                <!-- review section starts -->

                <div class="review">

                    <h1 class="heading" style="margin-left: 3rem;margin-top: 5rem;">student's review</h1>
                    <div class="box-container">

                        <div class="box">
                            <p>Text messaging, or texting, is the act of composing and sending electronic messages, typically consisting of alphabetic and numeric characters</p>
                            <div class="user">
                                <img src="/pixlr-image-generator-b97e3421-b747-4acd-be71-1401c7db23bb.png" class="Pimg" alt="">
                                <h3>Aouameur Rabah</h3>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>

                        <div class="box">
                            <p>Text messaging, or texting, is the act of composing and sending electronic messages, typically consisting of alphabetic and numeric characters</p>
                            <div class="user">
                                <img src="/pixlr-image-generator-b97e3421-b747-4acd-be71-1401c7db23bb.png" class="Pimg" alt="">
                                <h3>Aouameur Rabah</h3>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>

                        <div class="box">
                            <p>Text messaging, or texting, is the act of composing and sending electronic messages, typically consisting of alphabetic and numeric characters</p>
                            <div class="user">
                                <img src="/logo_trial (1).png" class="Pimg" alt="">
                                <h3>Aouameur Rabah</h3>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>

                        <div class="box">
                            <p>Text messaging, or texting, is the act of composing and sending electronic messages, typically consisting of alphabetic and numeric characters</p>
                            <div class="user">
                                <img src="/pixlr-image-generator-b97e3421-b747-4acd-be71-1401c7db23bb.png" class="Pimg" alt="">
                                <h3>Aouameur Rabah</h3>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="box">
                            <p>Text messaging, or texting, is the act of composing and sending electronic messages, typically consisting of alphabetic and numeric characters</p>
                            <div class="user">
                                <img src="/pixlr-image-generator-b97e3421-b747-4acd-be71-1401c7db23bb.png" class="Pimg" alt="">
                                <h3>Aouameur Rabah</h3>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>  

                    </div>
                </div>

                <!-- review section ends -->

                <!-- footer section starts -->

                <footer class="footer">

                    &copy; copyright @ 2024 by <span>Rabah & Ahcen</span> | all rights reserved !

                </footer>

                <!-- footer section end -->

    <!-- custom js file link -->
    <script src="JS/script.js"></script>
</body>
</html>