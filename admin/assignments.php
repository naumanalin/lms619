<?php
include 'header.php';

if (!isset($_SESSION['admin_data'])) {
    header("location:index.php");
    exit();
}

if (isset($_POST['uploadAssignment'])) {
    $courseID = mysqli_real_escape_string($con, $_POST['courseID']);
    $submissionDate = mysqli_real_escape_string($con, $_POST['submissionDate']);

    // File Upload Handling
    if ($_FILES['assignmentFile']['size'] > 0) {
        $allowedExtensions = array("doc", "docx");
        $fileExtension = pathinfo($_FILES['assignmentFile']['name'], PATHINFO_EXTENSION);

        if (in_array(strtolower($fileExtension), $allowedExtensions)) {
            $uploadDirectory = "uploads/";
            $uploadedFile = $_FILES['assignmentFile']['name'];
            $tempFile = $_FILES['assignmentFile']['tmp_name'];
            $fileDestination = $uploadDirectory . "assignment_" . time() . "_" . uniqid() . "." . $fileExtension;

            move_uploaded_file($tempFile, $fileDestination);

            $insertQuery = "INSERT INTO `Assignments` (`CourseID`, `SubmissionDate`, `FileURL`) 
                            VALUES ('$courseID', '$submissionDate', '$fileDestination')";

            $insertResult = mysqli_query($con, $insertQuery);

            if ($insertResult) {
                echo "<script>alert('Assignment uploaded successfully!')</script>";
                // $_SESSION['success_message'] = "Assignment uploaded successfully!";
                header("Location: assignments.php");
                exit();
            } else {
                $_SESSION['error_message'] = "Error uploading assignment: " . mysqli_error($con);
            }
        } else {
            echo "<script>alert('Invalid file type. Please upload only .doc or .docx files.')</script>";
            // $_SESSION['error_message'] = "Invalid file type. Please upload only .doc or .docx files.";
        }
    } else {
        echo "<script>alert('Please select a file to upload.')</script>";
        // $_SESSION['error_message'] = "Please select a file to upload.";
    }
}

$coursesQuery = "SELECT * FROM `Courses`";
$coursesResult = mysqli_query($con, $coursesQuery);

?>

<div class="page-content">
    <div class="container">
        <h2>Upload Assignments</h2>

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

        <form action="" method="POST" class="upload-assignment-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="courseID">Select Course</label> <br>
                <select name="courseID" id="courseID" class="admin-ass-fields" required>
                    <?php
                    while ($course = mysqli_fetch_assoc($coursesResult)) {
                        echo "<option value='{$course['CourseID']}'>{$course['CourseName']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="submissionDate">Submission Date</label> <br>
                <input type="datetime-local" name="submissionDate" class="admin-ass-fields" required>
            </div>

            <div class="form-group">
                <label for="assignmentFile">Upload Assignment (.doc/.docx)</label> <br>
                <input type="file" name="assignmentFile" accept=".doc, .docx" class="admin-ass-fields" required>
            </div>

            <div>
                <input type="submit" value="Upload Assignment" name="uploadAssignment" class="login-btn">
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
