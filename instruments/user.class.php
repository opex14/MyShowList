<?php if(!defined('MAINDIR')) die('USE MAIN SCRIPT!');

/** 
 * Класс для авторизации
 * @author дизайн студия ox2.ru 
 */ 
class AuthClass{

    private $sql, $query, $prefix;
    
    function __construct(MySQLi $msql, $prefix) {
        $this->sql = $msql;
        $this->prefix = $prefix;
    }
    
    function doQuery($mode, $user) {
    $login = $this->sql->real_escape_string($user);
    if ($mode == 'name') {
    $querr = "login = '".$login ."'"; 
    } elseif ($mode == 'id') {
    $querr = "id = '".$login ."'";
    } else {
        return false;
    }
        $queryText = "SELECT id, login, password FROM ".$this->prefix."users WHERE ".$querr." LIMIT 1";
        
        if($query = $this->sql->query($queryText)) {
            $results = $query->fetch_array();
            return $results;
        } else {
            return null;
        }
    }

    /**
     * Проверяет, авторизован пользователь или нет
     * Возвращает true если авторизован, иначе false
     * @return boolean 
     */
    public function isAuth() {
        if (isset($_SESSION["is_auth"])) { //Если сессия существует
            return $_SESSION["is_auth"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
        }
        else return false; //Пользователь не авторизован, т.к. переменная is_auth не создана
    }
    
    /**
     * Авторизация пользователя
     * @param string $login
     * @param string $passwors 
     */
    public function auth($login, $passwors) {
    
        $database = $this->doQuery('name', $login);
        if (strtolower($login) == strtolower($database['login']) && md5(md5($passwors)) == $database['password']) { //Если логин и пароль введены правильно
            $_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
            $_SESSION["user_id"] = $database['id']; 
            $_SESSION["login"] = $login; //Записываем в сессию логин пользователя
            return true;
        }
        else { //Логин и пароль не подошел
            $_SESSION["is_auth"] = false;
            return false; 
        }
    }
    
    /**
     * Метод возвращает логин авторизованного пользователя 
     */
    public function getLogin() {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["login"]; //Возвращаем логин, который записан в сессию
        }
    }
    
    public function getId() {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["user_id"]; //Возвращаем логин, который записан в сессию
        }
    }
    
    
    public function out() {
        $_SESSION = array(); //Очищаем сессию
        session_destroy(); //Уничтожаем
    }
    
    function __destruct(){
     //Close the Connection
     $this->sql->close();
    }
}
?>
