<?php
include 'config.php';
ob_start();
session_start();

if (isset($_SESSION['user_data'])) {
    header("location: home.php");
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

<div class="tl-50">
    <div class="flex">
        <div class="login-form">
            <div class="logo-wrapper">
                <img src="assets/images/logo.jpg" alt="image" class="loinlogo">
            </div>
            <form action="#" method="POST" class="loginform">
                <div class="form-group">
                    <label for="stdid">Student ID</label> <br>
                    <input type="text" name="studentid" class="form-control" id="stdid"
                    pattern="^[a-z]{2}[0-9]+$" title="Type student ID like bc123456789" required>
                </div>

                <div class="form-group">
                    <label for="pw">Password</label> <br>
                    <input type="password" name="password" class="form-control" id="pw" required>
                </div>

                <div class="form-group login-group">
                    <input type="submit" value="Login" name="loginbtn" class="login-btn">
                </div>
            </form>
            <?php
                if(isset($_POST['loginbtn'])) {
                    $id = mysqli_real_escape_string($con, $_POST['studentid']);
                    $password = mysqli_real_escape_string($con, sha1($_POST['password']));

                    $sql_login = "SELECT * FROM `Students` WHERE StudentID = '{$id}' AND Password = '{$password}'";
                    $query_login = mysqli_query($con, $sql_login);

                    $data = mysqli_num_rows($query_login);

                    if($data) {
                        $row = mysqli_fetch_assoc($query_login);
                        $user_data = array(
                            'id' => $row['StudentID'],
                            'username' => $row['UserName'],
                            'email' => $row['Email'],
                            'password' => $row['Password'],
                            'cnic' => $row['CNIC'],
                            'image' => $row['image'],
                        );
            
                        $_SESSION['user_data'] = $user_data;
                        
                        header("location: home.php");
                        exit(); 
                    } else {
                        echo '<p class="error-message">Invalid student ID or password. Please try again.</p>';
                    }
                }
            ?>
        </div>

        <div class="loginimage">
            <img src="assets/images/loginpageimage.png" alt="image">
        </div>
    </div>
</div>
</body>
</html>
