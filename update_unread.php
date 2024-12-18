<?php
session_start();

require_once "connectDB.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $sql_reset_unread = "UPDATE appointments SET unread = 1 WHERE user_id = '" . $_SESSION['id'] . "' AND status IN (1, 2)";
    
    if (mysqli_query($link, $sql_reset_unread)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "not_logged_in";
}
?>
