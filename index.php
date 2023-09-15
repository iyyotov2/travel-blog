<?php
require_once("lib/config.php");
require_once("lib/classes.php");

$page = new HomePage;
$data = $page -> getData();

$page -> load_template('header', $data);
$page -> load_template('menu', $data);
$page -> load_template('blank', $data);
$page -> load_template('footer');