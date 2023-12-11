<?php
session_start();
include "db_conn.php";

if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

// Query to retrieve usernames, distances, and quarters
$sql = "SELECT email, distance, quarter,profit FROM users"; // Update 'username' to 'email' if needed

$result = mysqli_query($conn, $sql);

if ($result) {
    $userData = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $username = $row['email']; // Update to 'email'
        $distance = $row['distance'];
        $quarter = $row['quarter'];
        $profit = $row['profit'];
        $userData[] = array('username' => $username, 'distance' => $distance, 'quarter' => $quarter, 'profit' => $profit);
    }

    // Output the data in HTML
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Game Insights</title>
        <style>
            body {
                background-color: #f0f0f0;
                background-image: url('8L0A6440.jpg');
                font-family: Arial, sans-serif;
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100vh;
            }

            h1 {
                font-size: 24px;
            }

            table {
                margin: 20px auto;
                border-collapse: collapse;
                width: 80%;
                max-width: 800px;
            }

            th, td {
                padding: 10px;
            }

            th {
                background-color: #3498db;
                color: #ecf0f1;
            }

            td {
                background-color: #34495e;
                color: white;
            }

            tr:nth-child(odd) td {
                background-color: #2c3e50;
            }
        </style>
    </head>
    <body>
        <h1>Game Insights</h1>
        <table border='1'>
            <tr>
                <th>Username</th>
                <th>Distance</th>
                <th>Quarter</th>
                <th>Profit</th>
            </tr>";

    foreach ($userData as $data) {
        echo "<tr>
                <td>{$data['username']}</td>
                <td>{$data['distance']}</td>
                <td>{$data['quarter']}</td>
                 <td>{$data['profit']}</td>
            </tr>";
    }

    echo "</table></body></html>";

} else {
    echo "Error fetching data from the database: " . mysqli_error($conn);
}
?>
