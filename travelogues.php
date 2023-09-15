<?php
require_once("lib/config.php");
require_once("lib/classes.php");

$page = new TraveloguesPage;

if (isset($_GET['id']) && intval(strval($_GET['id']), 10) > 0) {
    $id = intval(strval($_GET['id']), 10);

    $data = $page -> GetSingleTravelogue($id);

    if (!isset($data[0]['category']) && $data[0]['category'] !== 2) {
        header('Location: error.php');
    }

    $page -> load_template('header', $data[0]);
    $page -> load_template('menu', $data[0]);
    $page -> load_template('blank', $data[0]);
    $page -> load_template('footer');

} else {

    $data['travelogues'] = $page -> GetTravelogues();
    $data['menu']['active'] = 'Пътеписи';
    $data['html_title'] = 'Пътеписи | '.SITE_NAME;

    $page -> load_template('header', $data);
    $page -> load_template('menu', $data);
    $page -> load_template('travelogues_view', $data);
    $page -> load_template('footer');
}