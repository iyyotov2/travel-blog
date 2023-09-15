<?php
session_start();

require_once("lib/config.php");
require_once("lib/classes.php");

$page = new Upload;

if (!$page -> is_logged()) {
    header('Location: login.php');
}

$data['menu']['active'] = 'Файлове';
$data['page_title'] = 'Качване на файл | '.SITE_NAME;

if (isset($_POST['submit'])) {
    if (isset($_FILES['fileToUpload']['name']) && strlen($_FILES['fileToUpload']['name']) > 4) {
        if ($page -> upload_file($_FILES['fileToUpload'])) {
            $data['success'] = 'Файлът е качен успешно!';
        }
    } else {
        $_SESSION['error'][] = 'Не сте избрали файл!';
    }
}

$data['errors'] = $page -> show_errors();
$data['images'] = $page -> get_images(); 

$page -> load_template('header', $data);
$page -> load_template('menu', $data);
$page -> load_template('upload_view', $data);