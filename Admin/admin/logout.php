<?php
// logout.php

// Perform logout actions (e.g., destroying session)
session_start();
session_destroy();

// Redirect to login page or any other appropriate page
header("Location: login-admin.php");
exit;
?>
