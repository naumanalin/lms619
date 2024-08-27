<?php
include 'header.php';
session_start();

// Check if the user is logged in !
if (!isset($_SESSION['user_data'])) {
    header("location:index.php");
    exit();
}

// Fetch the selected courses for the logged-in student
$studentID = $_SESSION['user_data']['id'];
$sql_selected_courses = "SELECT Courses.CourseID, Courses.CourseName
                         FROM StudentCourses
                         JOIN Courses ON StudentCourses.CourseID = Courses.CourseID
                         WHERE StudentCourses.StudentID = '$studentID'";
$run_query_selected_courses = mysqli_query($con, $sql_selected_courses);
?>

<div class="page-content">
    <div class="container">
        <h2>My Courses (<?php echo date("Y"); ?>)</h2>

        <div class="all-courses">

            <?php
            // Check if the student has selected any courses
            if (mysqli_num_rows($run_query_selected_courses) > 0) {
                while ($row = mysqli_fetch_assoc($run_query_selected_courses)) {
                    $courseID = $row['CourseID'];
                    $courseName = $row['CourseName'];
            ?>

            <div class="course-item">
                <!-- course head -->
                <div class="course-head flex">
                    <h3><?php echo $courseName; ?></h3>
                    <a href="#"><img src="assets/images/course_head.png" alt="" class="chead-icon"></a>
                </div>
                <!-- course body -->
                <div class="course-body flex">
                    <a href="assignments.php?courseID=<?php echo $courseID; ?>">
                        <img src="assets/images/assignment.png" alt="" class="cbody-icon"> <br> &nbsp;
                        Assignments &nbsp;
                    </a>
                    <a href="quiz.php?courseID=<?php echo $courseID; ?>">
                        <img src="assets/images/quiz.png" alt="" class="cbody-icon"> <br> &nbsp; &nbsp;
                        Quiz &nbsp; &nbsp;
                    </a>
                    <a href="#">
                        <img src="assets/images/studymaterial.png" alt="" class="cbody-icon"> <br>
                        Study Material
                    </a>
                </div>
            </div>

            <?php
                }
            } else {
                echo "<p>No courses selected. Please go to the <a href='course-selection.php'>course selection page</a>.</p>";
            }
            ?>

        </div><!-- end all courses -->
    </div>
</div>

<?php include 'footer.php'; ?>
