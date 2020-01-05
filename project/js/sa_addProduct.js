$(document).ready(function() {

        

    $('.submit_btn').click(function() {
        var name = $('#productName').val();
        var detail = $('#detail').val();
        var manuID = $('#manufactureID').val();
        var cate = $('#categoryDrop').val();
        var group = $('#groupDrop').val();
        var size = [];
        var color = [];
        var colorID = [];
        var img = [];
        $.each($('.sizeCheck:checked'), function() {
            size.push($(this).val());
        });
        $.each($('.color'), function() {
            color.push($(this).val());
        });
        $.each($('.colorID'), function() {
            colorID.push($(this).val());
        });
        $.each($('.productImg'), function() {
            img.push($(this).val());
        });
        var cost = $('#cost').val();
        var price = $('#sellPrice').val();
        var amount = $('#amount').val();
        $.when($.get('php/sa_addProduct.php?f=add', {
            name: name,
            detail: detail,
            manuID: manuID,
            cate: cate,
            group: group,
            size: size,
            color: color,
            colorID: colorID,
            cost: cost,
            price: price,
            amount: amount,
            img: img
        })).then(function(data) {
            alert(data);
            alert("Adding new product success!");
            location.replace('sa_productList.html');
        })
    });

    $.get("php/sa_addProduct.php?f=getNameUser", function(data) {
        $('#nameOut').html(data);
    });

    $('.next_btn_query').click(function() {
        var cate = $('#categoryDrop').val();
        var group = $('#groupDrop').val();
        var colorID = [];
        $.each($('.colorID'), function() {
            colorID.push($(this).val());
        });
        var sku = [];
        var i;
        for(i = 0;i < colorID.length; i++) {
            sku[i] = cate+'-'+group+'-'+colorID[i]+'-';
        }
        if(colorID.length > 1) {
            $('.more').toggle();
        }
        $('.showSKU1').html(sku[0]);
        $('.showSKU2').html(sku[1]);
        $(this).parent().next().fadeIn('slow');
        $(this).parent().css({
            'display': 'none'
        });
        $('.active').next().addClass('active');
    });

    $('.next_btn').click(function() {
        $(this).parent().next().fadeIn('slow');
        $(this).parent().css({
            'display': 'none'
        });
        $('.active').next().addClass('active');
    });

    $('.pre_btn').click(function() {
        $(this).parent().prev().fadeIn('slow');
        $(this).parent().css({
            'display': 'none'
        });
        $('.active:last').removeClass('active');
    });
})