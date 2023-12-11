<?php
session_start();
if (isset($_SESSION["users"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
      body {
            background-image: url('8L0A9398-HDR.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0); /* Adjust the alpha value for transparency */
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px; 
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-btn {
            margin-top: 15px;
        }
        .btn-primary {
    background-color: transparent;
    color: #fff; /* Change the text color to match your design */
    border: 1px solid #fff; /* Add a border for clarity */
}

.btn-primary:hover {
    background-color: transparent;
    color: #fff; /* Change the text color on hover */
    border: 1px solid #fff; /* Add a border for clarity */
}
.btn-primary:hover,
.btn-primary:focus,
.btn-primary:active {
    background: linear-gradient(135deg, #6c757d, #464d4f);
     background-color: #6c757d !important; /* Grey color */;
    color: #fff !important;
    border-color: #fff !important;
    box-shadow: none !important;
}
        
        .transparent-input {
            
            background-color: rgba(255, 255, 255, 0.5); /* Adjust the alpha value for transparency */
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 8px;
            margin-bottom: 15px;
        }
        
         /* Responsive styles */
        @media screen and (max-width: 768px) {
            .container {
                width: 80%;
            }

            .form-group {
                margin-bottom: 10px;
            }

            .btn-primary {
                font-size: 16px;
            }
        }
        
        
    </style>

</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           
           $passwordHash = $password;

           $errors = array();
           
           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"All fields are required");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 charactes long");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
           }
           require_once "db_conn.php";
           $sql = "SELECT * FROM users WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO users (full_name, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
                header("Location: login.php");
            }else{
                die("Something went wrong");
            }
           }
          

        }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control transparent-input" name="fullname" placeholder="Full Name:">
            </div>
            <div class="form-group">
                <input type="emamil" class="form-control transparent-input" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control transparent-input" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control transparent-input" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
        
        <div class="form-btn">
    <a href="login.php" class="btn btn-primary">Login Here</a>
</div>
    </div>
</body>
</html>