$(document).ready(function() {
    $.get("php/sa_productList.php?f=getNameUser", function(data) {
        $('#nameOut').html(data);
    });
    $.get('php/sa_productList.php?f=queryData', function(data) {
        $('.product').html(data);
    });
})