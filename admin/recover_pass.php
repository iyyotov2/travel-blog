<?php
require_once("lib/config.php");
require_once("lib/classes.php");

$password = 'iv@yl0y0rd@n0v';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo $hash;