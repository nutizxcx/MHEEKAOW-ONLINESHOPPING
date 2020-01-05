
$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}

$.fn.loadPic = function(x,y,z){
    var prodID = x;
    var color = y;
    var sex = z;
    console.log(prodID);
    console.log(color);
    console.log(sex);
    return $.post('loadPic.php',{prodID:prodID,color:color,sex:sex},function(data){
    });
}

$('document').ready(function(){
    var x = $.urlParam('param1');
    var y = $.urlParam('param2');
    var z = $.urlParam('param3');
    $.when($.fn.loadPic(x,y,z)).then(function(data){
        $('.prodPic').attr('src',data);
    });
    $.fn.productFunction(x,y,z);
    $.fn.maxAmountFunction();
});

var obj; 

$('.prodPic')



$.fn.productFunction = function(x,y,z){ 
    $.get('product.php',{x:x,y:y,z:z},function(data){
        console.log(data);
        console.log(z);
        obj = JSON.parse(data);
        console.log(obj);
        $('.item').html(obj[0].Name);
        $('.prodCategory').html(obj[0].Category);
        $('.prodGroup').html(z);
        $('.prodPrice').html(obj[0].SellingPrice+'฿');
        $('.prodDetail').html(obj[0].Detail);
        $('.prodColor').html(obj[0].Color);
        $.each( obj, function(i){
            if(obj[i].Remain < 5){   
                $('.prodAmount').attr('max',obj[i].Remain);
            }
            $('#allProdSize').append("<option value='" + obj[i].Size + "'>" + obj[i].Size + "</option>");
        });
    })

}

$('.prodAmount').on('click',
$.fn.maxAmountFunction = function(){ 
        if($('.prodAmount').val() == $('.prodAmount').attr('max') ){
            $('.maxAmount').html('max');
        }else   $('.maxAmount').html('');
});



$('.addToCart').on('click',function(){
    var check = 1;
    if(Cookies.getJSON('cart')==null) cart = [];
    else cart = Cookies.getJSON('cart');

    console.log(obj);
    

    $.post('session.php',{requestByAjax:2},function(data){
        if(data == 1){

            for(i=0; i< Object.keys(obj).length ;i++){
                if($('#allProdSize').val()==obj[i].Size){
                    object_data = {prodID: obj[i].ProductID, prodSKU: obj[i].SKU, prodName: obj[i].Name, prodPrice:obj[i].SellingPrice, prodColor:obj[i].Color, prodSize:$('#allProdSize').val(), prodAmount:$('.prodAmount').val()};
                    
                    break;
                }
            }               
            
            for(i=0;i<cart.length;i++){
                
                if($('#allProdSize').val()==cart[i].prodSize){
                    
                    cart[i].prodAmount = Number(cart[i].prodAmount) + Number($('.prodAmount').val());
                    check = 0;
                    break;
                }
            }

            if(check == 1 ){
                cart.push(object_data);
            }
            

            Cookies.set('cart',JSON.stringify(cart),{expires:7,path:'/'}); 

            for(i=0; i< cart.length ;i++){
                
                console.log(cart[i].ProductID+cart[i].prodSKU+cart[i].prodName+cart[i].prodPrice+cart[i].SellingPrice+cart[i].prodColor+cart[i].prodSize+cart[i].prodAmount);
                console.log(Cookies.get('cart'));
            }
            
            alert('success');

        }else{
            alert('please login first');
            $('.loginBut').trigger("click");
        }

    })
});

