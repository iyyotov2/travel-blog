<?php
session_start();

require_once("lib/config.php");
require_once("lib/classes.php");

$page = new SinglePage;

if (!$page -> is_logged()) {
    header('Location: login.php');
}

$data['title'] = $data['summary'] = $data['content'] = '';
$data['category'] = 1;

if (isset($_POST['new']) && $_POST['new'] == 'save') {

    // var_dump($_POST);

    $insert_new = $page -> check_post($_POST);

    if (!isset($_SESSION['error'])) {
        $insert_new['active'] = 1;
        $insert_new['autor_id'] = 1;
        $insert = new Db;
        $insert_id = $insert -> Insert('INSERT INTO pages (title, summary, content, category, active, autor_id) VALUES (:title, :summary, :content, :category, :active, :autor_id)', $insert_new);
        
        $data['debug'] = $insert_id;

        if ($insert_id > 0) {
            header('Location: index.php');
        }
    }
}

if (isset($update)) {
    $data = $update;
}

$data['menu']['active'] = 'Нова страница';
$data['page_title'] = 'Добавяне на страница | '.SITE_NAME;

$data['categories'][] = array('id' => 1, 'name' => 'Новини');
$data['categories'][] = array('id' => 2, 'name' => 'Пътеписи');

$data['errors'] = $page -> show_errors();

$page -> load_template('header', $data);
$page -> load_template('menu', $data);
$page -> load_template('add_new_view', $data);