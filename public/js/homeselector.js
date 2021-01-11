$(".selectcategory").click(function () {
    $(this).parent().find("a.active").removeClass('active');
    $(this).addClass('active');
    let cat = $(this).text();
    if(cat === "All"){
        $(".filterDiv").show();
    }
    else {
        $(".filterDiv").hide().filter('.' + cat).show();
    }
});
