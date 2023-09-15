<?php
defined('SITE') || exit('Неразрешен директен достъп!');

// Базов клас - страница
class Page {

    function __construct () {
        require_once('lib/config.php');
    }

    public function load_template ($name, $data = array()) {
        if (count($data) > 0) {
            foreach ($data AS $k => $v) {
                $$k = $v;
            }
        }

        if (file_exists(SITE_ROOT.'template/'.$name.'.php')) {
            include(SITE_ROOT.'template/'.$name.'.php');
        } else {
            echo "Файлът: ".SITE_ROOT.'template/'.$name.'.php'." не е намерен!";
            exit;
        }
    }
}

// База данни
class Db {

    private $connection = null;

    public function __construct ($dbhost = DB_SERVER, $dbname = DB_DATABASE, $username = DB_USER, $password = DB_PASS) {
        try {
            $this -> connection = new PDO ("mysql:host={$dbhost};dbname={$dbname};", $username, $password);
            $this -> connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this -> connection -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception ($e -> getMessage());
        }
    }

    // Insert
    public function Insert ($statement = '', $parameters = []) {
        try {

            $this -> executeStatement ($statement, $parameters);
            return $this -> connection -> lastInsertId();

        } catch (Exception $e) {
            throw new Exception ($e -> getMessage());
        }
    }

    // Select
    public function Select ($statement = '', $parameters = []) {
        try {

            $result = $this -> executeStatement ($statement, $parameters);
            return $result -> fetchAll();

        } catch (Exception $e) {
            throw new Exception ($e -> getMessage());
        }
    }

    // Update
    public function Update ($statement = '', $parameters = []) {
        try {

            $this -> executeStatement ($statement, $parameters);

        } catch (Exception $e) {
            throw new Exception ($e -> getMessage());
        }
    }

    // Delete
    public function Remove ($statement = '', $parameters = []) {
        try {

            $this -> executeStatement ($statement, $parameters);

        } catch (Exception $e) {
            throw new Exception ($e -> getMessage());
        }
    }

    private function executeStatement ($statement = '', $parameters = []) {
        try {

            $stmt = $this -> connection -> prepare($statement);
            $stmt -> execute($parameters);
            return $stmt;

        } catch (Exception $e) {
            throw new Exception ($e -> getMessage());
        }
    }
}

// Начална страница
class HomePage extends Page {

    function __construct () {
        parent::__construct();
    }

    public function getData () {
        $db = new Db;
        $result = $db -> Select('SELECT * FROM pages WHERE id = 1');
        $result[0]['menu']['active'] = 'Начало';
        $result[0]['html_title'] = $result[0]['title'].' | '.SITE_NAME;
        return $result[0];
    }
}

// Новини
class NewsPage extends Page {

    function __construct () {
        parent::__construct();
    }

    public function GetNews () {
        $cat_id = 1;

        $db = new Db;
        $result = $db -> Select('SELECT * FROM pages WHERE timestamp >= now()-interval 3 month AND category = :category AND active = 1 ORDER BY timestamp DESC', array('category' => $cat_id));
        return $result;
    }

    public function GetSingleNew ($id) {
        $cat_id = 1;

        $db = new Db;
        $result = $db -> Select('SELECT * FROM pages WHERE id = :id AND category = :category AND active = 1', array('id' => $id, 'category' => $cat_id));
        $result[0]['menu']['active'] = 'Новини';
        $result[0]['html_title'] = 'Новини | '.SITE_NAME;
        return $result;
    }
}

// Пътеписи
class TraveloguesPage extends Page {

    function __construct () {
        parent::__construct();
    }

    public function GetTravelogues () {
        $cat_id = 2;

        $db = new Db;
        $result = $db -> Select('SELECT * FROM pages WHERE timestamp >= now()-interval 3 month AND category = :category AND active = 1 ORDER BY timestamp DESC', array('category' => $cat_id));
        return $result;
    }

    public function GetSingleTravelogue ($id) {
        $cat_id = 2;

        $db = new Db;
        $result = $db -> Select('SELECT * FROM pages WHERE id = :id AND category = :category AND active = 1', array('id' => $id, 'category' => $cat_id));
        $result[0]['menu']['active'] = 'Пътеписи';
        $result[0]['html_title'] = 'Пътеписи | '.SITE_NAME;
        return $result;
    }
}