let quantity = parseInt($('#quantityCart').val());

$("#btn-minus").click(function () {
    if (quantity > 1) {
        $('#quantityCart').val(quantity - 1);
    }
});

$("#btn-plus").click(function () {
    $('#quantityCart').val(quantity + 1);
});
