<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if ($result): ?>
                    <p>Вы зарегистрированы !</p>
                <?php endif; ?>
                <!--Вывод информации об ошибках-->
                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <div class="signup-form">
                    <h2>Регистрация на сайте</h2>
                    <form action="#" method="post">
                        <p>Имя:</p>
                        <input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>"/>
                        <p>Email:</p>
                        <input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>"/>
                        <p>Пароль:</p>
                        <input type="password" name="password" placeholder="Пароль" />
                        <p>Повторите пароль:</p>
                        <input type="password" name="second_password" placeholder="Повторите пароль" />
                        <br />
                        <button type="submit" name="submit" class="btn btn-default">Регистрация</button>
                    </form>
                </div>

                <?php for ($i = 0; $i < 12; $i++) echo '<br />' ?>

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
