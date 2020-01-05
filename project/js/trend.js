$(document).ready(function() {
    $('#1').click(function() {
        $.get('analysis_form/Analysis_Queries_1.php', function(data) {
            $('.showroom').text() = '';
            $('.showroom').html(data);
        })
    })
})