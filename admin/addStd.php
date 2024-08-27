<?php
include 'header.php';

?>

<div class="page-content">
    <div class="container">
        <h3 class='mb-40'>Add New Student</h3>
        <?php
        session_start();
        if (isset($_SESSION['success_message'])) {
            echo '<p class="success-message">' . $_SESSION['success_message'] . '</p>';
            unset($_SESSION['success_message']);
        }

        if (isset($_SESSION['error_message'])) {
            echo '<p class="error-message">' . $_SESSION['error_message'] . '</p>';
            unset($_SESSION['error_message']);
        }
        ?>
        <form action="addStd.php" method="POST" class="addStdform" enctype="multipart/form-data">
            <div class="form-group"> <!-- Student Name -->
                <label for="stdname">Student Name</label> <br>
                <input type="text" name="stdname" class="form-control" id="stdname" required>
            </div>

            <div class="form-group"> <!-- Student Email -->
                <label for="stdmail">Student Email</label> <br>
                <input type="email" name="stdemail" class="form-control" id="stdmail" required>
            </div>

            <div class="form-group"> <!-- Student ID -->
                <label for="stdid">Student ID</label> <br> 
                <input type="text" name="stdid" class="form-control" id="stdid" required>
            </div>

            <div class="form-group"> <!-- CNIC-->
                <label for="stdcnic">Student CNIC</label> <br>
                <input type="text" name="stdcnic" class="form-control" id="stdcnic" required
                    pattern="^[0-9]{5}-[0-9]{7}-[0-9]{1}$" title="Type CNIC like 34504-1234567-1" 
                    placeholder="34501-1234567-1">
            </div>

            <div class="form-group"> <!-- Student Image -->
                <label for="stdfile">Image</label> <br>
                <input type="file" name="stdfile" class="form-control" id="stdfile" required>
            </div>

            <div class="form-group"> <!-- password -->
                <label for="pw">Create Password</label> <br>
                <input type="password" name="stdpw" class="form-control" id="pw" required>
            </div>

            <div class="" style="width: 100vw;">
                <input type="submit" value="Add" name="addstd" class="login-btn">
            </div>
        </form>
    </div>
</div>


<?php include 'footer.php';

if (isset($_POST['addstd'])) {
    $stdName = mysqli_real_escape_string($con, $_POST['stdname']);
    $studentID = mysqli_real_escape_string($con, $_POST['stdid']);
    $stdEmail = mysqli_real_escape_string($con, $_POST['stdemail']);
    $stdCnic = mysqli_real_escape_string($con, $_POST['stdcnic']);
    $stdpw = mysqli_real_escape_string($con, sha1($_POST['stdpw']));

    // File Upload Handling
    $uploadDirectory = "stdImages/"; // The directory to store uploaded images
    $uploadedFile = $_FILES['stdfile']['name'];
    $tempFile = $_FILES['stdfile']['tmp_name'];
    $fileDestination = $uploadDirectory . $uploadedFile;

    // Check if the student with the given ID already exists
    $checkQuery = "SELECT * FROM Students WHERE StudentID = '$studentID'";
    $result = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['error_message'] = "Student with ID '$studentID' already exists!";
        header("Location: home.php"); // Redirect to the same page
        exit();
    } else {
        move_uploaded_file($tempFile, $fileDestination);

        // Get the current year
        $currentYear = date('Y');

        $insertQuery = "INSERT INTO `Students`(`StudentID`, `UserName`, `Email`, `Password`, `CNIC`, `image`, `yoAdmission`) 
                        VALUES ('$studentID', '$stdName', '$stdEmail', '$stdpw', '$stdCnic', '$fileDestination', '$currentYear')";
        $insert = mysqli_query($con, $insertQuery);

        if ($insert) {
            session_start();
            $_SESSION['success_message'] = "Student added successfully!";
            header("Location: addStd.php"); // Redirect to the same page
            exit();
        } else {
            session_start();
            $_SESSION['error_message'] = "Error adding student: " . mysqli_error($con);
            header("Location: addStd.php"); // Redirect to the same page
            exit();
        }
    }
}

?>