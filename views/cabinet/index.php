<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <h2>Кабинет пользователя</h2>
            <h3>Привет, <?php echo $user['name'];?> !</h3>
            <br />
            <ul>
                <li><a href="/cabinet/edit">Редактировать данные</a></li>
                <li><a href="/cabinet/history/<?php echo $user['id'];?>">Список заказов</a></li>
            </ul>
        </div>
    </div>
</section>

<?php for ($i = 0; $i < 17; $i++) echo '<br />' ?>

<?php include ROOT . '/views/layouts/footer.php'; ?>
