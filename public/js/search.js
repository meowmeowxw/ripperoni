$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const searchPath = window.location.origin
    ? window.location.origin + '/'
    : window.location.protocol + '/' + window.location.host + '/';

$(document).ready(function () {

    $('#search').on('keyup', function () {

        var query = $(this).val();
        if (query === '') {
            $('#product_list').html('');
        }
        $.ajax({
            url: searchPath + "search",
            type: "GET",
            data: {'name': query},
            success: function (data) {
                if (data != '') {
                    $('#product_list').html(data);
                }
            }

        })
        // end of ajax call
    });

    $("#search").focusin(function () {
        $('#product_list').addClass('show');
    });

    $("#search").focusout(function () {
        window.setTimeout(function () {
            $('#product_list').removeClass('show');
        }, 100);
    });

});
