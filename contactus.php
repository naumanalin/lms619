<?php include 'header.php'; ?>

<div class="page-content">
    <div class="container">
        <h2>Contact Us Form</h2>
        <form action="" method="post" onsubmit="return handleSubmit();">
            <div class="form-group">
                <label for="stdid">Subject</label> <br>
                <input type="text" name="subject" class="form-control" id="stdid" required>
            </div>
            <div class="form-group">
                <label for="messageid">Message</label> <br>
                <textarea name="message" id="messageid" style="width: 100%; height: 250px;" required></textarea>
            </div>
            <div class="form-group login-group">
                <input type="submit" value="Submit" name="messagebtn" class="login-btn">
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; 

if(isset($_POST['messagebtn'])) {
    $stdid = $_SESSION['user_data']['id'];
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    $sql = "INSERT INTO `message`(`studentid`, `subject`, `message`) 
    VALUES ('$stdid','$subject','$message')";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Message sent successfully!');</script>";
        header('location:contactus.php');
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}
?>

<script>
function handleSubmit() {
    return confirm('Are you sure you want to submit the form?');
}
</script>
