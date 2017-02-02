<?php

class SiteController
{
    public function actionIndex()
    {
        //Список категорий
        $categories = Category::getCategoryList();
        //Список последних товаров
        $latestProducts = Product::getLatestProducts();//можно передать к-во товаров для отображения
        //Список товаров для слайдера
        $sliderProducts = Product::getRecommendedProducts();
        //Подключаем view
        require_once (ROOT. '/views/site/index.php');
        return true;
    }

    /*отправка письма обратной связи*/
    public function actionContact()
    {
        $userEmail = '';
        $userText = '';
        $result = false;

        if (isset($_POST['submit'])){
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            $errors = false;
            //Валидация email
            if (!User::checkEmail($userEmail)){
                $errors[] = 'Неправильный email !';
            }
            //Проверяем не пустое ли сообщение
            if(!User::checkMessage($userText)){
                $errors[] = 'Сообщение постое !';
            }
            /*если нет ошибок, отправляем письмо, используя mail()*/
            if ($errors == false){
                $adminEmail = 'evgeniy_legkun@ukr.net';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }

        require_once (ROOT.'/views/site/contact.php');
        return true;
    }

    /*Страница "Обо мне"*/
    public function actionAbout()
    {
        $categories = Category::getCategoryList();

        require_once (ROOT.'/views/site/about.php');
        return true;
    }
}

