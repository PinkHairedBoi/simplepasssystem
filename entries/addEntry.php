<?php
require_once '../db_connection.php';
$sql = "SELECT * FROM `list` WHERE `date_out` IS NULL";
$result = mysqli_query($db, $sql);
$entered = array();
while ($e = mysqli_fetch_assoc($result)) {
    $entered[] = $e;
}

$dir = $_GET['direction'] === 'true';

if ($dir) {
    $entered_user_ids = array();
    foreach ($entered as $e) {
        $entered_user_ids[] = $e['user_id'];
    }
    $sql = "SELECT * FROM `users` WHERE `id` NOT IN ('" . implode("', '", $entered_user_ids) . "')";
    $result = mysqli_query($db, $sql);
    $nonentered = array();
    while ($u = mysqli_fetch_assoc($result)) {
        $nonentered[] = $u;
    }
    if (empty($nonentered)) {
        return;
    }
    $user_to_enter = array_rand($nonentered);
    $sql = "INSERT INTO `list` (`user_id`, `date_in`) VALUES ({$nonentered[$user_to_enter]['id']}, now())";
    $result = mysqli_query($db, $sql);
    print $result;
} else {
    if (empty($entered)) {
        return;
    }

    $user_to_exit = array_rand($entered);
    $sql = "UPDATE `list` SET `date_out`=now() WHERE `user_id`={$entered[$user_to_exit]['user_id']} AND `id`={$entered[$user_to_exit]['id']}";
    $result = mysqli_query($db, $sql);
    print $result;
}
