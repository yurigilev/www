<?php
    class Db 
    {
        public static function Connect() {
        $dbparams=ROOT.'/config/db.php';
        $db=include($dbparams);

        $dsn="mysql:host={$db['host']};dbname={$db['dbname']}";
        $db_pdo= new PDO ($dsn, $db['user'], $db['pass']);
        return $db_pdo;
    }
}
?>