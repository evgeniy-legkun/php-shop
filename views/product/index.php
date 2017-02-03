<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <?php include ROOT . '/views/layouts/catalog_panel.php'; ?>

                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="view-product">
                                    <img src="<?php echo Product::getImage($product['id'])?>" alt=""/>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="product-information"><!--/product-information-->
                                    <?php if ($product['is_new']): ?>
                                        <img src="/template/images/product-details/new.jpg" class="newarrival" alt=""/>
                                    <?php endif; ?>
                                    <h2><?php echo $product['name']; ?></h2>
                                    <p>Код товара: <?php echo $product['code']; ?></p>
                                    <span>
                                        <span>US $<?php echo $product['price']; ?></span>
                                        <label>Количество: <input type="text" value="1"/></label>
                                        <a href="#" data-id="<?php echo $product['id']; ?>"
                                           class="btn btn-default add-to-cart cart">
                                            <i class="fa fa-shopping-cart"></i> В корзину
                                        </a>

                                    </span>
                                    <p><b>Наличие: </b>
                                        <?php echo Product::getAvailabilityText($product['availability']); ?>
                                    </p>
                                    <p><b>Состояние:</b> Новое</p>
                                    <p><b>Производитель:</b> <?php echo $product['brand']; ?></p>
                                </div><!--/product-information-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>Описание товара</h5>
                                <p>Разнообразный и богатый опыт постоянный количественный рост и
                                    сфера нашей активности требуют определения и уточнения направлений
                                    прогрессивного развития. Таким образом реализация намеченных плановых
                                    заданий требуют определения и уточнения форм развития.</p>
                                <p>Повседневная практика показывает, что новая модель организационной
                                    деятельности способствует подготовки и реализации позиций, занимаемых
                                    участниками в отношении поставленных задач. Таким образом постоянное
                                    информационно-пропагандистское обеспечение нашей деятельности влечет
                                    за собой процесс внедрения и модернизации форм развития.</p>
                                <p>Повседневная практика показывает, что новая модель организационной
                                    деятельности способствует подготовки и реализации позиций, занимаемых
                                    участниками в отношении поставленных задач. Таким образом постоянное
                                    информационно-пропагандистское обеспечение нашей деятельности влечет
                                    за собой процесс внедрения и модернизации форм развития.</p>
                                <p>Повседневная практика показывает, что новая модель организационной
                                    деятельности способствует подготовки и реализации позиций, занимаемых
                                    участниками в отношении поставленных задач. Таким образом постоянное
                                    информационно-пропагандистское обеспечение нашей деятельности влечет
                                    за собой процесс внедрения и модернизации форм развития.</p>
                            </div>
                        </div>
                    </div><!--/product-details-->

                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>