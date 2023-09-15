<?php
session_start();

require_once("lib/config.php");
require_once("lib/classes.php");

use PHPMailer\PHPMailer\PHPMailer;

include_once "PHPMailer/PHPMailer.php";
include_once "PHPMailer/Exception.php";

$page = new Page;

$_SESSION['success'] = '';
$_SESSION['error'] = '';

if (isset($_POST['submit']) && $_POST['submit'] == 'send_mail') {
    $from = $_POST['from'];
    $subject = $_POST['subject'];
    $msg = $_POST['msg'];

    if (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '') {
        $ext = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);

        if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png' && $ext != 'gif') {
            $_SESSION['error'] = 'Само "jpg", "jpeg", "png", "gif" са позволени!';
        } else {
            $file = "attachment/" . basename($_FILES['attachment']['name']);
            move_uploaded_file($_FILES['attachment']['tmp_name'], $file);
        }
    } else {
        $file = '';
    }

    if ($_SESSION['error'] == '') {
        $mail = new PHPMailer();
        $mail -> addAddress('ivaylo@ivaylo.site');
        $mail -> setFrom($from);
        $mail -> Subject = $subject;
        $mail -> isHTML(true);
        $mail -> Body = $msg;
        if ($file != '') {
            $mail -> addAttachment($file);
        }

        if ($mail -> send()) {
            $_SESSION['success'] = 'Съобщението е изпратено успешно!';
        }

        if ($file) {
            unlink($file);
        }
    }
}

$data['menu']['active'] = 'Пиши ни';
$data['html_title'] = 'Пиши ни | '.SITE_NAME;

$page -> load_template('header', $data);
$page -> load_template('menu', $data);
$page -> load_template('contact_us_view');
$page -> load_template('footer');