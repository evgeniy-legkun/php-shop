<?php include ROOT . '/views/layouts/admin_header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div>
                <br />
                <a href="/admin/" class="btn btn-info">Админпанель</a>
                <a href="/admin/category/" class="btn btn-info">Управление категориями</a>
                <a href="/admin/category/create/" class="btn btn-link">Добавить категорию</a>
            </div>
            <br /><br />

            <h3>Добавить новую категорию</h3>
            <br />
            <!--Вывод информации об ошибках-->
            <?php if ($errors):?>
                <?php foreach ($errors as $error): ?>
                    <h5> - <?php echo $error; ?></h5>
                <?php endforeach;?>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <br/>
                        <h5>Название категории</h5>
                        <input type="text" name="name" placeholder="" value=""/>

                        <h5>Порядковый номер</h5>
                        <input type="number" name="sort_order" placeholder="" value=""/>

                        <h5>Статус</h5>
                        <select name="status" title="Статус">
                            <option value="1" selected>Отображается</option>
                            <option value="0">Скрыт</option>
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