<?php
session_start();

require_once("lib/config.php");
require_once("lib/classes.php");

$page = new SinglePage;

if (!$page -> is_logged()) {
    header('Location: login.php');
}

if (isset($_POST['delete']) && $_POST['delete'] == 'delete' && isset($_GET['id'])) {
    
    $delete['id'] = (int)$_GET['id'];
    $delete['active'] = 0;

    if (count($delete) > 0) {
        $remove = new Db;
        $remove_id = $remove -> Update('UPDATE pages SET active = :active WHERE id = :id', $delete);
        if ($remove_id == NULL) {
            header('Location: index.php');
        }
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
    $data['page_title'] = 'Изтриване на страница | '.SITE_NAME;

    $page -> load_template('header', $data);
    $page -> load_template('menu', $data);
    $page -> load_template('delete_view', $data);
}