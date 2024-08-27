<?php
include 'config.php'; // Include your database configuration file
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_data'])) {
    header("location:index.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the required fields are set
    if (isset($_POST['assignmentID']) && isset($_FILES['assignmentFile'])) {
        $assignmentID = $_POST['assignmentID'];
        $studentID = $_SESSION['user_data']['id'];
        
        // Define the upload directory
        $uploadDir = 'uploads/';

        // Check if the file is a valid .doc file
        $allowedExtensions = ['doc'];
        $fileExtension = pathinfo($_FILES['assignmentFile']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            // Handle invalid file type error as needed
            echo 'Invalid file type. Please submit a .doc file.';
            exit();
        }

        // Generate a unique filename
        $fileName = uniqid('assignment_' . $studentID . '_', true) . '.' . $fileExtension;
        
        // Set the file path
        $filePath = $uploadDir . $fileName;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['assignmentFile']['tmp_name'], $filePath)) {
            // Update the database with the file URL
            $updateAssignmentQuery = "UPDATE Assignments SET FileURL = '$filePath' WHERE AssignmentID = '$assignmentID'";
            mysqli_query($con, $updateAssignmentQuery);

            // Redirect to a success page or back to assignments.php
            header("location: assignments.php?courseID={$courseID}");
            exit();
        } else {
            // Handle file upload failure as needed
            echo 'File upload failed. Please try again.';
        }
    } else {
        // Handle missing fields error as needed
        echo 'Invalid form submission.';
    }
} else {
    // Redirect to the home page if accessed directly
    header("location: home.php");
    exit();
}
?>
