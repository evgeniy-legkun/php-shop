<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <?php include ROOT . '/views/layouts/catalog_panel.php'; ?>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Обо мне</h2>
                    <div class="col-sm-12">
                        <div class="about-me">
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Добрый день ! Меня зовут Евгений, я начинающий web-разработчик. Мое главное качество:
                            я очень люблю все что связано с web-разработкой, особенно back end. Для меня это и
                            отдых, и работа, и развлечение. Считаю что это очень важно для программиста. Каждый
                            день стараюсь сделать, изучить что-то новое. Учу English, дружелюбный, люблю и
                            понимаю важность командной работы. Сам немного перфекционист, обращаю внимание на
                            детали :). <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Через данный магазин я ничего не продаю,
                            он написан что бы продемонстрировать мою практическую работу потенциальному работодателю. Я
                            уверен в своих силах и верю что скоро смогу показать намного больше :)</p>
                            <br>
                        </div>
                        <?php for ($i = 0; $i < 12; $i++) echo '<br />' ?>

                    </div>
                </div><!--features_items-->
            </div>
        </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
