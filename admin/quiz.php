<?php include 'header.php'; ?>

<div class="page-content">
    <div class="container">
        <h2>Student Queries</h2>
        <table id="myTable">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Corrected SQL query with JOIN
                $sql = "SELECT message.messageid, message.studentid, Students.UserName, message.subject, message.message 
                        FROM `message` 
                        JOIN `Students` ON message.studentid = Students.StudentID";
                
                $result = mysqli_query($con, $sql);
                
                // Check if the query was successful
                if ($result && mysqli_num_rows($result) > 0) {
                    $counter = 1; 
                    // Fetch and display each row of results
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $counter++ ?></td>
                            <td><?= $row['studentid'] ?></td>
                            <td><?= $row['UserName'] ?></td>
                            <td><?= $row['subject'] ?></td>
                            <td><?= $row['message'] ?></td>
                        </tr>
                    <?php } // endwhile
                } else { ?>
                    <tr>
                        <td colspan="5">No queries found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
