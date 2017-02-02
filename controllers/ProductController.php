<?php

class ProductController
{
    /*Action для страницы просмотра товара
    @param integer $productId id товара*/
    public function actionView($id)
    {
        $categories = Category::getCategoryList();
        $product = Product::getProductById($id);

        require_once(ROOT . '/views/product/index.php');
        return true;
    }

}


