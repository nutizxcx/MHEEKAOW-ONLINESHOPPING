$(document).ready(function() {

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
        $.get('php/ceo_deleteStaff.php?f=callID&q='+value, function(data) {
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

    $('.delete').click(function() {
        var id = $('#myInput').val();
        if($('#myInput').val() == '') {
            alert('Please fill the form');
            location.reload();
        }
        $.get('php/ceo_deleteStaff.php?f=existData', {
            id: id
        }, function(data) {
            if(!data) {
                alert('ProductID is INVALID!');
                location.reload();
            } else {
                $.get('php/ceo_deleteStaff.php?f=delete&id='+id, function() {
                        alert('Detete '+id+' success!');
                        location.replace('mix/stafflist.php');
                });
            }
        });
    });

})