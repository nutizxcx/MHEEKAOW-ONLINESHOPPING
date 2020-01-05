var size;
function showTable(index){
    console.log('add');
    $.post('shippingProd.php',{ orderIdReq:$('.orderIdRecord'+[index]).html() },function(arr){
    obj = JSON.parse(arr);
        for(i=0;i<obj.length;i++){
            $('#allProdOfId').append("<tr class='record"+[i]+"'></tr>");
            $('.record'+[i]).append('<td>'+Number(i+1)+'</td>');
            $('.record'+[i]).append('<td>'+obj[i].Name+'</td>');
            $('.record'+[i]).append('<td>'+obj[i].Color+'</td>');
            $('.record'+[i]).append('<td>'+obj[i].Size+'</td>');
            $('.record'+[i]).append('<td>'+obj[i].Amount+'</td>');
            $('.record'+[i]).append('<td>'+obj[i].SellingPrice+'</td>');
            $('.record'+[i]).append('<td>'+obj[i].Subtotal+'</td>');
        }
        size = i;
        console.log('size = '+size);
    });
}

function deleteTable(n){
    console.log('delete');
    for(i=0;i<n;i++){
        console.log('delete item ' + i );
        $('.record'+[i]).remove();
    }
}

$('.recordSelect').on('click',function(){

    if($('.record0').val() == null){

        var index = $('.recordSelect').index(this);

        console.log( $('.orderIdRecord'+[index]).html() );

        showTable(index);
        

        
    }else{
            var index = $('.recordSelect').index(this);
            var n = size;
            deleteTable(n);
            showTable(index);            
        
    }

    
});

$('document').ready(function(){
    $.get('checkOrder.php',{},function(data){
        if(data == 'ok'){
            $('#showShipping').css('display','block');
            $('#orderIsEmpty').css('display','none');
        }else{
            $('#showShipping').css('display','none');
            $('#orderIsEmpty').css('display','block');
        } 
    });
    

});