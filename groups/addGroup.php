<?php
require_once '../db_connection.php';
$name = $_GET['name'];
$sql = "INSERT INTO `groups` (`name`) VALUES ('{$name}')";
$response = mysqli_query($db, $sql);
print $response;
