<?php

function __autoload($class_name)
{
    //масив со списком путей к директориям с классами
    $array_paths = array(
        '/models/',
        '/components/'
    );

    //ищим нужный файл в наших классах и находя - подключаем его
    foreach ($array_paths as $path){
        $path = ROOT . $path . $class_name . '.php';
        if(is_file($path)){
            include $path;
        }
    }

}
