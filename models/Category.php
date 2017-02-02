<?php

class Category
{
    /*возвращает масив категорий (только со status=1)*/
    public static function getCategoryList()
    {
        $db = Db::getConnection();
        $categoryList = array();
        $sql = 'SELECT id, name, special_category FROM category WHERE status=\'1\' ORDER BY sort_order ASC';
        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch()){
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['special_category'] = $row['special_category'];
            $i++;
        }

        return $categoryList;
    }

    /*Возвращает масив категорий для списка в админпанели*/
    /*@return array Вернет категории всех статусов (неактивные тоже)*/
    public static function getCategoryListAdmin()
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, name, sort_order, status, special_category FROM category ORDER BY sort_order ASC';
        $result = $db->query($sql);

        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()){
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $categoryList[$i]['special_category'] = $row['special_category'];
            $i++;
        }

        return $categoryList;
    }

    /*Создает новую категорию*/
    public static function createCategory($options)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO category (name, sort_order, status) VALUES (:name, :sort_order, :status)';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

         return $result->execute();
    }

    /*Удаляем категорию с указанным id*/
    /*@return boolean*/
    public static function deleteCategoryById($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM category WHERE id= :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /*Возвращает информацию об категории по Id*/
    public static function getCategoryById($id)
    {
        $id = intval($id);
        if($id){
            $db = Db::getConnection();
            $sql = 'SELECT * FROM category WHERE id= :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
        return false;
    }

    /*Редактирует категорию по id
     *@param integer Id категории
     *@param array Масив с информацией о категории
     *@return Возвращает результат выполнения запроса (true, false)
    */
    public static function updateCategoryById($id, $options)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE category SET name= :name, sort_order= :sort_order, status= :status WHERE id= :id;';
        $result = $db->prepare($sql);

        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

}

