<?php

/*Главная страница в админпанели*/
class AdminController extends AdminBase
{
    /*Стартовая страница панели администратора*/
    public function actionIndex()
    {
        //Проверка прав доступа
        self::checkAdmin();
        //Полключаем вид
        include_once (ROOT.'/views/admin/index.php');
        return true;
    }
}