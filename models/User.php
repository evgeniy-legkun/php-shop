<?php

class User
{
    /*добавление нового пользователя в базу*/
    public static function register($name, $email, $password)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO user (id, name, email, password)'.
                'VALUES (NULL, :name, :email, :password);';

        $result = $db->prepare($sql);//подготовка запроса к запуску посредством execute()
        $result->bindParam(':name', $name, PDO::PARAM_STR);//замена плейсхолдеров на нужные значения
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute(); //execute() - запускает запрос на выполнение
    }

    /*Проверяет имя, не меньше чем 2 символа*/
    public static function checkName($name)
    {
        if(strlen($name) >= 2){
            return true;
        }
        return false;
    }

    /*Проверяет пароль, не меньше чем 8 символов*/
    public static function checkPassword($password)
    {
        if(strlen($password) >= 8){
            return true;
        }
        return false;
    }

    /*Проверяет правельно ли введен пароль второй раз при регистрации*/
    public static function checkRepeatPassword()
    {
        if ($_POST['password'] == $_POST['second_password']){
            return true;
        }
        return false;
    }

    /*Проверяет ни пустое ли сообщение отправляется администратору*/
    public static function checkMessage($userText)
    {
        if(strlen($userText) > 0){
            return true;
        }
        return false;
    }

    /*Проверяет email*/
    public static function checkEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    /*Проверяет что бы длина номера была от 10 до 12 символов*/
    public static function checkPhone($userPhone)
    {
        if (preg_match("/^[0-9]{10,12}+$/", $userPhone)) {
            return true;
        }
        return false;
    }

    /*Проверяет есть ли email в базе*/
    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM user WHERE email= :email';//подготовленный запрос

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);//замена плейсхолдера параметром

        $result->execute();//execute() - запускает запрос на выполнение

        if($result->fetchColumn())//проверяем есть ли записи
            return true;
        return false;
    }

    /*Проверяет существует ли пользователь*/
    public static function checkUserData($email)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email= :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);//замена плейсхолдера параметром
        $result->execute();

        $user = $result->fetch();
        if($user){
            return $user;
        }
        return false;
    }

    /*Проверяет авторизирован ли пользователь
    Если да, то возвращает идентификатор пользователя*/
    public static function checkLogged()
    {
        //Если есть (сессия) идентификатор пользователя, значит ранее он был авторизован
        if(isset($_SESSION['user'])){
            return $_SESSION['user'];
        }
        //Если нет идентификатора перенаправляем пользователя на страницу входа
        header("Location: /user/login/");
    }

    /*Запоминает пользователя в сессию*/
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    /*проверяет является ли пользователь гостем*/
    public static function isGuest()
    {
        if(isset($_SESSION['user'])){
            return false;
        }
        return true;
    }

    /*Возвращает информацию о пользователе по Id*/
    public static function getUserById($userId)
    {
        if ($userId){
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id= :userId';

            $result = $db->prepare($sql);
            $result->bindParam(':userId', $userId, PDO::PARAM_INT);

            /*Указываем что хотим получить данные в виде масива*/
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
    }

    /*Редактирование данных пользователя*/
    public static function edit($userId, $name, $password)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE user SET name= :name, password= :password WHERE id= :userId';

        $result = $db->prepare($sql);
        $result->bindParam(":name", $name, PDO::PARAM_STR);
        $result->bindParam(":password", $password, PDO::PARAM_STR);
        $result->bindParam(":userId", $userId, PDO::PARAM_INT);

        return $result->execute();
    }


}

