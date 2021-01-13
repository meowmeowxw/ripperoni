$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const searchPath = window.location.origin
        ? window.location.origin + '/'
        : window.location.protocol + '/' + window.location.host + '/';

$(document).ready(function () {

    $('#search').on('keyup',function() {
        var query = $(this).val();
        $.ajax({
            url: searchPath + "search",
            type: "GET",
            data: {'name':query},
            success:function (data) {
                $('#product_list').html(data);
            }
        })
        // end of ajax call
    });


    $(document).on('click', 'li', function() {
        var value = $(this).text();
        $('#search').val(value);
        $('#product_list').html("");
    });
});
