<?php include ROOT . '/views/layouts/admin_header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div>
                <br />
                <a href="/admin/" class="btn btn-info">Админпанель</a>
                <a href="/admin/product/" class="btn btn-info">Управление товарами</a>
                <a href="/admin/product/delete/<?php echo $id; ?>" class="btn btn-link">Удалить товар</a>
            </div>
            <br /><br />

            <h4>Удалить товар # <?php echo $id; ?></h4>
            <p>Вы действительно хотите удалить этот товар ?</p>
            <br />
            <form method="post">
                <button type="submit" name="submit"><i class="fa fa-times"></i> Удалить</button>
            </form>

        </div>
    </div>
</section>

