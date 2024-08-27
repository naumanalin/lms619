<?php
include 'header.php';

if (!isset($_SESSION['admin_data'])) {
    header("location:index.php");
    exit();
}


    $editStudentID = mysqli_real_escape_string($con, $_GET['id']);
    $editQuery = "SELECT * FROM Students WHERE StudentID = '$editStudentID'";
    $editResult = mysqli_query($con, $editQuery);

    if (mysqli_num_rows($editResult) > 0) {
        $editRow = mysqli_fetch_assoc($editResult);
    } else {
        $_SESSION['error_message'] = "Student with ID '$editStudentID' not found!";
        header("Location: home.php");
        exit();
    }


?>

<div class="page-content">
    <div class="container">
        <h3 class='mb-40'>Edit Student</h3>
        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<p class="success-message">' . $_SESSION['success_message'] . '</p>';
            unset($_SESSION['success_message']);
        }

        if (isset($_SESSION['error_message'])) {
            echo '<p class="error-message">' . $_SESSION['error_message'] . '</p>';
            unset($_SESSION['error_message']);
        }
        ?>
        <form action="" method="POST" class="addStdform" enctype="multipart/form-data">
            <div class="form-group">
                <label for="stdname">Student Name</label> <br>
                <input type="text" name="stdname" class="form-control" id="stdname" value="<?php echo $editRow['UserName']; ?>" required>
            </div>

            <div class="form-group">
                <label for="stdemail">Student Email</label> <br>
                <input type="email" name="stdemail" class="form-control" id="stdmail" value="<?php echo $editRow['Email']; ?>" required>
            </div>

            <div class="form-group">
                <label for="stdid">Student ID</label> <br>
                <input type="text" name="stdid" class="form-control" id="stdid" value="<?php echo $editRow['StudentID']; ?>" required readonly>
            </div>

            <div class="form-group">
                <label for="stdcnic">Student CNIC</label> <br>
                <input type="text" name="stdcnic" class="form-control" id="stdcnic" value="<?php echo $editRow['CNIC']; ?>" required
                    pattern="^[0-9]{5}-[0-9]{7}-[0-9]{1}$" title="Type CNIC like 34504-1234567-1" 
                    placeholder="34501-1234567-1">
            </div>

            <div class="form-group">
                <label for="stdfile">Image</label> <br>
                <input type="file" name="stdfile" class="form-control" id="stdfile"> <br>
                <img src="<?php echo $editRow['image']; ?>" alt="previous image" title="previous image" width="150px">
            </div>

            <div class="" style="width: 100vw;">
                <input type="submit" value="Update" name="updatestd" class="login-btn">
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php';
if (isset($_POST['updatestd'])) {
    $updatedName = mysqli_real_escape_string($con, $_POST['stdname']);
    $updatedEmail = mysqli_real_escape_string($con, $_POST['stdemail']);
    $updatedCnic = mysqli_real_escape_string($con, $_POST['stdcnic']);

    // File Upload Handling
    if ($_FILES['stdfile']['size'] > 0) {
        $uploadDirectory = "stdImages/";
        $uploadedFile = $_FILES['stdfile']['name'];
        $tempFile = $_FILES['stdfile']['tmp_name'];
        $fileDestination = $uploadDirectory . $uploadedFile;

        move_uploaded_file($tempFile, $fileDestination);

        $updateQuery = "UPDATE Students SET UserName = '$updatedName', Email = '$updatedEmail', CNIC = '$updatedCnic', image = '$fileDestination' WHERE StudentID = '$editStudentID'";
    } else {
        $updateQuery = "UPDATE Students SET UserName = '$updatedName', Email = '$updatedEmail', CNIC = '$updatedCnic' WHERE StudentID = '$editStudentID'";
    }

    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        echo "<script> alert(\"Student data updated successfully!\") </script>";
        // $_SESSION['success_message'] = "Student data updated successfully!";
        // header("Location: editstd.php?id=$editStudentID");
        // exit();
    } else {
        echo "<script> alert(\"Error updating student data\") </script>";
        // $_SESSION['error_message'] = "Error updating student data: " . mysqli_error($con);
        // header("Location: editstd.php?id=$editStudentID");
        // exit();
    }
}
?>

