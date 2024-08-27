=<?php
include 'header.php';

if (!isset($_SESSION['admin_data'])) {
    header("location:index.php");
    exit();
}


    $editCourseID = mysqli_real_escape_string($con, $_GET['id']);
    $editQuery = "SELECT * FROM Courses WHERE CourseID = '$editCourseID'";
    $editResult = mysqli_query($con, $editQuery);

    if (mysqli_num_rows($editResult) > 0) {
        $editRow = mysqli_fetch_assoc($editResult);
    } else {
        $_SESSION['error_message'] = "Course with ID '$editCourseID' not found!";
        header("Location: courses.php");
        exit();
    }

?>

<div class="page-content">
    <div class="container">
        <h3 class='mb-40'>Edit Course</h3>
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
        <form action="editcourse.php?id=<?php echo $editCourseID; ?>" method="POST" class="addStdform" enctype="multipart/form-data">
            <div class="form-group">
                <label for="coursecode">Course Code</label> <br>
                <input type="text" name="coursecode" class="form-control" id="coursecode" value="<?php echo $editRow['CourseCode']; ?>" required>
            </div>

            <div class="form-group">
                <label for="coursename">Course Name</label> <br>
                <input type="text" name="coursename" class="form-control" id="coursename" value="<?php echo $editRow['CourseName']; ?>" required>
            </div>

            <div class="form-group">
                <label for="Description">Description</label> <br>
                <input type="text" name="Description" class="form-control" id="Description" value="<?php echo $editRow['Description']; ?>" required>
            </div>

            <div style="width: 100vw;">
                <input type="submit" value="Update" name="updatecourse" class="login-btn">
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php';

if (isset($_POST['updatecourse'])) {
    $updatedCode = mysqli_real_escape_string($con, $_POST['coursecode']);
    $updatedName = mysqli_real_escape_string($con, $_POST['coursename']);
    $updatedDescription = mysqli_real_escape_string($con, $_POST['Description']);

    $updateQuery = "UPDATE Courses SET CourseCode = '$updatedCode', CourseName = '$updatedName', Description = '$updatedDescription' WHERE CourseID = '$editCourseID'";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        $_SESSION['success_message'] = "Course data updated successfully!";
        header("Location: editcourse.php?id=$editCourseID");
        exit();
    } else {
        $_SESSION['error_message'] = "Error updating course data: " . mysqli_error($con);
        header("Location: editcourse.php?id=$editCourseID");
        exit();
    }
}
?>
