<?php
include 'header.php';
session_start();

if (!isset($_SESSION['user_data'])) {
    header("location:index.php");
    exit();
}

// Check if the courseID is set in the URL
if (!isset($_GET['courseID'])) {
    // Redirect to a page 
    header("location:home.php");
    exit();
}

$courseID = $_GET['courseID'];

// Fetch the course name based on the courseID
$sql_course_name = "SELECT CourseName FROM Courses WHERE CourseID = '$courseID'";
$run_query_course_name = mysqli_query($con, $sql_course_name);

// Check if the course exists
if (mysqli_num_rows($run_query_course_name) > 0) {
    $row = mysqli_fetch_assoc($run_query_course_name);
    $courseName = $row['CourseName'];

    // Fetch the assignments for the given course
    $sql_assignments = "SELECT * FROM Assignments WHERE CourseID = '$courseID' LIMIT 3";
    $run_query_assignments = mysqli_query($con, $sql_assignments);
} else {
    // Redirect to a page or display an error message as needed
    header("location:home.php");
    exit();
}
?>

<div class="page-content">
    <div class="container">
        <h2>Course Name: <?php echo $courseName; ?></h2>
        <table>
            <thead>
                <th>Sr.No</th>
                <th>Download File</th>
                <th>Submit</th>
                <th>Date of submission</th>
                <th>Status</th>
            </thead>
            <tbody>
                <?php
                $srNo = 1;
                while ($assignment = mysqli_fetch_assoc($run_query_assignments)) {
                    $assignmentID = $assignment['AssignmentID'];
                    $submissionDate = $assignment['SubmissionDate'];
                    $fileURL = $assignment['FileURL'];
                ?>
                    <tr>
                        <td><?php echo $srNo; ?></td>
                        <td><a href="<?php echo $fileURL; ?>" download>Download File</a></td>
                        <td>
                            <form action="submit_assignment.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="assignmentID" value="<?php echo $assignmentID; ?>">
                                <input type="file" name="assignmentFile" accept=".doc, .docx" required>
                                <button type="submit">Submit</button>
                            </form>
                        </td>
                        <td><?php echo $submissionDate; ?></td>
                        <td>Status</td>
                    </tr>
                <?php
                    $srNo++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
