$('.haveDiscount').on('click',
    $.fn.discount = function(){
    $('.haveDiscount').css('display','none');
    $('.discountInput').css('display','inline-block');
});

var netPrice=0;


$('.checkDisCode').on('click',function(){
    $.post('checkDisCode.php',{disCode : $('.discountCode').val().trim()},function(data){

        if(data=='fail1' || $('.discountCode').val().trim() == 'none'){
            alert('Discount code is incorrect. Please try again.');
            $('.discountCode').val('');  
        }else if(data=='fail2'){
            alert('This code was redeemed.');
            $('.discountCode').val('');
        }else{
                obj = JSON.parse(data);
            if(Number($('.totalPrice').html()) > obj.Condition ){
                var date = new Date();
                // var strDate = date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate();
                var strDate = date.toISOString()
                console.log(date);
                console.log(strDate);
                if( strDate < obj.ExpiredDate ){
                    alert('Discount code redeemed!'); 
                    $('.totalPrice').html(Number($('.totalPrice').html()) + Number(obj.Formula));
                    $('.totalPrice').css('color','red');
                    $('.discountCode').prop('disabled',true);
                    $('.checkDisCode').prop('disabled',true);
                    netPrice = total + Number(obj.Formula);
                }else {
                    alert('This code was expired');
                    $('.discountCode').val('');
                }
            }else{
                alert('Code condition is incorrect.');
                $('.discountCode').val('');
            }
        }    
    }   
    );
});

$('.chooseAddress').on('click',function(){
    $('.textbox textarea').prop('disabled',true);
    $('.textbox textarea').css('display','none');
});

$('document').ready(function(){
    subtotal = [];
    total = 0;
    $('.textbox textarea').css('display','none');
    if(Cookies.getJSON('cart')!=null){
        $('#emmptyCart').css('display','none');
    for(i=0;i<Cookies.getJSON('cart').length;i++){
        $('#prodDetail').append('<tr class='+'prodDetail'+[i]+'></tr>');
        subtotal[i] = Number(Cookies.getJSON('cart')[i].prodAmount) * Number(Cookies.getJSON('cart')[i].prodPrice);
        total = total + subtotal[i];
        $('.prodDetail'+[i]).append('<td>'+Number(i+1)+'</td>');
        $('.prodDetail'+[i]).append('<td>'+Cookies.getJSON('cart')[i].prodName+'</td>');
        $('.prodDetail'+[i]).append('<td>'+Cookies.getJSON('cart')[i].prodColor+'</td>');
        $('.prodDetail'+[i]).append('<td>'+Cookies.getJSON('cart')[i].prodSize+'</td>');
        $('.prodDetail'+[i]).append('<td>'+Cookies.getJSON('cart')[i].prodAmount+'</td>');
        $('.prodDetail'+[i]).append('<td>'+Cookies.getJSON('cart')[i].prodPrice+'</td>');
        $('.prodDetail'+[i]).append('<td>'+subtotal[i]+'</td>');
        $('.prodDetail'+[i]).append('<td style="border-top:0px;"><button class="deletebtn" style="border:none; background:white; text-decoration: none;">x</button></td>');
        $('.prodDetail'+[i]).append('<br>');
    }
        deleteBtn()
        netPrice = total;
        $('#prodDetail').append('<tr class='+'prodTotal'+'></tr>');
        $('.prodTotal').append('<th colspan=6>Total</th>');
        $('.prodTotal').append('<td class='+'totalPrice '+'colspan=1>'+total+'</td>');
        $('.tableOfProduct').css('display','block');
    }else{
        $('.tableOfProduct').css('display','none');
        $('#emptyCart').css('display','block');
    }
});




  

$('.textbox input').on('click',function(){
    $('.textbox textarea').prop('disabled',false);
    $('.textbox textarea').css('display','block');
});

$('.textbox textarea').on('keyup',function(){
    $('.textbox input').attr('value',$('.textbox textarea').val());
    $('.textbox input').attr('id',$('.textbox textarea').val());
    $('.textbox label').attr('for',$('.textbox textarea').val());
})

$('.checkOutBut').on('click',function(){
    var lastID;
    function lastIDReq() {
        return $.post('lastOrderID.php',{},function(data){
        });
    }      

    function discountCodeReq(disReq){
        return $.post('discountValidation.php',{disCode:disReq},function(data){
        });
    }

    if(confirm('You sure to confirm?')){
     $.when(lastIDReq()).then(function(dataID){
            
            if(dataID != ''){
                lastID = Number(dataID) + 1;
            }else{
                lastID = 0;
            }

          

            for(i=0;i<Cookies.getJSON('cart').length;i++){                    
                $.post('orderHistory.php',{req:0,cookies:JSON.stringify(Cookies.getJSON('cart')[i]), subTotal:subtotal[i], lastID:lastID},function(dataResult){
                    console.log('1');
                    console.log(dataResult);
                });     
            }
           
            $.when(discountCodeReq($('.discountCode').val())).then( function abc(discountValid){
                
                if(discountValid==0){
                    return $.post('orderHistory.php',{req:1, lastID:lastID, discountCode: 'none', cusAddress: $('.chooseAddress').val(), cusCredit: $('.choosePayment').val(), totalPrice : total,netPrice: netPrice  },function(dataResult){
                        deleteCookies();
                    }); 
                }else{
                    return $.post('orderHistory.php',{req:1, lastID:lastID, discountCode: $('.discountCode').val(), cusAddress: $('.chooseAddress').val(), cusCredit: $('.choosePayment').val(), totalPrice : total,netPrice: netPrice  },function(dataResult){
                        deleteCookies();
                    }); 
                }
            });   


    });
    
    

    function deleteCookies(){
        Cookies.remove('cart');
        location.replace('thankyou.html');
    }    
    


    }
    
    
    

});


function deleteBtn () {
    $('.deletebtn').on('click',function(){
        var index = $('.deletebtn').index(this);
        var cookies = Cookies.getJSON('cart');
        delete cookies.splice(index,1);
        Cookies.set('cart',cookies);
        console.log('cookies = ',Cookies.get('cart'));
        if(Cookies.getJSON('cart') == ''){
            Cookies.remove('cart',{path:'/'});
        }
        location.reload();
         
    });
}