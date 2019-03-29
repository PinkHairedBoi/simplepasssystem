<?php
require_once '../db_connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM `groups` WHERE `id`={$id}";
$response = mysqli_query($db, $sql);
print $response;