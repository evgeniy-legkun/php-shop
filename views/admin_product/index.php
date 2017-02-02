<?php include ROOT . '/views/layouts/admin_header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div>
                <br />
                <a href="/admin/" class="btn btn-info">Админпанель</a>
                <a href="/admin/product/" class="btn btn-link">Управление товарами</a>
            </div>
            <br /><br />
            <a href="/admin/product/create/" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить товар</a>
            <br /><br />
            <h4>Список товаров</h4><br />
            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID товара</th>
                    <th>Артикул</th>
                    <th>Название товара</th>
                    <th>Цена</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($productsList as $product): ?>
                <tr>
                    <td><?php echo $product['id']?></td>
                    <td><?php echo $product['code']?></td>
                    <td><?php echo $product['name']?></td>
                    <td><?php echo $product['price']?></td>
                    <td style="text-align: center;">
                        <a href="/admin/product/update/<?php echo $product['id'] ?>"
                           title="Редактировать"><i class="fa fa-pencil-square"></i></a>
                    </td>
                    <td style="text-align: center;">
                        <a href="/admin/product/delete/<?php echo $product['id'] ?>"
                           title="Удалить"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
            <br /><br />
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/admin_footer.php'; ?>
