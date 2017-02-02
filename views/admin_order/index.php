<?php include ROOT . '/views/layouts/admin_header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div>
                <br />
                <a href="/admin/" class="btn btn-info">Админпанель</a>
                <a href="/admin/order/" class="btn btn-link">Управление заказами</a>
            </div>

            <br /><br />
            <h4>Список заказов</h4><br />
            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID заказа</th>
                    <th>Имя покупателя</th>
                    <th>Телефон покупателя</th>
                    <th>Дата оформления</th>
                    <th>Статус</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($ordersList as $order): ?>
                <tr>
                    <td><?php echo $order['id']?></td>
                    <td><?php echo $order['user_name']?></td>
                    <td><?php echo $order['user_phone']?></td>
                    <td><?php echo $order['date']?></td>
                    <td><?php echo $order['status']?></td>
                    <td style="text-align: center;">
                        <a href="/admin/order/view/<?php echo $order['id'] ?>"
                           title="Просморт заказа"><i class="fa fa-eye"></i></a>
                    </td>
                    <td style="text-align: center;">
                        <a href="/admin/order/update/<?php echo $order['id'] ?>"
                           title="Редактировать"><i class="fa fa-pencil-square"></i></a>
                    </td>
                    <td style="text-align: center;">
                        <a href="/admin/order/delete/<?php echo $order['id'] ?>"
                           title="Удалить"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
            <br /><br /><br /><br /><br />
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/admin_footer.php'; ?>
