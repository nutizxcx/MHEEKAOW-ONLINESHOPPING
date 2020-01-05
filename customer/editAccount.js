addressID = [];
creditID = [];

function updateAdd(addID,newAdd){
    return    $.post('editReqData.php',{req:2.1,addID:addID,newAdd:newAdd},function(data){
    });
}

$('.editUser').on('click',function(){
    $.post('editReqData.php',{req:0},function(data){
        var obj = JSON.parse(data);
        $('.firstName').val(obj['FirstName']);
        $('.LastName').val(obj['LastName']);
        $('.birthDay').val(obj['DateOfBirth']);
        $('.tel').val(obj['Tel']);
        $('.gender').val(obj['Gender']);
    });
    $('#editMenu').css('display','none');
    $('#editUser').css('display','block');
    $('#editID').css('display','none');
    $('#editAddress').css('display','none');
    $('#editCredit').css('display','none');
});

$('.editID').on('click',function(){
    $.post('editReqData.php',{req:1},function(data){
        var obj = JSON.parse(data);
        $('.email').val(obj['Email']);
    });
    $('#editMenu').css('display','none');
    $('#editID').css('display','block');
    $('#editUser').css('display','none');
    $('#editAddress').css('display','none');
    $('#editCredit').css('display','none');
});

$('.editAddress').on('click',function(){
    
    $.post('editReqData.php',{req:2},function(data){
        console.log(data);
        var obj=JSON.parse(data);
        for(i=0;i<obj.length;i++){
            $('.address:eq('+i+')').val(obj[i].AddressDescribe);
            addressID[i] = obj[i].AddressID;
        }
    });
    $('#editMenu').css('display','none');
    $('#editAddress').css('display','block');
    $('#editUser').css('display','none');
    $('#editID').css('display','none');
    $('#editCredit').css('display','none');
});

$('.editCredit').on('click',function(){
    $.post('editReqData.php',{req:3},function(data){
        console.log(data);
        var obj=JSON.parse(data);
        for(i=0;i<obj.length;i++){
            $('.credit:eq('+i+')').val(obj[i].CreditCardID);
            creditID[i] = obj[i].CreditCardID;
            $('.credit:eq('+i+')').prop('disabled',true);
        } 
    });
    $('#editMenu').css('display','none');
    $('#editCredit').css('display','block');
    $('#editUser').css('display','none');
    $('#editID').css('display','none');
    $('#editAddress').css('display','none');
});

$('.chgUsrData').on('click',function(){
    var firstName = $('.firstName').val();
    var lastName = $('.lastName').val();
    var birthDay = $('.birthDay').val();
    var tel = $('.tel').val();
    var gender = $('.gender').val();
    if(confirm('Sure?')){
        $.post('editReqData.php',{req: 0.1, firstName:firstName, lastName:lastName, birthDay:birthDay, tel:tel, gender:gender},function(data){
            alert('Success');
            location.reload();
        });
    }
});

$('.toNewPass').on('click',function(){
    var pass = $('.pw').val();
    $.post('editReqData.php',{req: 1.1, pw: pass},function(data){
        if(data == 'password found'){
            $('.setNewPass').css('display','block');
            $('.checkOldPass').css('display','none');
        }else{
            alert('password is incorrect');    
        }
    }); 
});

$('.chgPass').on('click',function(){
    var newpw = $('.newPw').val();
    var cnfnewPw = $('.cnfnewPw').val();
    if(newpw == cnfnewPw){
        if(confirm('Sure?')){
            $.post('editReqData.php',{req:1.2,newpw:newpw},function(data){
                alert('Success');
                location.reload();
            });
        }
    }else{
        alert('password is invalid');
    }

});

$('.addAdd').on('click',function(){
    var index = $('.addAdd').index(this);
    $('.addAdd:eq('+index+')').css('display','none');
    $('.address:eq('+(Number(index)+1)+')').css('display','flex');
    $('.delAdd:eq('+(index)+')').css('display','flex');
});


$('.addCred').on('click',function(){
    var index = $('.addCred').index(this);
    $('.addCred:eq('+index+')').css('display','none');
    $('.credit:eq('+index+')').css('display','block');
    $('.creditExpired:eq('+index+')').css('display','block');
    $('.credCVV:eq('+index+')').css('display','block');
    $('.delCred:eq('+(index)+')').css('display','block');
    $('.creditlab:eq('+index+')').css('display','block');
    $('.creditExpiredlab:eq('+index+')').css('display','block');
    $('.credCVVlab:eq('+index+')').css('display','block');
});

$('.chgAdd').on('click',function(){
    var addID = addressID;
    if(confirm('Sure?')){
    for(i=0;i<3;i++){
        if(i<addID.length){
            console.log(i);
            console.log(addID[i]);
            $.when(updateAdd(addID[i],$('#editAddress input:eq('+i+')').val())).then(function(){});
            
        }else{
            if($('#editAddress input:eq('+i+')').val() != ''){
                console.log(i);
                
                $.post('editReqData.php',{req:2.2,newAdd:$('#editAddress input:eq('+i+')').val()},function(data){
                    console.log('c');
                });
            }
        }
    }
    }
    alert('Success');
    location.reload();
});

$('.delAdd').on('click',function(){
    var index = Number($('.delAdd').index(this));
    if( $('.address:eq('+(Number(index)+1)+')').val() != '' ){
        if(confirm('You want to delete?')){

            $('.address:eq('+(Number(index)+1)+')').css('display','none');
            $('.address:eq('+(Number(index)+1)+')').val('');
            
            $('.delAdd:eq('+index+')').css('display','none');
            $('.addAdd:eq('+index+')').css('display','flex');
            // console.log(addressID[Number(index)+Number(1)]);
            $.post('editReqData.php',{req:2.3,delAdd: addressID[Number(index)+Number(1)]},function(data){
                console.log(data);
            });
        }
    }else{
        $('.address:eq('+(Number(index)+1)+')').css('display','none');
            $('.address:eq('+(Number(index)+1)+')').val('') ;
            
            $('.delAdd:eq('+index+')').css('display','none');
            $('.addAdd:eq('+index+')').css('display','flex');
    }
});

$('.chgCred').on('click',function(){
    if(confirm('Sure?')){
    var credID = creditID;
        for(i=0;i<3;i++){
            if(i>=credID.length){
                if( $('.credit:eq('+i+')').val() != '' && $('.creditExpired:eq('+i+')').val() && $('.credCVV:eq('+i+')').val()){
                
                    $.post('editReqData.php',{req:3.2,newCred:$('.credit:eq('+i+')').val(),newExpired:$('.creditExpired:eq('+i+')').val(),newCVV:$('.credCVV:eq('+i+')').val()},
                    function(data){
                        alert('Success');
                        location.reload();
                    });
                }
            }
        }
    }    
});

$('.delCred').on('click',function(){
    var index = Number($('.delCred').index(this));
    if( $('.credit:eq('+index+')').val() != '' ){
        if(confirm('You want to delete?')){

            $('.creditExpired:eq('+(index)+')').css('display','none');
            $('.creditExpired:eq('+(index)+')').val('');

            $('.credCVV:eq('+(index)+')').css('display','none');
            $('.credCVV:eq('+(index)+')').val('');

            $('.credit:eq('+(index)+')').css('display','none');
            $('.credit:eq('+(index)+')').val('') ;
            
            $('.delCred:eq('+index+')').css('display','none');
            $('.addCred:eq('+index+')').css('display','block');

            $('.creditlab:eq('+index+')').css('display','none');
            $('.creditExpiredlab:eq('+index+')').css('display','none');
            $('.credCVVlab:eq('+index+')').css('display','none');
            // console.log(addressID[Number(index)+Number(1)]);
            $.post('editReqData.php',{req:3.3,delCred: creditID[index]},function(data){
                console.log(data);
            });
        }
    }else{
            $('.creditExpired:eq('+(index)+')').css('display','none');
            $('.creditExpired:eq('+(index)+')').val('');

            $('.credCVV:eq('+(index)+')').css('display','none');
            $('.credCVV:eq('+(index)+')').val('');

            $('.credit:eq('+(index)+')').css('display','none');
            $('.credit:eq('+(index)+')').val('') ;
            
            $('.delCred:eq('+index+')').css('display','none');
            $('.addCred:eq('+index+')').css('display','block');

            $('.creditlab:eq('+index+')').css('display','none');
            $('.creditExpiredlab:eq('+index+')').css('display','none');
            $('.credCVVlab:eq('+index+')').css('display','none');
    }
});


