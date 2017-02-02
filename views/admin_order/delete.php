<?php include ROOT . '/views/layouts/admin_header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div>
                <br />
                <a href="/admin/" class="btn btn-info">Админпанель</a>
                <a href="/admin/order/" class="btn btn-info">Управление заказами</a>
                <a href="/admin/order/delete/<?php echo $id; ?>" class="btn btn-link">Удалить заказ</a>
            </div>
            <br /><br />

            <h4>Удалить заказ с ID # <?php echo $id; ?></h4>
            <p>Вы действительно хотите удалить этот заказ ?</p>
            <br />
            <form method="post">
                <button type="submit" name="submit"><i class="fa fa-times"></i> Удалить</button>
            </form>

        </div>
    </div>
</section>

