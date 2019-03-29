<?php
require_once '../db_connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM `list` WHERE `id`={$id}";
$response = mysqli_query($db, $sql);
print $response;
