<?php
require_once("lib/config.php");
require_once("lib/classes.php");

$page = new NewsPage;

if (isset($_GET['id']) && intval(strval($_GET['id']), 10) > 0) {
    $id = intval(strval($_GET['id']), 10);

    $data = $page -> GetSingleNew($id);

    if (!isset($data[0]['category']) && $data[0]['category'] !== 1) {
        header('Location: error.php');
    }

    $page -> load_template('header', $data[0]);
    $page -> load_template('menu', $data[0]);
    $page -> load_template('blank', $data[0]);
    $page -> load_template('footer');

} else {

    $data['news'] = $page -> GetNews();
    $data['menu']['active'] = 'Новини';
    $data['html_title'] = 'Новини | '.SITE_NAME;

    $page -> load_template('header', $data);
    $page -> load_template('menu', $data);
    $page -> load_template('news_view', $data);
    $page -> load_template('footer');
}