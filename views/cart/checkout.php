<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <?php include ROOT . '/views/layouts/catalog_panel.php'; ?>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Корзина</h2>
                    <div class="col-sm-7 col-sm-offset-1">
                        <!--Проверяем внесен ли заказ в БД. result принимает знасение от Order::save()-->
                        <?php if ($result): ?>
                            <br />
                            <h4>Заказ оформлен :) </h4>
                            <h4>Для уточнения деталей наш менеджер вам передзвонит
                                на указанный номер.</h4>
                            <h4>Спасибо за покупку ! <i class="fa fa-smile-o "></i></h4>
                        <?php else: ?>
                            <!--Вывод информации об ошибках-->
                            <?php if (isset($errors) && is_array($errors)): ?>
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li> - <?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        <br/>
                        <h5>Выбрано товаров: общее количество <?php echo $totalQuantity; ?> шт.
                            на сумму <?php echo $totalPrice; ?> USD.</h5>
                        <p>Для оформления заказа заполните форму.</p>
                        <!--Вывод формы-->
                        <div class="login-form">
                            <form action="#" method="post">
                                <br/>
                                <label>Ваше имя: </label>
                                <input type="text" name="userName" placeholder="" value="<?php echo $userName; ?>"/>

                                <label>Номер телефона:</label>
                                <input type="number" name="userPhone" placeholder=""
                                       value="<?php echo $userPhone; ?>"/>
                                <p>
                                    <label>Город:</label>
                                    <select name="userCity" title="Выберите город доставки" required>
                                        <option value="0" selected></option>
                                        <option value="1">Винница</option>
                                        <option value="2">Хмельницкий</option>
                                        <option value="3">Киев</option>
                                        <option value="4">Харьков</option>
                                        <option value="5">Одесса</option>
                                        <option value="6">Львов</option>
                                        <option value="7">Кировоград</option>
                                        <option value="8">Тернополь</option>
                                        <option value="9">Черкасы</option>
                                    </select>
                                </p>

                                <label>Адрес:</label>
                                <input type="text" name="userAddress" placeholder="Улица, дом" />

                                <label>Комментарий к заказу</label>
                                <textarea name="userComment" placeholder="Сообщение"></textarea>
                                <br/><br/><br/>

                                <input type="submit" name="submit" class="btn btn-default" value="Оформить" />
                                <br/><br/>
                            </form>
                        </div>
                        <?php endif; ?>

                    </div>
                </div><!--features_items-->
            </div>
        </div>
</section>
<?php for ($i = 0; $i < 8; $i++) echo '<br />' ?>

<?php include ROOT . '/views/layouts/footer.php'; ?>
