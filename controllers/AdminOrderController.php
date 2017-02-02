<?php

class AdminOrderController extends AdminBase
{
    /*Action страницы управления заказами*/
    public function actionIndex()
    {
        //Проверка доступа
        self::checkAdmin();
        //Получить информацию о заказах для отображении на странице
        $ordersList = Order::getOrdersList();

        require_once (ROOT.'/views/admin_order/index.php');
        return true;
    }

    /*Страница просмотра заказа*/
    public function actionView($id)
    {
        //Проверка доступа
        self::checkAdmin();
        //Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);
        //Получаем масив с идентификаторами и количеством товаров
        $productsInOrder = json_decode($order['products'], true);
        //Получаем масив с идентификаторами товаров
        $productsIds = array_keys($productsInOrder);
        //Получаем список товаров в заказе по масиву идентификаторов
        $products = Product::getProductsByIds($productsIds);

        require_once (ROOT.'/views/admin_order/view.php');
        return true;
    }

    /*Action страницы "Удалить заказ"*/
    /*удаление по id заказа*/
    public function actionDelete($id)
    {
        //Проверка доступа
        self::checkAdmin();
        //Обработка формы
        if (isset($_POST['submit'])){
            //Если форма отправлена удаляем заказ
            Order::deleteOrderById($id);
            //Перенаправление на страницу управления заказами
            header("Location: /admin/order/");
        }

        require_once (ROOT.'/views/admin_order/delete.php');
        return true;
    }

    /*Страница "Редактировать заказ"*/
    public function actionUpdate($id)
    {
        //Проверка доступа
        self::checkAdmin();
        //Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);
        //Если форма была отправлена
        if (isset($_POST['submit'])){
            //получаем данные из формы
            $options['user_name'] = $_POST['user_name'];
            $options['user_phone'] = $_POST['user_phone'];
            $options['user_comment'] = $_POST['user_comment'];
            $options['date'] = $_POST['date'];
            $options['status'] = $_POST['status'];
            //Сохраняем изминения
            Order::updateOrderById($id, $options);
            //Перенаправляем на страницу управления категориями
            header("Location: /admin/order/");
        }

        require_once (ROOT.'/views/admin_order/update.php');
        return true;
    }

}