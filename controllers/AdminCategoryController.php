<?php

/*Управление категориями в админпанели*/
class AdminCategoryController extends AdminBase
{
    /*Action страницы управления категориями*/
    public function actionIndex()
    {
        //Проверка доступа
        self::checkAdmin();
        //Получаем список категорий
        $categoriesList = Category::getCategoryListAdmin();

        require_once (ROOT.'/views/admin_category/index.php');
        return true;
    }

    /*Action страницы "Удалить категорию"*/
    /*удаление по id категории*/
    public function actionDelete($id)
    {
        //Проверка доступа
        self::checkAdmin();
        //Обработка формы
        if (isset($_POST['submit'])){

            //Если форма отправлена удаляем категорию
            Category::deleteCategoryById($id);
            //Перенаправление на страницу управления категориями
            header("Location: /admin/category/");
        }

        require_once (ROOT.'/views/admin_category/delete.php');
        return true;
    }

    /*Страница добавления категории*/
    public function actionCreate()
    {
        //Проверка доступа
        self::checkAdmin();
        //Флаг ошибок в форме (для валидации)
        $errors = false;
        //Если форма была отправлена
        if (isset($_POST['submit'])){
            //получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];

            if (!isset($options['name']) || empty($options['name'])){
                $errors[] = 'введите название категории';
            }
            if (!isset($options['sort_order']) || empty($options['sort_order'])){
                $errors[] = 'введите порядковый номер';
            }
            if (!isset($options['status']) || empty($options['status'])){
                $errors[] = 'введите статус категории';
            }
            //Если ошибок нет
            if ($errors == false){
                //Добавляем новую категорию
                Category::createCategory($options);
                //Перенаправляем на страницу управления категориями
                header("Location: /admin/category/");
            }
        }

        require_once (ROOT.'/views/admin_category/create.php');
        return true;
    }

    /*Страница "Редактировать категорию"*/
    public function actionUpdate($id)
    {
        //Проверка доступа
        self::checkAdmin();
        //Получаем данные о конкретной категории
        $category = Category::getCategoryById($id);

        //Если форма была отправлена
        if (isset($_POST['submit'])){
            //получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];
            //Сохраняем изминения
            Category::updateCategoryById($id, $options);
            //Перенаправляем на страницу управления категориями
            header("Location: /admin/category/");
        }

        require_once (ROOT.'/views/admin_category/update.php');
        return true;
    }

}