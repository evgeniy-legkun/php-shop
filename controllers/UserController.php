<?php

class UserController
{
    /*Регистрация пользователя на сайте*/
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = false;

            if(!User::checkName($name)){
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if(!User::checkEmail($email)){
                $errors[] = 'Неправильные email';
            }
            if(!User::checkPassword($password)){
                $errors[] = 'Пароль не должен быть короче 8-ти символов';
            }
            if(!User::checkRepeatPassword()){
                $errors[] = 'Пароли не совпадают';
            }
            if(User::checkEmailExists($email)){
                $errors[] = 'Такой email уже используется';
            }
            if($errors == false){
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                $result = User::register($name, $email, $hashPassword);
            }
        }

        require_once (ROOT.'/views/user/register.php');
        return true;
    }

    /*Авторизация пользователя*/
    public function actionLogin()
    {
        $errors = false;

        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            /*Валидация полей*/
            if(!User::checkEmail($email)){
                $errors[] = 'Неправельный email';
            }
            if (!User::checkPassword($password)){
                $errors[] = 'Пароль не должен быть короче 8-ти символов';
            }
            /*Проверяем существует ли пользователь*/
            $user = User::checkUserData($email);
            $userId = $user['id'];
            if(!password_verify($password, $user['password'])){
                //если данные не правельные показываем ошибку
                $errors[] = 'Неверные данные для входа на сайт';
            }else{
                //иначе запоминаем id пользователя (в сессию)
                User::auth($userId);
                //Перенаправляем пользователя в кабинет (закрытая часть сайта)
                header("Location: /cabinet/"); // /cabinet/ - это УРЛ на который будет перенаправлен пользователь
            }
        }

        require_once (ROOT.'/views/user/login.php');
        return true;
    }

    /*Удаление из сессии данных о пользователе, перенаправление на главную*/
    public function actionLogout()
    {
        unset($_SESSION['user']);
        header('Location: /');
    }

}
