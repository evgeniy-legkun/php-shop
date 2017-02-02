<?php include ROOT . '/views/layouts/admin_header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div>
                <br />
                <a href="/admin/" class="btn btn-info">Админпанель</a>
                <a href="/admin/category/" class="btn btn-info">Управление категориями</a>
                <a href="/admin/category/update/<?php echo $id; ?>" class="btn btn-link">Редактировать категорию</a>
            </div>
            <br /><br />

            <h3>Редактировать категорию с ID # <?php echo $id; ?></h3>
            <br />

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <br/>
                        <h5>Название категории</h5>
                        <input type="text" name="name" placeholder="" value="<?php echo $category['name']; ?>"/>

                        <h5>Порядковый номер</h5>
                        <input type="number" name="sort_order" placeholder="" value="<?php echo $category['sort_order']; ?>"/>

                        <h5>Статус</h5>
                        <select name="status" title="Статус">
                            <option value="1" <?php if ($category['status'] == 1) echo 'selected'; ?>>Отображается</option>
                            <option value="0" <?php if ($category['status'] == 0) echo 'selected'; ?>>Скрыт</option>
                        </select>

                        <br /><br />
                        <button type="submit" name="submit" class="btn btn-info active">
                            <i class="fa fa-floppy-o"></i> Сохранить</button>
                        <br /><br /><br /><br /><br /><br />
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/admin_footer.php'; ?>