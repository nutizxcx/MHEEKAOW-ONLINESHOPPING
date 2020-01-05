$(document).ready(function() {
    $.post("php/sa_home.php", function(data) {
        $('#name').html(data);
        $('#nameOut').html(data);
    });
})