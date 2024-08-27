<?php

    $con = mysqli_connect('localhost', 'root', '', 'lms619');

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }