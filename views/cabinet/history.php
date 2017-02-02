<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
            <h4>Список заказов</h4>
            <p>Пользователь <?php echo $user['name'] ?>, ID # <?php echo $user['id'] ?></p>
            <br/>
            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID заказа</th>
                    <th>Дата оформления</th>
                    <th>Статус</th>
                    <th></th>
                </tr>
                <?php foreach ($ordersList as $order): ?>
                    <?php if ($order['user_id'] == $user['id']): ?>
                        <tr>
                            <td><?php echo $order['id'] ?></td>
                            <td><?php echo $order['date'] ?></td>
                            <td><?php echo Order::getStatusText($order['status']); ?></td>
                            <td style="text-align: center;">
                                <a href="/cabinet/history/view/<?php echo $order['id'] ?>"
                                   title="Просморт заказа"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
                <br />
                <a href="/cabinet/" class="btn btn-default back">
                    <i class="fa fa-arrow-left"></i> Назад</a>
            </div>
        </div>
    </div>
</section>

<?php for ($i = 0; $i < 15; $i++) echo '<br />' ?>

<?php include ROOT . '/views/layouts/footer.php'; ?>
