<?php include ROOT . '/views/layouts/admin_header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div>
                <br />
                <a href="/admin/" class="btn btn-info">Админпанель</a>
                <a href="/admin/category/" class="btn btn-link">Управление категориями</a>
            </div>
            <br /><br />
            <a href="/admin/category/create/" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить категорию</a>
            <br /><br />
            <h4>Список категорий</h4><br />
            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID категории</th>
                    <th>Название категории</th>
                    <th>Порядковый номер</th>
                    <th>Статус</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($categoriesList as $category): ?>
                <tr>
                    <td><?php echo $category['id']?></td>
                    <td><?php echo $category['name']?></td>
                    <td><?php echo $category['sort_order']?></td>
                    <td><?php echo $category['status']?></td>
                    <td style="text-align: center;">
                        <a href="/admin/category/update/<?php echo $category['id'] ?>"
                           title="Редактировать"><i class="fa fa-pencil-square"></i></a>
                    </td>
                    <td style="text-align: center;">
                        <a href="/admin/category/delete/<?php echo $category['id'] ?>"
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
