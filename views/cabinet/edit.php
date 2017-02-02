<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if ($result): ?>
                    <p>Данные отредактированы !</p>
                    <?php for ($i = 0; $i < 12; $i++) echo '<br />' ?>
                <?php else: ?>
                    <!--Вывод информации об ошибках-->
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="signup-form">
                        <h2>Редактирование данных</h2>
                        <form action="#" method="post">
                            <p>Новое имя: </p>
                            <input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>"/>
                            <p>Новый пароль: </p>
                            <input type="password" name="password" placeholder="Новый пароль" value=""/>
                            <p>Повторите пароль: </p>
                            <input type="password" name="second_password" placeholder="Повторите пароль" value=""/>
                            <br />
                            <button type="submit" name="submit" class="btn btn-default">Сохранить</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php for ($i = 0; $i < 10; $i++) echo '<br />' ?>

<?php include ROOT . '/views/layouts/footer.php'; ?>
