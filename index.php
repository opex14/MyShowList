<?php

define('MAINDIR', __DIR__);
session_set_cookie_params(2678400, '/');
session_start(); //Запускаем сессии

require_once MAINDIR .'/instruments/user.class.php';
require_once MAINDIR .'/config.php';

if (isset($_GET['mode'])) {$mode = $_GET['mode'];} else {$mode = 'main';}

$sql = new MySQLi($config['mysql']['host'],$config['mysql']['user'],$config['mysql']['password'],$config['mysql']['database']);
$auth = new AuthClass($sql, $config['mysql']['prefix']);
mb_internal_encoding("UTF-8");

$user_logged = $auth->isAuth();
if ($user_logged) {
    $user_id = $auth->getId();
    $user_name = $auth->getLogin();
} else {
    $user_id = -1;
    $user_name = null;
}
if ($mode == 'main') {
    $page_title = 'MyShowList | Главная';
    include MAINDIR.'/pages/header.php';
    include MAINDIR.'/pages/main.php';
} elseif ($mode == 'list') {
    $page_title = 'MyShowList | Список';
    include MAINDIR.'/pages/header.php';
    include MAINDIR.'/pages/list.php';
} elseif ($mode == 'login') {
    if (isset($_POST['login'])) {
        if (isset($_POST['hash'])) {
            if ($auth->auth($_POST['login'], $_POST['hash'], true)) {
                die('OK');
            } else {
                header('HTTP/1.0 500 Internal Server Error');
                die('FAIL');
            }
        } elseif (isset($_POST['password'])) {
            if ($auth->auth($_POST['login'], $_POST['password'])) {
                die('OK');
            } else {
                header('HTTP/1.0 500 Internal Server Error');
                die('FAIL');
            }
        }
    } else {
        die('No Data');
    }
} elseif ($mode == 'logout') {
    $auth->out();
    header("Location: ".$config['url']);
    exit;
}

?>
</body>
</html>