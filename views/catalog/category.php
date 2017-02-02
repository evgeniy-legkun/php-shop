<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <?php include ROOT . '/views/layouts/catalog_panel.php'; ?>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Все товары</h2>
                    <?php if ($total == 0): ?>
                        <div class="signup-form">
                        <h4>В данной категории пока нет товаров :(</h4>
                        <h4>Но скоро обязательно будут :)</h4>
                        <img src="<?php echo Product::getImage('no_products')?>" alt=""/>
                        </div>
                        <?php for ($i = 0; $i < 5; $i++) echo '<br />' ?>
                    <?php endif; ?>
                    <?php foreach ($categoryProducts as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?php echo Product::getImage($product['id'])?>" alt=""/>
                                        <h2><?php echo $product['price']; ?>$</h2>
                                        <p>
                                            <a href="/product/<?php echo $product['id']; ?>">
                                                <?php echo $product['name'].' '. $product['code'];?>
                                            </a>
                                        </p>
                                        <a href="#" data-id="<?php echo $product['id']; ?>"
                                           class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>В корзину
                                        </a>
                                    </div>
                                    <?php if ($product['is_new']): ?>
                                        <img src="/template/images/products/new.png" class="new" alt=""/>
                                    <?php endif; ?>
                                    <br />
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div><!--features_items-->
                <!--Постраничная навигация-->
                <?php echo $pagination->get();?>

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
