<?php
session_start();

require_once("lib/config.php");
require_once("lib/classes.php");

$page = new SinglePage;

if (!$page -> is_logged()) {
    header('Location: login.php');
}

if (isset($_POST['edit']) && $_POST['edit'] == 'save' && isset($_POST['id']) && isset($_GET['id']) && $_POST['id'] == intval(strval($_GET['id']), 10)) {
    
    $update_id = intval(strval($_POST['id']), 10);

    $update = $page -> check_post($_POST);

    if (!isset($_SESSION['error'])) {
        $page -> editPage($update_id, $update);
        header('Location: index.php');
    }
}

if (isset($_GET['id']) && intval(strval($_GET['id']), 10) > 0) {

    $id = intval(strval($_GET['id']), 10);

    $page -> set_id($id);
    $data = $page -> GetData();

    if (!is_array($data)) {
        header('Location: error.php');
    }

    $data['menu']['active'] = 'Страници';
    $data['page_title'] = 'Редактиране на страница | '.SITE_NAME;

    $data['categories'][] = array('id' => 1, 'name' => 'Новини');
    $data['categories'][] = array('id' => 2, 'name' => 'Пътеписи');

    $data['errors'] = $page -> show_errors();

    $page -> load_template('header', $data);
    $page -> load_template('menu', $data);
    $page -> load_template('edit_view', $data);
}