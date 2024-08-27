<?php
include 'header.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_data'])) {
    header("location:index.php");
    exit();
}

// Fetch the courses
$sql_courses = "SELECT * FROM `Courses`";
$run_query_course = mysqli_query($con, $sql_courses);

// Fetch the student's selected courses
$studentID = $_SESSION['user_data']['id'];
$sql_selected_courses = "SELECT CourseID FROM `StudentCourses` WHERE `StudentID` = '$studentID'";
$run_query_selected_courses = mysqli_query($con, $sql_selected_courses);

// Store selected course IDs in an array
$selected_course_ids = array();
while ($selected_row = mysqli_fetch_assoc($run_query_selected_courses)) {
    $selected_course_ids[] = $selected_row['CourseID'];
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the selected_courses array is set
    if (isset($_POST['selected_courses']) && is_array($_POST['selected_courses'])) {
        // Clear previous selections for the current student
        $clear_previous_selection = "DELETE FROM `StudentCourses` WHERE `StudentID` = '$studentID'";
        mysqli_query($con, $clear_previous_selection);

        // Insert the new selections into the StudentCourses table
        foreach ($_POST['selected_courses'] as $courseID) {
            $insert_selection_query = "INSERT INTO `StudentCourses` (`StudentID`, `CourseID`) 
                                       VALUES ('$studentID', '$courseID')";
            mysqli_query($con, $insert_selection_query);
        }

        // Redirect to home.php or any other page after selection
        header("location: course-selection.php");
        exit();
    }
}
?>

<div class="page-content">
    <div class="container">
        <h2>Courses Selection</h2>

        <div class="course-selection">
            <form action="course-selection.php" method="post" onsubmit="return confirm('Are you sure you want to select this course?');">
                <?php
                while ($row = mysqli_fetch_assoc($run_query_course)) {
                    $courseID = $row['CourseID'];
                    $courseName = $row['CourseName'];
                    $isChecked = in_array($courseID, $selected_course_ids) ? 'checked' : '';
                ?>
                    <label>
                        <input type="checkbox" name="selected_courses[]" value="<?php echo $courseID; ?>" <?php echo $isChecked; ?>>
                        <?php echo $courseName; ?>
                    </label><br>
                <?php
                }
                ?>
                <button type="submit" class="logout-btn"><h2>Submit</h2></button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
