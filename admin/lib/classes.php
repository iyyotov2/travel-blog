<?php
defined('SITE') || exit('Неразрешен директен достъп!');

// Базов клас - страница
class Page {

    function __construct () {
        require_once('lib/config.php');
    }

    public function is_logged () {
        if (isset($_SESSION['user']['logged']) && $_SESSION['user']['logged'] === true) {
            return true;
        } else {
            return false;
        }
    }

    public function load_template ($name, $data = array()) {
        if (count($data) > 0) {
            foreach ($data AS $k => $v) {
                $$k = $v;
            }
        }

        if (file_exists(ADMIN_SITE_ROOT.'template/'.$name.'.php')) {
            include(ADMIN_SITE_ROOT.'template/'.$name.'.php');
        } else {
            echo "Файлът: ".ADMIN_SITE_ROOT.'template/'.$name.'.php'." не е намерен!";
            exit;
        }
    }

    public function show_errors () {
        if (isset($_SESSION['error']) && is_array($_SESSION['error']) && count($_SESSION['error']) > 0) {
            $return = '<div class="alert alert-danger">
            <strong>Грешка!</strong><br> '.implode('<br>', $_SESSION['error']).'
            </div>';
            unset($_SESSION['error']);
            return $return;
        } else {
            unset($_SESSION['error']);
        }
        return '';
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
            return true;

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

// Страница
class SinglePage extends Page {

    var $id;

    function __construct () {
        parent::__construct();
    }

    public function set_id ($id = 0) {
        $this -> id = $id;
    }

    public function GetData () {
        $db = new Db;
        $result = $db -> Select('SELECT * FROM pages WHERE id = '.$this -> id);
        return $result[0];
    }

    public function editPage ($id, $data = []) {
        if (count($data) > 0) {
            $tmp = array();

            foreach ($data AS $key => $val) {
                $tmp[] = $key.' = :'.$key;
            }

            $statement = 'UPDATE pages SET '.implode(', ', $tmp).' WHERE id = '.$id;

            $db = new Db;
            $db -> Update($statement, $data);
        }
    }

    public function check_post ($data) {
        $allowed_keys = array('title' => 'TITLE','summary' => 'SUMMARY','content' => 'STR','category' => 'INT','active' => 'INT');

        $result = array();

        foreach ($allowed_keys AS $k => $v) {
            if (isset($data[$k])) {
                if ($this -> check($data[$k], $v) !== false) {
                    $result[$k] = $this -> check($data[$k], $v);
                }
            } 
        }

        return $result;
    }

    private function check ($value, $type) {
        if ($type == 'INT') {
            if (intval(strval($value), 10) >= 0) {
                return intval(strval($value), 10);
            } else {
                $_SESSION['error'][] = 'Стойността трябва да е цяло число по-голямо от 0!';
                return false;
            }
        } elseif ($type == 'TITLE') {
            if (strlen(strip_tags($value)) > 0 && strlen(strip_tags($value)) < 250) {
                return strip_tags($value);
            } else {
                $_SESSION['error'][] = 'Заглавието трябва да е от 1 до 250 символа!';
                return false;
            }
        } elseif ($type == 'SUMMARY') {
            if (strlen(strip_tags($value)) > 0 && strlen(strip_tags($value)) < 350) {
                return strip_tags($value);
            } else {
                $_SESSION['error'][] = 'Въвеждащият текст трябва да е от 1 до 350 символа!';
                return false;
            }
        } elseif ($type == 'STR') {
            if (strlen($value) > 0) {
                return $value;
            } else {
                $_SESSION['error'][] = 'Съдържанието не може да е празно!';
                return false;
            }
        }
    }
}

// Всички страници
class GetAllPages extends Page {

    function __construct () {
        parent::__construct();
    }

    public function GetAllData () {
        $db = new Db;
        $result = $db -> Select('SELECT * FROM pages');
        return $result;
    }
}

// Потребител
class User extends Page {

    public function check_user ($username = '', $password = '') {
        if (strlen($username) == 0 || strlen($password) == 0) {
            return false;
        }

        $db = new Db;

        $users = $db -> Select('SELECT * FROM users WHERE active = 1 AND username = :username', array('username' => $username));
        if (count($users) == 0) {
            return false;
        }

        foreach ($users AS $user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user']['logged'] = true;
                $_SESSION['user']['id'] = $user['id'];
                $_SESSION['user']['names'] = $user['names'];
                $_SESSION['user']['username'] = $user['username'];
                return true;
            }
        }
        return false;
    }

    public function change_pass ($id = 0, $new_password = '') {
        if ($id == 0 || strlen($new_password) == 0) {
            return false;
        }

        $hash = password_hash($new_password, PASSWORD_DEFAULT);

        $db = new Db;

        $parameters = array(
            'id' => $id,
            'new_pass' => $hash
        );
        $db -> Update('UPDATE users SET password = :new_pass WHERE id = :id', $parameters);

        header('Location: logout.php?logout');
    }
}

// Качване
class Upload extends Page {
    public function upload_file($file = []) {
        $folder = '../images/';

        if (file_exists($folder.$file['name'])) {
            $_SESSION['error'][] = 'Файл с такова име съществува!';
        }

        // if ($file['size'] > 50*1024) {
        //     $_SESSION['error'][] = 'Файлът не трябва да е по-голям от 50kb!';
        // }

        $img = @getimagesize($file['tmp_name']);

        if ($img === false) {
            $_SESSION['error'][] = 'Файлът не е изображение!';
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png' && $ext != 'gif') {
            $_SESSION['error'][] = 'Само "jpg", "jpeg", "png", "gif" са позволени!';
        }

        if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
            return false;
        } else {
            if (move_uploaded_file($file['tmp_name'], $folder.$file['name'])) {
                return true;
            } else {
                $_SESSION['error'][] = 'Грешка при качването на файла!';
            }
            return false;
        }
    }

    public function get_images () {
        $folder = '../images/';
        $images = glob($folder.'*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        return $images;
    }
}