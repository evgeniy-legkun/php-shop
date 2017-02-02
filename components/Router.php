<?php

class Router
{
    private $routes; //масив для хранения маршрутов

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php'; //путь к роутам
        $this->routes = include($routesPath); //присвоили свойству routes масив роутов
    }

    /*Return request string*/
    private function getUrl(){
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run() //принимает управление от фронт-контролера ( анализ запроса и передача управления )
    {
        /*получить строку запроса*/
        $url = $this->getUrl();

        /*проверить ниличие запроса в routes.php*/
        foreach ($this->routes as $urlPattern => $path) {
            //echo "<br/>$urlPattern->$path"; //проверка считывает ли роуты
            if(preg_match("~$urlPattern~", $url)){ // "~$urlPattern~" - это регулярка, ~ вместо /
                /*Получаем внутренний путь из внешнего, согластно правилу*/
                $internalRoute = preg_replace("~$urlPattern~", $path, $url);

                /*разделяем path по разделителю "/"*/
                $segments = explode('/', $internalRoute);

                /*получаем имя контроллера*/
                $controllerName = array_shift($segments).'Controller'; // получаем имя контроллера(вилучаем первый ел.)
                $controllerName = ucfirst($controllerName);  //делает первую букву строки заглавной

                /*получаем имя action*/
                $actionName = 'action'.ucfirst(array_shift($segments)); //получаем action
                $paramerets = $segments;

                /*подключить файл кдасса-контроллера*/
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php'; //путь к файлу контроллера
                if(file_exists($controllerFile)){
                    include_once ($controllerFile);
                }
                /*Создать обьект, вызвать метод*/
                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $paramerets);

                if($result != null){
                    break;
                }
            }
        }
    }
}

