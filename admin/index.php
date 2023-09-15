<?php
session_start();

require_once("lib/config.php");
require_once("lib/classes.php");

$page = new GetAllPages;

if (!$page -> is_logged()) {
    header('Location: login.php');
}

$data['page_title'] = 'Списък на страниците | '.SITE_NAME;
$data['list'] = $page -> GetAllData();
$data['menu']['active'] = 'Страници';

$page -> load_template('header', $data);
$page -> load_template('menu', $data);
$page -> load_template('list_view', $data);