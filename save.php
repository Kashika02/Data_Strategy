<?php
session_start();
include "db_conn.php"; // Include your database connection script

if (isset($_POST['distance']) && isset($_SESSION['user_name'])) {
    $distance = $_POST['distance'];
    $username = $_SESSION['user_name'];

    // Update the distance value for the logged-in user
    $sql = "UPDATE users SET distance = ? WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

    if ($prepareStmt) {
        mysqli_stmt_bind_param($stmt, "ds", $distance, $username); // Use "d" for a double/float value
        mysqli_stmt_execute($stmt);
        echo "success"; // Send a success response back to the JavaScript
    } else {
        echo "error"; // Send an error response back to the JavaScript
    }
}
?>
