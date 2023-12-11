<?php
session_start();
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: login.php?error=User Name is required");
        exit();
    } elseif (empty($pass)) {
        header("Location: login.php?error=Password is required");
        exit();
    } else {
        // Update the SQL query to use 'email' instead of 'user_name'
        $sql = "SELECT * FROM users WHERE email='$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            // Update the session variables to use 'email' and 'full_name' from registration
            $_SESSION['user_name'] = $row['email'];
            $_SESSION['name'] = $row['full_name'];
            $_SESSION['id'] = $row['id'];
            header("Location: home.php");
            exit();
        } else {
            header("Location: login.php?error=Incorrect Email or password");
            exit();
        }
    }
} else {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css\style1.css">
    <style>
        body {
             background-image: url('8L0A9954.jpg');
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            text-align: center;
        }

        .login-container {
             background: linear-gradient(135deg, #ff0000, #cc0000); 
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            margin-top: 100px;
        }

        h2 {
            color: #333;
            font-size: 24px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .error {
            color: red;
        }

        .login-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 15px;
            cursor: pointer;
        }
        
        @media screen and (max-width: 768px) {
    .login-container {
        width: 90%; /* Adjust width for smaller screens */
    }

    h2 {
        font-size: 20px;
    }

    .login-btn {
        font-size: 14px;
    }
}
        
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="your_login_script.php">
            <label for="uname">Username</label>
            <input type="text" id="uname" name="uname" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">' . $_GET['error'] . '</p>';
        }
        ?>
    </div>
</body>

</html>