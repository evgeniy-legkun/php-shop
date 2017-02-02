<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <h4>Заказ ID # <?php echo $id; ?></h4>
                <br/>
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
                            <td>
                                <a href="/product/<?php echo $product['id']; ?>">
                                    <?php echo $product['name']; ?>
                                </a>
                            </td>
                            <td><?php echo $product['price']; ?></td>
                            <td><?php echo $productsInOrder[$product['id']]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <br />
                <a href="/cabinet/history/<?php echo $user['id']; ?>" class="btn btn-default back">
                    <i class="fa fa-arrow-left"></i> Назад</a>
            </div>
        </div>
    </div>
</section>

<?php for ($i = 0; $i < 15; $i++) echo '<br />' ?>

<?php include ROOT . '/views/layouts/footer.php'; ?>
