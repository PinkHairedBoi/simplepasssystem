<?php
require_once '../db_connection.php';
$sql = 'SELECT * FROM `list` WHERE 1';
$response = mysqli_query($db, $sql);
$result = array();
while ($r = mysqli_fetch_assoc($response)) {
    $result[] = $r;
}
print empty($result) ? false : json_encode($result);
