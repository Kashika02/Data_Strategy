<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
    <style>
        .custom-button {
    background-color: #ffffff;
    color: #000000;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    font-size: 18px;
    cursor: pointer;
}

.custom-button:hover {
    background-color: #000000;
    color: #ffffff;
}

    </style>
    <h1>Dashboard</h1>
    <div id="distance">
    </div>
    <p id="matter"></p>
    <button onclick="redirectToKyoPage()" class="custom-button" >GET TO KNOW YOUR OPONENTS</button>
    <?php
    session_start();
    
    // Check if the user is logged in and the username is set in the session
    // if (isset($_SESSION['user_name'])) {
    //     echo '<p>Welcome, ' . $_SESSION['user_name'] . '</p>';
    // } else {
    //     echo '<p>Welcome, Guest</p>';
    // }
    ?>
    
    <script>
        const distance = sessionStorage.getItem("distance");
        const result = document.getElementById("distance");
        const matter = document.getElementById("matter");
        result.innerText = Math.floor(distance);
        function redirectToKyoPage() {
            window.location.href = "kyo.php"; // Redirect to kyo.php
        }
        if (distance !== null) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "save.php", true); // Change to "save_distance.php"
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("distance=" + distance);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    if (xhr.responseText === "success") {
                        console.log("Distance saved successfully");
                    } else {
                        console.log("Failed to save distance");
                    }
                }
            };
        }

        if (result.innerText < 3) {
            console.log("Great! Impressive strategy over the sector");
            matter.innerText = "Great! Impressive strategy over the sector";
        } else {
            console.log("Oops! You need to work on strategizing the data");
            matter.innerText = "Oops! You need to work on strategizing the data";
        }
        
    </script>
</body>
</html>