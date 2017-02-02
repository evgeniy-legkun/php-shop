<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <?php include ROOT . '/views/layouts/catalog_panel.php'; ?>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>

                    <?php foreach ($latestProducts as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?php echo Product::getImage($product['id'])?>" alt=""/>
                                        <h2><?php echo $product['price']; ?>$</h2>
                                        <p>
                                            <a href="/product/<?php echo $product['id']; ?>">
                                                <?php echo $product['name'] . ' ' . $product['code']; ?>
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
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div><!--features_items-->

                <!--recommended_items-->
                <div class="recommended_items">
                    <h2 class="title text-center">Рекомендуемые товары</h2>

                    <!--Подключение и настройка карусели-->
                    <div class="cycle-slideshow"
                         data-cycle-fx=carousel
                         data-cycle-timeout=5000
                         data-cycle-carousel-visible=3
                         data-cycle-carousel-fluid=true
                         data-cycle-slides="div.item"
                         data-cycle-prev="#prev"
                         data-cycle-next="#next">
                        <!--Блоки слайдов-->
                        <?php foreach ($sliderProducts as $sliderItem): ?>
                            <div class="item">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="<?php echo Product::getImage($sliderItem['id'])?>"
                                                 alt=""/>
                                            <h2><?php echo $sliderItem['price']; ?>$</h2>
                                            <p>
                                                <a href="/product/<?php echo $sliderItem['id']; ?>">
                                                    <?php echo $sliderItem['name'] . ' ' . $sliderItem['code']; ?>
                                                </a>
                                            </p>
                                            <a href="#" data-id="<?php echo $sliderItem['id']; ?>"
                                               class="btn btn-default add-to-cart">
                                                <i class="fa fa-thumbs-o-up"></i>В корзину
                                            </a>
                                        </div>
                                        <!--Добавляем значек для новых товаров-->
                                        <?php if ($sliderItem['is_new']):?>
                                            <img src="/template/images/products/new.png"
                                                 class="new" alt="" />
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!--Блоки слайдов-->
                        <!--Стрелки для прокрутки-->
                        <a class="left recommended-item-control" id="prev" href="#recommended-item-carousel"
                           data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" id="next" href="#recommended-item-carousel"
                           data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>

                    </div>
                </div>
                <!--/recommended_items-->
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
