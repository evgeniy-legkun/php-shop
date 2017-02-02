<?php

class Order
{
    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        /*$products - массив продуктов из корзины
         * Мы не можем передать в базу масив, $products преобразуем
         * в строку через json_encode()*/
        $products = json_encode($products);

        $db = Db::getConnection();
        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products)'
                .'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';
        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':products', $products, PDO::PARAM_STR);

        return $result->execute();//Вернет true в случае успешного выполнения
    }

    /*возвращает масив заказов (только со status 1, 2, 3, 4)*/
    public static function getOrdersList()
    {
        $db = Db::getConnection();
        $ordersList = array();
        $sql = 'SELECT id, user_name, user_phone, user_id, date, status FROM product_order WHERE status=\'1\' '
               .'OR status=\'2\' OR status=\'3\' OR status=\'4\' ORDER BY id DESC';
        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch()){
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['user_id'] = $row['user_id'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }

        return $ordersList;
    }

    /*Удаляем заказ с указанным id*/
    /*@return boolean*/
    public static function deleteOrderById($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM product_order WHERE id= :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /*Возвращает информацию об заказе по Id*/
    public static function getOrderById($id)
    {
        $id = intval($id);

        if($id){
            $db = Db::getConnection();
            $sql = 'SELECT * FROM product_order WHERE id= :id';
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
        return false;
    }

    /*Редактирует заказ по id
     *@param integer Id заказа
     *@param array Масив с информацией о заказе
     *@return Возвращает результат выполнения запроса (true, false)
    */
    public static function updateOrderById($id, $options)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE product_order SET user_name= :user_name, user_phone= :user_phone, '
              .'user_comment= :user_comment, date= :date, status= :status WHERE id= :id;';
        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $options['user_name'], PDO::PARAM_STR);
        $result->bindParam(':user_phone', $options['user_phone'], PDO::PARAM_STR);
        $result->bindParam(':user_comment', $options['user_comment'], PDO::PARAM_STR);
        $result->bindParam(':date', $options['date'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /*Возвращает текстовое значение статуса заказа
    *1 - Новый заказ; 2 - В обработке; 3 - Доставляется; 4 - Закрыт
    *@param integer $status
    *@return string Текстовое сообщение
    */
    public static function getStatusText($status)
    {
        switch ($status){
            case '1':
                return 'Новый заказ';
                break;
            case '2':
                return 'В обработке';
                break;
            case '3':
                return 'Доставляется';
                break;
            case '4':
                return 'Закрыт';
                break;
            default:
                return 'Неизвестный статут';
                break;
        }
    }

}