<?php

$db_host = 'localhost';
$db_name = 'okugozapad';
$db_user = 'root';
$db_passwd = '';

$db = mysqli_connect($db_host, $db_user, $db_passwd, $db_name);
$db->set_charset('utf8');