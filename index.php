<?php
    // FRONT CONTROLLER
    /*Общие настройки*/
    ini_set('display_errors', 1); //включили отображение ошибок
    error_reporting(E_ALL);
    /*запуск сессии для всех страниц*/
    session_start();
    /*Подключение файлов системы*/
    define('ROOT', dirname(__FILE__)); //ROOT - константа с полным путем к проэкту
    /*подключение файла автозагрузки классов*/
    require_once(ROOT.'/components/Autoload.php');

    /*Вызов Router*/
    $router = new Router();
    $router->run();

?>