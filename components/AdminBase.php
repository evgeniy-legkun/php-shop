<?php
/*
 * Общая логика для контроллеров, которые
 * используются в панели администратора
 * */
abstract class AdminBase
{
    /*Проверяем пользователя является ли он администратором*/
    public static function checkAdmin()
    {
        //Проверяем авторизован ли пользователя
        $userId = User::checkLogged();
        //Получаем информацию о текущем пользователе
        $user = User::getUserById($userId);
        //Если статус пользователя admin пускаем в админ панель
        if ($user['role'] == 'admin')
            return true;
        //Иначе завершаем работу и сообщаем об закрытом доступе
        die('Access denied');
    }
}