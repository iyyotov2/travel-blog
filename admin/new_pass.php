<?php
session_start();

require_once("lib/config.php");
require_once("lib/classes.php");

$page = new User;

if (!$page -> is_logged()) {
    header('Location: login.php');
}

$data['page_title'] = 'Смяна на паролата | '.SITE_NAME;

$id = (int)$_SESSION['user']['id'];
$password = '';
$new_password = '';

if (isset($_POST['new-pass']) && $_POST['new-pass'] == 'new-pass') {
    if (isset($_POST['password']) && strlen($_POST['password']) > 0) {
        $password = $_POST['password'];
    } else {
        $_SESSION['error'][] = 'Не сте въвели старата парола!';
    }

    if (isset($_POST['new-password']) && strlen($_POST['new-password']) > 5) {
        $new_password = $_POST['new-password'];
    } else {
        $_SESSION['error'][] = 'Новата парола трябва да е по-дълга от 5 символа!';
    }

    $check_db = new Db;

    $is_correct = $check_db -> Select('SELECT * FROM users WHERE id = :id', array('id' => $id));

    if (password_verify($password, $is_correct[0]['password'])) {
        $page -> change_pass($id, $new_password);
    } else {
        $_SESSION['error'][] = 'Старата парола е грешна!';
    }
}

$data['errors'] = $page -> show_errors();

$data['menu']['active'] = 'Смяна на паролата';
$data['page_title'] = 'Смяна на паролата | '.SITE_NAME;

$page -> load_template('header', $data);
$page -> load_template('menu', $data);
$page -> load_template('new_pass_view', $data);