<?php

$sname= "localhost";
$uname= "u458716027_kp";
$password = "@Kashika1212";

$db_name = "u458716027_ds";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}