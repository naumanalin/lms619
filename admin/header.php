<?php 
include 'config.php';
ob_start();
session_start();

if (!isset($_SESSION['admin_data'])) {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

    <!-- data table  -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../assets/table/jquery.dataTables.min.js"></script>
    <link href="../assets/table/jquery.dataTables.min.css" rel="stylesheet" >
    <script>
        $(document).ready(function(){
            $("#myTable").dataTable();
        });
    </script>
</head>

<body>

<header class="flex">
    <!-- sidebar -->
    <div class="right-sidebar">
         <div id="burger">
            <img src="../assets/images/burger.png" alt="menu">
         </div>
         <hr style="width: 95%; margin: 10px auto; ">

         <!-- menu list -->
         <div class="menu-list">
            <div class="menu-item"> <!-- 1.Students -->
                <a href="home.php">
                    <span class="menu-title">Manage Students</span>
                </a>
            </div>

            <div class="menu-item"> <!-- 2.Add Courses -->
                <a href="courses.php">
                    <span class="menu-title">Add Courses</span>
                </a>
            </div>

            <div class="menu-item"> <!-- 4.Quizes -->
                <a href="quiz.php">
                    <span class="menu-title">Std Quires</span>
                </a>
            </div>

            <div class="menu-item"> <!-- 3.Assignments -->
                <a href="assignments.php">
                    <span class="menu-title">Assignments</span>
                </a>
            </div>
           
         </div>
    </div>
    <!-- nav bar -->
    <nav>
        <div class="container flex space-between">
            <div class="logobar flex center-center">
                <p>Learning Management System</p>
            </div>

            <div class="userbar flex gap-10 center-center">
                <div class="user-data">
                    <div><?php echo $_SESSION['admin_data']['username']; ?></div>
                    <div><?php echo $_SESSION['admin_data']['id']; ?></div>
                    <form action="" method="post">
                        <input type="hidden" name="userid" value="<?php ?>">
                        <input type="submit" name="logout" value="Logout" class="logout-btn">
                    </form>
                    <?php
                        if(isset($_POST['logout'])) {
                            session_unset();
                            session_destroy();
                            header("location:index.php");
                            exit();
                        }
                    ?>
                    
                </div>
                <div class="usericon">
                        <img src="../assets/images/user-solid.svg" alt="image">
                </div>
            </div>
        </div>
    </nav>
</header>
