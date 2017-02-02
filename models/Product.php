<?php

class Product
{
    const SHOW_BY_DEFAULT = 6;

    /*возвращает количество продуктов определенное SHOW_BY_DEFAULT ибо первым параметром (если он передан)*/
    public static function getLatestProducts($page = 1, $count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);
        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT; //вычисляем смещение (для постраничной навигации)

        $db = Db::getConnection();
        $productsList = array();

        $sql = 'SELECT id, name, code, price, is_new FROM product '
               .'WHERE status = \'1\' '
               .'ORDER BY id DESC '
               .'LIMIT :count '
               .' OFFSET :offset';
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        while ($row = $result->fetch()){
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productsList;
    }

    /*возвращает масив продуктов определенной категории*/
    public static function getProductsListByCategory($categoryId = false, $page = 1)
    {
        if($categoryId){ //если есть categoryId
            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT; //вычисляем смещение (для постраничной навигации)
            $showByDefault = self::SHOW_BY_DEFAULT;//для передачи в bindParam(), только переменные принимает

            $db = Db::getConnection();
            $products = array();

            $sql = 'SELECT id, name, code, price, is_new FROM product '
                   .'WHERE status = \'1\' AND category_id = :categoryId '
                   .'ORDER BY id DESC '
                   .'LIMIT :SHOW_BY_DEFAULT'
                   .' OFFSET :offset';
            $result = $db->prepare($sql);
            $result->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
            $result->bindParam(':SHOW_BY_DEFAULT', $showByDefault, PDO::PARAM_INT);
            $result->bindParam(':offset', $offset, PDO::PARAM_INT);
            $result->execute();

            $i = 0;
            while ($row = $result->fetch()){
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['code'] = $row['code'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }

            return $products;
        }
    }

    /*возвращает продукт по id*/
    public static function getProductById($id)
    {
        $id = intval($id);
        if($id){
            $db = Db::getConnection();
            $sql = 'SELECT * FROM product WHERE id= :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
    }

    public static function getProductsByIds($idsArray)
    {
        if($idsArray){
            $db = Db::getConnection();
            //формируем из масива строку с разделителем ','
            $idsString = implode(',', $idsArray);

            $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";
            $result = $db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            //массив для хранения информации о продуктах (с базы)
            $products = array();
            $i = 0;
            while ($row = $result->fetch()){
                $products[$i]['id'] = $row['id'];
                $products[$i]['code'] = $row['code'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $i++;
            }

            return $products;
        }
    }

    /*возвращает к-во товаров определенной категории*/
    public static function getTotalProductsInCategory($categoryId)
    {
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(id) AS count FROM product WHERE status=\'1\' '.
                  'AND category_id= :categoryId';
        $result = $db->prepare($sql);
        $result->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $row = $result->fetch();//в $row будет масив с одним елементом, и индексом 'count'

        return $row['count'];
    }

    /*Возвращает количество товаров в базе*/
    public static function getTotalProducts()
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT COUNT(id) AS count FROM product WHERE status=\'1\'');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();//в $row будет масив с одним елементом, и индексом 'count'

        return $row['count'];
    }

    /*Возвращает массив рекомендуемых товаров*/
    public static function getRecommendedProducts()
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT id, name, code, price, is_new FROM product '
            . 'WHERE status = \'1\' AND is_recommended = \'1\''
            . 'ORDER BY id DESC ');
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productsList;
    }

    /*Возвращает все товары с базы (но только указанные колонки)*/
    public static function getProductsList()
    {
        $db = Db::getConnection();
        //Получение и возврат результатов
        $result = $db->query('SELECT id, name, code, price FROM product ORDER BY id ASC');
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }
        return $productsList;
    }

    /*Удаляем товар с указанным id*/
    /*@return boolean*/
    public static function deleteProductById($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM product WHERE id=:id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /*Добавляет новый товар в базу*/
    /*Принимает масив с информацией о товаре*/
    /*@return integer Возвращает id последней добавленной в таблицу записи*/
    public static function createProduct($options)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO product (name, code, price, category_id, brand, description, '
                .'availability, is_new, is_recommended, status) '
                .'VALUES (:name, :code, :price, :category_id, :brand, '
                .':description, :availability, :is_new, :is_recommended, :status)';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_INT);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute()){
            //Если запрос выполнился возвращаем id последней добавленной записи (вставленной строки)
            return $db->lastInsertId();
        }
        return 0;
    }

    /*Редактирует товар с полученным id
     *@param integer Id товара
     *@param array Масив с информацией о товаре
     *@return Возвращает результат выполнения запроса (true, false)
    */
    public static function updateProductById($id, $options)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE product SET name= :name, code= :code, price= :price, category_id= :category_id, '
             .'brand= :brand, availability= :availability, description= :description, is_new= :is_new, '
             .'is_recommended= :is_recommended, status= :status WHERE id= :id;';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_INT);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /*Возвращает путь к изображению с указанным именем*/
    public static function getImage($id)
    {
        //Название постого изображения
        $noImage = 'no-image.jpg';
        //Путь к папке с изображениями
        $path = '/template/images/products/';
        //Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';
        //Если изображение по пути существует, то возвращаем путь к изображению
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)){
            return $pathToProductImage;
        }
        return $path.$noImage;
    }

    /* Возвращает текстое пояснение наличия товара
     * 0 - Под заказ, 1 - В наличии*/
    public static function getAvailabilityText($availability)
    {
        switch ($availability) {
            case '1':
                return 'В наличии';
                break;
            case '0':
                return 'Под заказ';
                break;
            default:
                return 'Уточните у менеджера';
                break;
        }
    }

}

