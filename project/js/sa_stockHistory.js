$(document).ready(function() {
    $.get("php/sa_stockHistory.php?f=getNameUser", function(data) {
        $('#nameOut').html(data);
    });
    $.get('php/sa_stockHistory.php?f=queryData', function(data) {
        $('.stockList').html(data);
    });
})