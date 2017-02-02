<?php

class CatalogController
{
    /*Каталог товаров*/
    public function actionIndex($page = 1)
    {
        $categories = Category::getCategoryList();

        preg_match('/\d+/', $page, $matches); //извлекаем из $page номер страницы, он запишется в $matches[0]
        $latestProducts = Product::getLatestProducts($matches[0]);
        $total = Product::getTotalProducts(); //узнаем к-во всех товаров
        //создаем обьект Pagination - для постраничной навигации
        $pagination = new Pagination($total, $matches[0], Product::SHOW_BY_DEFAULT, 'page-');

        require_once (ROOT.'/views/catalog/index.php');
        return true;
    }

    /*Товары определенной категории*/
    public function actionCategory($categoryId, $page = 1)
    {
        $categories = Category::getCategoryList();
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        $total = Product::getTotalProductsInCategory($categoryId); //к-во товара текущей категории
        //создаем обьект Pagination - для постраничной навигации
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once (ROOT.'/views/catalog/category.php');
        return true;
    }
}