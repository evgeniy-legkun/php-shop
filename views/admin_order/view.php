<?php include ROOT . '/views/layouts/admin_header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <div>
                    <br/>
                    <a href="/admin/" class="btn btn-info">Админпанель</a>
                    <a href="/admin/order/" class="btn btn-info">Управление заказами</a>
                    <a href="/admin/order/view/<?php echo $id; ?>" class="btn btn-link">Просмотр заказа</a>
                </div>
                <br/><br/>

                <h3>Информация о заказе ID # <?php echo $id; ?></h3>
                <br/>

                <div class="col-lg-11">
                    <table class="table table-striped table-bordered table-admin-small">
                        <tr>
                            <td>ID заказа</td>
                            <td><?php echo $order['id']; ?></td>
                        </tr>
                        <tr>
                            <td>Имя клиента</td>
                            <td><?php echo $order['user_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Телефон клиента</td>
                            <td><?php echo $order['user_phone']; ?></td>
                        </tr>
                        <tr>
                            <td>Коментарий клиента</td>
                            <td><?php echo $order['user_comment']; ?></td>
                        </tr>
                        <?php if ($order['user_id'] != 0): ?>
                        <tr>
                            <td>ID клиента</td>
                            <td><?php echo $order['user_id']; ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td><b>Статус заказа</b></td>
                            <td><?php echo Order::getStatusText($order['status']); ?></td>
                        </tr>
                        <tr>
                            <td><b>Дата заказа</b></td>
                            <td><?php echo $order['date']; ?></td>
                        </tr>
                    </table>
                    <br />

                    <h4>Товары в заказе</h4>
                    <table class="table-bordered table-striped table">
                        <tr>
                            <th>ID товара</th>
                            <th>Артикул товара</th>
                            <th>Название</th>
                            <th>Цена, USD</th>
                            <th>Количество</th>
                        </tr>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo $product['id']; ?></td>
                                <td><?php echo $product['code']; ?></td>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td><?php echo $productsInOrder[$product['id']]; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <br />
                    <a href="/admin/order/" class="btn btn-default back">
                        <i class="fa fa-arrow-left"></i> Назад</a>

                    <br /><br /><br /><br />
                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/admin_footer.php'; ?>