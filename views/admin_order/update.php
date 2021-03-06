<?php include ROOT . '/views/layouts/admin_header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div>
                <br />
                <a href="/admin/" class="btn btn-info">Админпанель</a>
                <a href="/admin/order/" class="btn btn-info">Управление заказами</a>
                <a href="/admin/order/update/<?php echo $id; ?>" class="btn btn-link">Редактировать заказ</a>
            </div>
            <br /><br />

            <h3>Редактировать заказ с ID # <?php echo $id; ?></h3>
            <br />

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <br/>
                        <h5>Имя клиента</h5>
                        <input type="text" name="user_name" placeholder="" value="<?php echo $order['user_name']; ?>"/>

                        <h5>Телефон клиента</h5>
                        <input type="number" name="user_phone" placeholder=""
                               value="<?php echo $order['user_phone']; ?>"/>

                        <h5>Город</h5>
                        <select name="user_city" title="Город доставки">
                            <option value="0" <?php if ($order['city_delivery'] == 0) echo 'selected'; ?>></option>
                            <option value="1" <?php if ($order['city_delivery'] == 1) echo 'selected'; ?>>Винница</option>
                            <option value="2" <?php if ($order['city_delivery'] == 2) echo 'selected'; ?>>Хмельницкий</option>
                            <option value="3" <?php if ($order['city_delivery'] == 3) echo 'selected'; ?>>Киев</option>
                            <option value="4" <?php if ($order['city_delivery'] == 4) echo 'selected'; ?>>Харьков</option>
                            <option value="5" <?php if ($order['city_delivery'] == 5) echo 'selected'; ?>>Одесса</option>
                            <option value="6" <?php if ($order['city_delivery'] == 6) echo 'selected'; ?>>Львов</option>
                            <option value="7" <?php if ($order['city_delivery'] == 7) echo 'selected'; ?>>Кировоград</option>
                            <option value="8" <?php if ($order['city_delivery'] == 8) echo 'selected'; ?>>Тернополь</option>
                            <option value="9" <?php if ($order['city_delivery'] == 9) echo 'selected'; ?>>Черкасы</option>
                        </select>

                        <h5>Адрес:</h5>
                        <input type="text" name="user_address" placeholder="Улица, дом"
                               value="<?php echo $order['address']; ?>"/>

                        <h5>Комментарий клиента</h5>
                        <textarea name="user_comment"
                                  title="Комментарий клиента"><?php echo $order['user_comment']; ?></textarea>

                        <h5>Дата</h5>
                        <input type="text" name="date" placeholder="" value="<?php echo $order['date']; ?>"/>

                        <h5>Статус</h5>
                        <select name="status" title="Статус заказа">
                            <option value="1" <?php if ($order['status'] == 1) echo 'selected'; ?>>Новый заказ</option>
                            <option value="2" <?php if ($order['status'] == 2) echo 'selected'; ?>>В обработке</option>
                            <option value="3" <?php if ($order['status'] == 3) echo 'selected'; ?>>Доставляется</option>
                            <option value="4" <?php if ($order['status'] == 4) echo 'selected'; ?>>Закрыт</option>
                        </select>

                        <br /><br />
                        <button type="submit" name="submit" class="btn btn-info active">
                            <i class="fa fa-floppy-o"></i> Сохранить</button>
                        <br /><br /><br /><br />
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/admin_footer.php'; ?>