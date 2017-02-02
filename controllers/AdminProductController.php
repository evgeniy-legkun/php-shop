<?php

/*Управление товарами в админпанели*/
class AdminProductController extends AdminBase
{
    /*Action страницы управления товарами*/
    public function actionIndex()
    {
        //Проверка доступа
        self::checkAdmin();
        //Получаем список товаров
        $productsList = Product::getProductsList();

        require_once (ROOT.'/views/admin_product/index.php');
        return true;
    }

    /*Action страницы "Удалить товар"*/
    /*удаление по id товара*/
    public function actionDelete($id)
    {
        //Проверка доступа
        self::checkAdmin();
        //Обработка формы
        if (isset($_POST['submit'])){

            //Если форма отправлена удаляем товар
            Product::deleteProductById($id);
            //Перенаправление на страницу управления товарами
            header("Location: /admin/product");
        }

        require_once (ROOT.'/views/admin_product/delete.php');
        return true;
    }

    /*Страница добавления товара*/
    public function actionCreate()
    {
        //Проверка доступа
        self::checkAdmin();
        //Список категорий для выпадающего списка
        $categoryList = Category::getCategoryListAdmin();
        //Флаг ошибок в форме (для валидации)
        $errors = false;
        //Если форма была отправлена
        if (isset($_POST['submit'])){
            //получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['description'] = $_POST['description'];
            $options['availability'] = $_POST['availability'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            if (!isset($options['name']) || empty($options['name'])){
                $errors[] = 'введите название товара';
            }
            if (!isset($options['code']) || empty($options['code'])){
                $errors[] = 'введите код товара';
            }
            if (!isset($options['price']) || empty($options['price'])){
                $errors[] = 'введите цену товара';
            }
            if (!isset($options['category_id']) || empty($options['category_id'])){
                $errors[] = 'выберите категорию товара';
            }
            if (!isset($options['brand']) || empty($options['brand'])){
                $errors[] = 'введите производителя товара';
            }
            //Если ошибок нет
            if ($errors == false){
                /*Добавляем новый товар
                В случае успеха получаем id последней добавленной записи*/
                $id = Product::createProduct($options);
                //Если id получено (товар добавлен)
                if ($id){
                    if (is_uploaded_file($_FILES['image']['tmp_name'])){
                        //если загружалось переместим его в нужную папку, дадим новое имя
                        move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT']
                            ."/template/images/products/{$id}.jpg");
                    }
                }
                //Перенаправляем на страницу управления товарами
                header("Location: /admin/product/");
            }
        }

        require_once (ROOT.'/views/admin_product/create.php');
        return true;
    }

    /*Страница "Редактировать товар"*/
    public function actionUpdate($id)
    {
        //Проверка доступа
        self::checkAdmin();
        //Список категорий для выпадающего списка
        $categoryList = Category::getCategoryListAdmin();

        //Получаем данные о конкретном товаре
        $product = Product::getProductById($id);

        //Если форма была отправлена
        if (isset($_POST['submit'])){
            //получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['description'] = $_POST['description'];
            $options['availability'] = $_POST['availability'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];
            //Сохраняем изминения
            if (Product::updateProductById($id, $options)) {
                /*Если запись сохранена, проверяем не загружалось ли через форму изображение*/
                if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                    //если загружалось переместим его в нужную папку, дадим новое имя
                    move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT']
                        ."/template/images/products/{$id}.jpg");
                }
            }
            //Перенаправляем на страницу управления товарами
            header("Location: /admin/product/");
        }

        require_once (ROOT.'/views/admin_product/update.php');
        return true;
    }

}