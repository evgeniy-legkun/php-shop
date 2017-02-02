<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <?php include ROOT . '/views/layouts/catalog_panel.php'; ?>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Корзина</h2>

                    <?php if ($productsInCart): ?>
                        <h5>Вы выбрали такие товары:</h5>
                        <table class="table-bordered table-striped table">
                            <tr>
                                <th>Код товара</th>
                                <th>Название</th>
                                <th>Стоимость, USD</th>
                                <th>Количество, шт.</th>
                                <th>Удалить</th>
                            </tr>
                            <?php foreach ($products as $product):?>
                                <tr>
                                    <td><?php echo $product['code'];?></td>
                                    <td>
                                        <a href="/product/<?php echo $product['id']?>">
                                            <?php echo $product['name'];?>
                                        </a>
                                    </td>
                                    <td><?php echo $product['price']; ?></td>
                                    <td><?php echo $productsInCart[$product['id']]; ?></td>
                                    <td style="text-align: center;">
                                        <a href="/cart/delete/<?php echo $product['id']; ?>">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            <tr>
                                <td colspan="2">Общие:</td>
                                <td><?php echo $totalPrice; ?></td>
                                <td><?php echo Cart::countItems(); ?></td>
                                <td></td>
                            </tr>
                        </table>
                        <a class="btn btn-default checkout" href="/cart/checkout">
                            <i class="fa fa-shopping-cart"></i> Оформить заказ
                        </a>
                        <br/><br/>
                    <?php else: ?>
                        <h3 style="text-align: center">Корзина пуста</h3>
                        <a class="btn btn-default checkout" href="/catalog/">
                            <i class="fa fa-shopping-cart"></i> Вернуться к покупкам
                        </a>
                    <?php endif;?>

                </div>
            </div><!--features_items-->
        </div>
    </div>
</section>
<?php for ($i = 0; $i < 7; $i++) echo '<br />' ?>

<?php include ROOT . '/views/layouts/footer.php'; ?>
