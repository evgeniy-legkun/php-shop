<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if ($result): ?>
                    <p>Сообщение отправлено ! Мы ответим вам на указанный email.</p>
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
                        <h2>Обратная связь</h2>
                        <h5>Есть вопрос ? Напишите его нам !</h5>
                        <br />
                        <form action="#" method="post">
                            <p>Ваша почта: </p>
                            <input type="email" name="userEmail" placeholder="E-mail" />
                            <p>Сообщение: </p>
                            <textarea name="userText" placeholder="Сообщение"></textarea>
                            <br />
                            <br />
                            <input type="submit" name="submit" class="btn btn-default" value="Отправить" />
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php for ($i = 0; $i < 8; $i++) echo '<br />' ?>

<?php include ROOT . '/views/layouts/footer.php'; ?>
