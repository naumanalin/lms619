<?php include 'header.php'; ?>

<div class="page-content">
    <div class="container">
    <span class="logout-btn" style="margin: 30px 0;">Add New Courses </span>

    <form action="" method="POST" style="margin: 40px 0 0 0;" >
            <div class="form-group"> <!-- Course code-->
                <label for="stdname">Course code</label> <br>
                <input type="text" name="coursecode" class="form-control" id="stdname" required>
            </div>

            <div class="form-group"> <!-- Course Name -->
                <label for="stdmail">Course Name</label> <br>
                <input type="text" name="coursename" class="form-control" id="stdmail" required>
            </div>

            <div class="form-group"> <!-- Description -->
                <label for="Description">Description</label> <br>
                <input type="text" name="Description" class="form-control" id="Description" required>
            </div>

            <div class="" style="width: 100vw;">
                <input type="submit" value="Add" name="addcourse" class="login-btn">
            </div>
    </form>

    <?php
       if (isset($_POST['addcourse'])) {
        $courseCode = mysqli_real_escape_string($con, $_POST['coursecode']);
        $courseName = mysqli_real_escape_string($con, $_POST['coursename']);
        $description = mysqli_real_escape_string($con, $_POST['Description']);

        $insertQuery = "INSERT INTO `Courses` (`CourseCode`, `CourseName`, `Description`) 
                    VALUES ('$courseCode', '$courseName', '$description')";

    $insertResult = mysqli_query($con, $insertQuery);

    if ($insertResult) {
        echo "<script> alert(\"Course added successfully!\") </script>";
         header("Location: courses.php");
        exit();
    } else {
        echo "<script> alert(\"Error adding course:!\") </script>";
    }
}
    ?>
    <!-- --------------------- --> <hr style="margin: 25px 0;"> <!-- ---------------------- -->
    <h3>List of all Courses</h3>
        <table id="myTable">
            <thead>
                <th>S.no</th>
                <th>Course code</th>
                <th>Course Name</th>
                <th>Description</th>
                <th>Operations</th>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM `Courses` ORDER BY `CourseID` DESC";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    $counter = 1; // Start counter from 1
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$counter}</td>
                            <td>{$row['CourseCode']}</td>
                            <td>{$row['CourseName']}</td>
                            <td>{$row['Description']}</td>
                            <td>
                            <a href=\"editcourse.php?id={$row['CourseID']}\" class='logout-btn decoration-none'> Edit</a>
                            </td>
                        </tr>";
                        $counter++;
                    }
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            ?>

            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
