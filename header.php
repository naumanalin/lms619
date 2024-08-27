<?php 
include 'config.php';
ob_start();
session_start();

if (!isset($_SESSION['user_data'])) {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS619</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>

<header class="flex">
    <!-- sidebar -->
    <div class="right-sidebar">
         <div id="burger">
            <img src="assets/images/burger.png" alt="menu">
         </div>
         <hr style="width: 95%; margin: 10px auto; ">

         <!-- menu list -->
         <div class="menu-list">
            <div class="menu-item"> <!-- 1.Home -->
                <a href="home.php">
                    <img src="assets/images/home.png" alt="image" class="menu-img">
                    <span class="menu-title">Home</span>
                </a>
            </div>

            <div class="menu-item"> <!-- 2.Courses -->
                <a href="course-selection.php">
                    <img src="assets/images/course.png" alt="image" class="menu-img">
                    <span class="menu-title">Courses</span>
                </a>
            </div>

            <div class="menu-item"> <!-- 3.Profile -->
                <a href="profile.php">
                    <img src="assets/images/profile.png" alt="image" class="menu-img">
                    <span class="menu-title">Profile</span>
                </a>
            </div>

            <div class="menu-item"> <!-- 4.Notes -->
                <a href="notes.php">
                    <img src="assets/images/notes.png" alt="image" class="menu-img">
                    <span class="menu-title">Notes</span>
                </a>
            </div>
            
            <div class="menu-item"> <!-- 5.Contact us -->
                <a href="contactus.php">
                    <img src="assets/images/contactus.png" alt="image" class="menu-img">
                    <span class="menu-title">Contact Us</span>
                </a>
            </div>
         </div>
    </div>
    <!-- nav bar -->
    <nav>
        <div class="container flex space-between">
            <div class="logobar flex center-center">
                <img src="./assets/images/logo.jpg" alt="lms logo" class="logo">
                <p>Learning Management System</p>
            </div>

            <div class="userbar flex gap-10 center-center">
                <div class="user-data">
                    <div><?php echo $_SESSION['user_data']['username']; ?></div>
                    <div><?php echo $_SESSION['user_data']['id']; ?></div>
                    <form action="" method="post">
                        <input type="hidden" name="userid" value="<?php ?>">
                        <input type="submit" name="logout" value="Logout" class="logout-btn">
                    </form>
                    <?php  // logout 
                        if(isset($_POST['logout'])) {
                            session_unset();
                            session_destroy();
                            header("location:index.php");
                            exit();
                        }
                    ?>
                    
                </div>
                <div class="usericon">
                        <img src="assets/images/user-solid.svg" alt="image">
                </div>
            </div>
        </div>
    </nav>
</header>
