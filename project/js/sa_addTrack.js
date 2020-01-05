$(document).ready(function() {

    $.get('php/sa_addTrack.php?f=getNameUser', function(data) {
        $('#nameOut').html(data);
    });

    $.each($('#myDropdown a'), function() {
        if ($(this).text() == '') $(this).hide();
        $(this).click(function() {
            $('#myInput').val($(this).text());
            $.each($('#myDropdown a'), function() {
                $(this).html('').toggle($(this).text()!='');
            })
        })
    });

    $('#myInput').on('keyup', function() {
        var value = $(this).val();
        var i = 0;
        $.get('php/sa_addTrack.php?f=callID&q='+value, function(data) {
            var a = JSON.parse(data);
            $.each($('#myDropdown a'), function() {
                $(this).html(a[i]).toggle($(this).text()!='');
                i++;
            })
            $('#myDropdown a').filter(function() {
                $(this).toggle($(this).text().indexOf(value) > -1)
            });
        })
    });

    $('.submit_btn').click(function() {
        var id = $('#myInput').val();
        var tracking = $('#tracking').val().toUpperCase();
        $.get('php/sa_addTrack.php?f=addTrack', {
            id : id,
            tracking : tracking
        }, function(data) {
            if(data) {
                location.replace('mix/orderHistory.php');
            } else {
                alert('FAILED!');
            }
        })
    });

    $('.next_btn_search').click(function() {
        var id = $('#myInput').val();
        if($('#myInput').val() == '') {
            alert('Please fill the form');
            location.reload();
        }
        $(this).parent().next().fadeIn('slow');
        $(this).parent().css({
            'display': 'none'
        });
        $('.active').next().addClass('active');
        $.get('php/sa_addTrack.php?f=existData', {
            id: id
        }, function(data) {
            if(!data) {
                alert('ID is INVALID!');
                location.reload();
            } else {
                $.get('php/sa_addTrack.php?f=showQuery', {
                    id: id
                }, function(data) {
                    $('.show').html(data);
                });
            }
        });
    });
});