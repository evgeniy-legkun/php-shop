<?php

class Cart
{
    /*создает масив добавленных товаров в сессии ($_SESSION['products'])*/
    /*возвращает к-во товаров в корзине*/
    public static function addProduct($id)
    {
        /*модель масива для хранения товаров в корзине
         * array(
         *     'id товара' => 'к-во единиц'
         *     'id товара' => 'к-во единиц'
         * );
         * */
        $id = intval($id);
        //Массив для товаров в корзине
        $productsInCart = array();

        //Если в корзине есть товары, мы их считываем в $productsInCart
        if (isset($_SESSION['products'])){
            $productsInCart = $_SESSION['products'];
        }
        //Если товар есть в корзине, но был еще раз добавлен, увеличиваем количество
        if(array_key_exists($id, $productsInCart)){ //проверяет есть ли в масиве идентификатор товара
            $productsInCart[$id]++;
        }else{
            //Добавляем новый товар в корзину
            $productsInCart[$id] = 1;
        }
        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    /*Подсчитывает к-во товаров в корзине (в сессии)*/
    public static function countItems()
    {
        if(isset($_SESSION['products'])){
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity){
                $count = $count + $quantity;
            }
            return $count;
        }else{
            return 0;
        }
    }

    /*Возвращает содержимое сессии, масссив добавленных товаров*/
    public static function getProducts()
    {
        if (isset($_SESSION['products'])){
            return $_SESSION['products'];
        }
        return false;
    }

    /*Возвращает общую стоимость товаров, принимает
    масив товаров по идентификаторах з базы*/
    public static function getTotalPrice($products)
    {
        $productsIdCart = self::getProducts();//Получаем массив из сессии
        $total = 0;

        if($productsIdCart){
            foreach ($products as $item){
                /*у второй умножитель будет подставлятся значение (к-во товаров) по номеру индекса (id товара с базы)*/
                $total += $item['price'] * $productsIdCart[$item['id']];
            }
        }

        return $total;
    }

    /*Очищает корзину*/
    public static function clear()
    {
        if (isset($_SESSION['products'])){
            unset($_SESSION['products']);
        }
    }

    /*Удаляет товар из корзины (сессии)*/
    public static function deleteProduct($id)
    {
        //Получаем масив товаров из сессии
        $products = self::getProducts();
        //Удаляем из масива елемент с указанным id
        unset($products[$id]);
        //Записываем измененный массив обратно в сессию
        $_SESSION['products'] = $products;
    }
}