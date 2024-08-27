<?php include 'header.php'; ?>

<div class="page-content">
    <div class="container">
    <div class="profile">

    <fieldset class="flex ">
        <legend>Profile</legend>
        <div class="profile-left">
            <img src="admin/<?php echo $_SESSION['user_data']['image'];  ?>" alt="img" class="second-profile-img">
            <!-- style="
    border-radius: 50%;
    padding: 10px;
" -->
        </div>
        <div class="profile-right">
            <div class="detail-group">
                <span class="fb">User Name:</span>
                <span><?php echo $_SESSION['user_data']['username'];  ?></span>
            </div>

            <div class="detail-group">
                <span class="fb">User Email:</span>
                <span><?php echo $_SESSION['user_data']['email']; ?></span>
            </div>

            <div class="detail-group">
                <span class="fb">Registered CNIC:</span>
                <span><?php echo $_SESSION['user_data']['cnic']; ?></span>
            </div>

        </div>

    </fieldset>

    </div>
    </div>
</div>

<?php include 'footer.php'; ?>
