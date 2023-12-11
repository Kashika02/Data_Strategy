<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <style>
        body {
            font-family:cursive;
            background-color: #f3f3f3;
            text-align: center;
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-top: 50px;
        }
        a {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            font-size: 18px;
        }
        a:hover {
            text-decoration: underline;
        }
        .instructions-container ul {
            text-align:left; /* Set text alignment to right */
        }
        .instructions-container ul li {
            color: black; /* Set the text color to black */
        }
        h2
        {
            color: #333;
        }
    </style>
</head>
<body>
<div class="instructions-container">
    <h1>Hello, <?php echo $_SESSION['name']; ?></h1>
    <a href="index.php">Enter the Game</a>
    <h2>Let's go through the instructions!</h2>
    <ul>
        <li>This Game simulates the data strategy for a time span of 10 years.</li>
        <li>You will have 40 quarters in total and 25,000 to invest in a set of strategies for each quarter.</li>
        <li>Choose wisely on which strategy you want to invest, as each decision may have positive and negative impacts on your investment.</li>
        <li>Occasionally, you may encounter adverse or favorable events to make it realistic.</li>
        <li>You may choose to end the game at any quarter.</li>
        <li>For each quarter, you can view your result as a graph and modify your strategy according to the result.</li>
        <li>Upon ending the game, the dashboard gives you a summary of data strategy.</li>
         <a href="gi.pdf" target="_blank">Download the PDF instructions</a>
    </ul>
</div>


</body>
</html>
<?php 
}
?>