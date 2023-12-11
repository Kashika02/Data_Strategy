<?php
session_start();
include "db_conn.php"; // Include your database connection script

// Assuming you have a database connection established

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['profit']) && isset($_SESSION['user_name'])) {
    // Sanitize the input (you might want to use prepared statements for security)
    $profit = $_POST['profit'];
    $username = $_SESSION['user_name'];

    // Insert the quarter number into your database
    // Adjust the SQL query based on your database structure
    $sql = "UPDATE users SET profit = ? WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

    if ($prepareStmt) {
        mysqli_stmt_bind_param($stmt, "ss", $profit, $username); // Use "s" for a string value
        mysqli_stmt_execute($stmt);
        echo "success"; // Send a success response back to the JavaScript
    } else {
        echo "error"; // Send an error response back to the JavaScript
    }
}
?>
