<?php
require_once '../db_connection.php';
$name = $_GET['name'];
$group_id = $_GET['group_id'];
$sql = "INSERT INTO `users` (`name`, `group_id`) VALUES ('{$name}', {$group_id})";
$response = mysqli_query($db, $sql);
print $response;
