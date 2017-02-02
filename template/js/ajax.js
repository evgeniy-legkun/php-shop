/**
 * Created by admin on 26.01.2017.
 */

$(document).ready(function () {
    $(".add-to-cart").click(function () {
        var id = $(this).attr("data-id");//получаем атрибут data-id обьекта на котором вызвано событие
        $.post("/cart/add/"+id, {}, function (data) {//формирование асинхронного запроса
            /*эта ф-я обрабатавает ответ на асинхронный запрос
            * в data - попадает результат*/
            $("#cart-count").html(data); /*обновляет содержимое блока #cart-count*/
        });
        return false;
    });
});

