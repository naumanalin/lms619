<?php
include 'header.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_data'])) {
    header("location:index.php");
    exit();
}

?>

<div class="page-content">
    <div class="container">
        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<p class="error-message">' . $_SESSION['error_message'] . '</p>';
            unset($_SESSION['error_message']);
        }
        ?>
        <a href="addStd.php" class="logout-btn decoration-none">Add New</a>

        <!-- -------------------- --> <hr style="margin: 50px 0;"> <!-- --------------------------- -->
        <h3>List of all Students</h3>
        <table id="myTable">
            <thead>
                <th>S.no</th>
                <th>Name</th>
                <th>ID</th>
                <th>Email</th>
                <th>CNIC</th>
                <th>Image</th>
                <!-- <th>Password</th> -->
                <th>Year of ad.</th>
                <th>Operations</th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `Students`";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $counter = 1; // Start counter from 1
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$counter}</td>
                            <td>{$row['UserName']}</td>
                            <td>{$row['StudentID']}</td>
                            <td>{$row['Email']}</td>
                            <td>{$row['CNIC']}</td>
                            <td><img src=\"{$row['image']}\" alt=\"image\" width='100px'></td>
                            
                            <td>{$row['yoAdmission']}</td>
                            <td>
                            <a href=\"editstd.php?id={$row['StudentID']}\" class='logout-btn decoration-none'> Edit</a>
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


<!-- for password column

<td>{$row['Password']}</td>
-->