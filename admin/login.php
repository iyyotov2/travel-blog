<?php
session_start();

require_once("lib/config.php");
require_once("lib/classes.php");

$page = new User;

if ($page -> is_logged()) {
    header('Location: index.php');
}

$data['page_title'] = 'Вход | '.SITE_NAME;

if (isset($_POST['submit']) && $_POST['submit'] == 'login' && isset($_POST['protect']) && $_POST['protect'] == $_SESSION['protect']) {
    $_SESSION['protect'] = '';

    if (isset($_POST['username']) && strlen(trim($_POST['username'])) > 0) {
        $username = $_POST['username'];
    } else {
        $_SESSION['error'][] = 'Потребителското име е задължително!';
    }

    if (isset($_POST['password']) && strlen(trim($_POST['password'])) > 0) {
        $password = $_POST['password'];
    } else {
        $_SESSION['error'][] = 'Паролата е задължителна!';
    }

    if (!isset($_SESSION['error'])) {
        if ($page -> check_user($username, $password)) {
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['error'][] = 'Невалидна парола и/или потребителско име!';
        }
    }
}

$data['errors'] = $page -> show_errors();

$protect = md5(rand(1234, 9876).date('Ymdhis'));
$_SESSION['protect'] = $data['protect'] = $protect;

$page -> load_template('header', $data);
$page -> load_template('login_view', $data);