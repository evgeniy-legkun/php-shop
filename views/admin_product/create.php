<?php include ROOT . '/views/layouts/admin_header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div>
                <br />
                <a href="/admin/" class="btn btn-info">Админпанель</a>
                <a href="/admin/product/" class="btn btn-info">Управление товарами</a>
                <a href="/admin/product/create/" class="btn btn-link">Добавить товар</a>
            </div>
            <br /><br />

            <h3>Добавить новый товар</h3>
            <br />
            <!--Вывод информации об ошибках-->
            <?php if ($errors):?>
                <?php foreach ($errors as $error): ?>
                    <h5> - <?php echo $error; ?></h5>
                <?php endforeach;?>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
<!--                    multipart/form-data - атрибут для поддержки формой отправки файлов-->
                    <form action="#" method="post" enctype="multipart/form-data">
                        <br/>
                        <h5>Название товара</h5>
                        <input type="text" name="name" placeholder="" value=""/>

                        <h5>Код товара</h5>
                        <input type="text" name="code" placeholder="" value=""/>

                        <h5>Стоимость, USD</h5>
                        <input type="number" name="price" placeholder="" value=""/>

                        <h5>Категория</h5>
                        <select name="category_id" title="Вибор категории товара">
                            <option></option>
                            <?php if (is_array($categoryList)): ?>
                                <?php foreach ($categoryList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach;?>
                            <?php endif; ?>
                        </select>

                        <h5>Производитель</h5>
                        <input type="text" name="brand" placeholder="" value=""/>

                        <h5>Картинка с товаром (размер 268х249)</h5>

                        <input type="file" name="image" placeholder="" value=""/>

                        <h5>Описание товара</h5>
                        <textarea name="description" title="Описание товара"></textarea>

                        <h5>Наличие на складе</h5>
                        <select name="availability" title="Наличие на складе">
                            <option value="1" selected>Да</option>
                            <option value="0">Нет</option>
                        </select>

                        <h5>Новинка</h5>
                        <select name="is_new" title="Новинка">
                            <option value="1" selected>Да</option>
                            <option value="0">Нет</option>
                        </select>

                        <h5>Рекомендуемые</h5>
                        <select name="is_recommended" title="Рекомендуемые">
                            <option value="1">Да</option>
                            <option value="0" selected>Нет</option>
                        </select>

                        <h5>Статус</h5>
                        <select name="status" title="Статус">
                            <option value="1" selected>Отображается</option>
                            <option value="0">Скрыт</option>
                        </select>

                        <br /><br />
                        <button type="submit" name="submit" class="btn btn-info active">
                            <i class="fa fa-floppy-o"></i> Сохранить</button>
                        <br /><br />
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/admin_footer.php'; ?>