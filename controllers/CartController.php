<?php

class CartController
{
    /*Добавления товара в корзину (асинхронный запрос)*/
    public function actionAdd($id)
    {
        /*Добавляем товар в корзину, распечатываем значение которое
        возвращает метод addProduct() - к-во товаров в корзине, таким образом
        формируем ответ на асинхронный запрос*/
        echo '('.Cart::addProduct($id).')';
        return true;
    }
    /*Использовался для обработки синхронного запроса
     * public function actionAdd($id)
    {
        //Добавляем товар в корзину
        Cart::addProduct($id);

        //Перенаправляем пользователя на страницу с которой он пришел
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }
    */

    /*Отображение корзины*/
    public function actionIndex()
    {
        //Список категорий для отображения на странице
        $categories = Category::getCategoryList();
        //Данные о товарах в корзине
        $productsInCart = Cart::getProducts();

        if ($productsInCart){//если товары есть
            //Получаем массив с идентификаторами в корзине
            $productsIdsArray = array_keys($productsInCart);
            //Получаем информацию о товарах по заданным идентификаторам (с базы)
            $products = Product::getProductsByIds($productsIdsArray);
            //Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once (ROOT.'/views/cart/index.php');
        return true;
    }

    /*Оформления заказа пользователем*/
    public function actionCheckout()
    {
        //Список категорий для отображения на странице
        $categories = Category::getCategoryList();
        //Статус успешного выполнения заказа
        $result = false;
        //Проверяем отправлена ли форма
        if (isset($_POST['submit'])){
            //Форма отправлена
            // Считиваем данные формы
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            //Валидация полей
            $errors = false;
            if (!User::checkName($userName)){
                $errors[] = 'Неправельное имя';
            }
            if (!User::checkPhone($userPhone)){
                $errors[] = 'Длина номера должна быть от 10 до 12 символов';
            }
            //Форма заполнена корректно
            if ($errors == false){
                //Получаем данные из корзины (сессии)
                $productsInCart = Cart::getProducts();
                //Получаем Id пользователя
                if (User::isGuest()) {
                    $userId = false;
                }else{
                    $userId = User::checkLogged();
                }
                //Сохраняем заказ в БД
                //В result будет true  в случае успешного выполнения
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);
                if ($result){ //если заказ отправлен
                    //Оповещаем администратора о новом заказе
                    $adminEmail = 'evgeniy_legkun@ukr.net';
                    /*http://mysite.ua/admin/orders/ - для удаленного сервера*/
                    $message = '/admin/orders/';//ссылка на административную панель
                    $subject = 'Новый заказ';
                    mail($adminEmail, $subject, $message);
                    //Очищаем корзину
                    Cart::clear();
                }
            }else{//Форма заполненя не корректно
                //Подсчитываем итоги (для отображения на странице)
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
            }
        }else{
            //Форма не отправлена.
            $productsInCart = Cart::getProducts();//Получаем данные из корзины
            //Проверяем есть ли в корзине товары
            if ($productsInCart == false){
                //Товаров нет. Отправляем пользователя на главную страницу
                header("Location: /");
            }else{
                //Товары есть. Подсчитываем общую стоимость и к-во товаров
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();

                $userName = false;
                $userPhone = false;
                $userComment = false;

                //Проверяем авторизован ли пользователь
                if (User::isGuest()){
                    //Нет. Поля формы пустие
                }else{
                    //Да. Подставляем данные в форму
                    //Получаем данные о пользователе из БД по id
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);
                    $userName = $user['name'];
                }
            }
        }

        require_once (ROOT.'/views/cart/checkout.php');
        return true;
    }

    /*Удаление товара из корзины*/
    public function actionDelete($id)
    {
        //Удалить товар из корзины
        Cart::deleteProduct($id);
        //Возвращаем пользователя на страницу
        header("Location: /cart/");
    }

}