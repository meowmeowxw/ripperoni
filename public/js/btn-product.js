$("#btn-minus").click(function () {
    let quantity = parseInt($('#quantityNew').val());
    if (quantity > 1) {
        $('#quantityNew').val(quantity - 1);
    }
});

$("#btn-plus").click(function () {
    let quantity = parseInt($('#quantityNew').val());
    $('#quantityNew').val(quantity + 1);
});
