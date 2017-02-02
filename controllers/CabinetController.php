<?php

class CabinetController
{
    /*Кабинет пользователя*/
    public function actionIndex()
    {
        /*В $userId мы получим id пользователя*/
        $userId = User::checkLogged();
        /*Получаем информацию о пользователе из БД*/
        $user = User::getUserById($userId);

        require_once (ROOT.'/views/cabinet/index.php');
        return true;
    }

    /*Редактирование данных пользователя*/
    public function actionEdit()
    {
        //получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        //получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        $name = $user['name'];//получаем имя для отображения в поле на /cabinet/edit.php
        $result = false;

        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $password = $_POST['password'];
            $errors = false;
            if(!User::checkName($name)){
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if(!User::checkPassword($password)){
                $errors[] = 'Пароль не должен быть короче 8-ти символов';
            }
            if(!User::checkRepeatPassword()){
                $errors[] = 'Пароли не совпадают';
            }
            if($errors == false){
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                $result = User::edit($userId, $name, $hashPassword);
            }
        }

        require_once (ROOT.'/views/cabinet/edit.php');
        return true;
    }

    /*Список заказов покупателя*/
    public function actionHistory()
    {
        /*Id пользователя*/
        $userId = User::checkLogged();
        /*Получаем информацию о пользователе из БД*/
        $user = User::getUserById($userId);
        /*Получаем список заказов*/
        $ordersList = Order::getOrdersList();

        require_once (ROOT.'/views/cabinet/history.php');
        return true;
    }

    /*Просмотр заказа покупателя*/
    public function actionView($id)
    {
        /*Id пользователя*/
        $userId = User::checkLogged();
        /*Получаем информацию о пользователе из БД*/
        $user = User::getUserById($userId);
        /*Получаем данные о заказе по Id*/
        $order = Order::getOrderById($id);
        //Получаем масив с идентификаторами и количеством товаров
        $productsInOrder = json_decode($order['products'], true);
        //Получаем масив с идентификаторами товаров
        $productsIds = array_keys($productsInOrder);
        //Получаем список товаров в заказе по масиву идентификаторов
        $products = Product::getProductsByIds($productsIds);

        require_once (ROOT.'/views/cabinet/view_order.php');
        return true;
    }

}