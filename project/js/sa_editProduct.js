
$(document).ready(function() {
    
    $('#selColor,#selGroup').on('change',function(){
        var id = $('#myInput').val();
        
            for(i=0;i<$('.prodUrl').length;i++){
               $('.prodUrl')[i].remove();
            }

            $.when($.get('php/sa_editProduct.php?f=selPic&prodID='+id+'&prodColor='+ $("#selColor").val() +'&prodGroup='+ $("#selGroup").val(),function(data){
            })).then(function(data){
                var obj = JSON.parse(data);
                for(i=0;i<obj.length;i++){
                    $('.picUrl').append('<input type="text" name="'+obj[i].ImageNO+'" class="prodUrl" value="'+obj[i].ImagePath+'">');
                }});
        
    });

    function selColor(id){
        console.log(id);
       return $.get('php/sa_editProduct.php?f=selColor&prodID='+id,function(data){
       });     
    }

    $.get('php/sa_editProduct.php?f=getNameUser', function(data) {
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
        $.get('php/sa_editProduct.php?f=callProductID&q='+value, function(data) {
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
        var name = $('#productName').val();
        var detail = $('#detail').val();
        var manuID = $('#manufactureID').val();
        var cate = $('#categoryDrop').val();
        var group = $('#groupDrop').val();
        var size = [];
        $.each($('.sizeCheck:checked'), function() {
            size.push($(this).val());
        })
        var color = $('#color').val();
        var colorID = $('#colorID').val();
        var cost = $('#cost').val();
        var price = $('#sellPrice').val();
        var amount = $('#amount').val();

        alert(size);
        $.when($.get('php/sa_editProduct.php?f=edit', {
            id : id,
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
            img1: img1,
            img2:img2,
            img3: img3
        })).then(function(data) {
            if(data) {
                alert('Editting product success!');
                location.replace('sa_productList.html');
            } else {
                alert('Editting product FAILED!');
            }
        })
    });

    $('.next_btn_search').click(function() {
        var id = $('#myInput').val();

        $.when(selColor(id)).then(function(data){
            console.log(data);
            var obj = JSON.parse(data);
            for(i=0;i<obj.length;i++){
                $('#selColor').append('<option val='+obj[i].Color+'>'+obj[i].Color+'</option>');
            }
                $.get('php/sa_editProduct.php?f=selGroup&prodID='+id,function (data){
                    var obj1 = JSON.parse(data);
                    for(i=0;i<obj1.length;i++){
                        $('#selGroup').append('<option val='+obj1[i].Group+'>'+obj1[i].Group+'</option>');
                    }
                });
        });

        if($('#myInput').val() == '') {
            alert('Please fill the form');
            location.reload();
        }
        $(this).parent().next().fadeIn('slow');
        $(this).parent().css({
            'display': 'none'
        });
        $('.active').next().addClass('active');
        $.get('php/sa_editProduct.php?f=existData', {
            id: id
        }, function(data) {
            if(!data) {
                alert('ProductID is INVALID!');
                location.reload();
            } else {
                try {
                    $.get('php/sa_editProduct.php?f=showQuery&id='+id, function(data) {
                        var json = JSON.parse(data);
                        var i;
                        $('#productName').val(json['name']);
                        $('#detail').val(json['detail']);
                        $('#manufactureID').val(json['manuID']);
                        $('#categoryDrop').val(json['cate']);
                        $('#groupDrop').val(json['group']);
                        $('#cost').val(json['cost']);
                        $('#sellPrice').val(json['price']);
                        $('#amount').val(json['amount']);
                        $.each($('.sizeCheck'), function() {
                            for(i = 0; i < json['size'].length; i++){
                                if($(this).val() == json['size'][i]) {
                                    $(this).prop('checked', true);
                                }
                            }
                        });
                        // $.each($('.productImg'), function() {
                        //     for(i = 0; i < json['img'].length; i++){
                        //         $(this).val(json['img'][i]);
                        //     }
                        // });
                        $.each($('.color'), function() {
                            for(i = 0; i < json['color'].length; i++){
                                $(this).val(json['color'][i]);
                            }
                        });
                        $.each($('.colorID'), function() {
                            for(i = 0; i < json['colorID'].length; i++){
                                $(this).val(json['colorID'][i]);
                            }
                        });
                        if($('#im1').val()==$('#im2').val()) {
                            $('#im2').val('');
                            $('#im3').val('');
                        } else if ($('#im3').val()==$('#im2').val()) {
                            $('#im3').val('');
                        }
                        // if($('#color1').val()==$('#color2').val()) {
                        //     $('#color2').val('');
                        // }
                        // if($('#colorID1').val()==$('#colorID2').val()) {
                        //     $('#colorID2').val('');
                        // }

                        // $('.response').html('<tr><td></td><td><input name="productImg1" class="productImg" id="im1" type="text"></td><td></td>'+
                        // '<input name="productImg2" class="productImg" id="im2" type="text"></td><td></td>'+
                        // '<input name="productImg3" class="productImg" id="im3" type="text"></td></tr>');
                    });
                } catch(err) {
                    alert("error");
                }
            }
        });
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



});