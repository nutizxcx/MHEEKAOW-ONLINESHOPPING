    
$('#loginSub').on('click',function(){
    var email = $('#emailLog').val();
    var pw = $('#passLog').val();

    if( email == '' ){
        $('#emailLog').css({'background':'#F5B7B1'});
    }
    if( pw == ''){
        $('#passLog').css({'background':'#F5B7B1'});
    }

    if(email.trim() != ''){
        $.post('loginValid.php',{email:email , pw:pw},function(data){
            if(data == 'Fail'){
                alert('Sorry, your email or password is incorrect please try again.');
                $('#emailLog').css({'border':'1px solid red','background':'#F5B7B1'});
                $('#passLog').css({'border':'1px solid red','background':'#F5B7B1'});
            }else{
                $('.manageBut').css({'display':'inline'});
                $('.regisBut').css({'display':'none'});
                $('.loginBut').css({'display':'none'});
                $('.logoutBut').css({'display':'inline'});
                $('.welcome').html('Welcome ' + data);
                $('.loginSuccess').css({'display':'inline'});
                $('#loginForm').css({'display':'none'});
            }
        });  
        

    }else {
        $('.test').html('') ;
    }
});

$('#emailLog').on('keyup',function(){
    var x = $('#emailLog').val();
    if(x != '') $('#emailLog').css({'border':'1px solid #cacfd2','background':'#f8f9f9'});
});

$('#passLog').on('keyup',function(){
    var y = $('#passLog').val();
    if(y != '') $('#passLog').css({'border':'1px solid #cacfd2','background':'#f8f9f9'});
});

// check section
$('document').ready(function(){
    $.post('session.php',{requestByAjax:1},function(data){
        if(data != ''){
            // login page
        $('.regisBut').css({'display':'none'});
        $('.loginBut').css({'display':'none'});
        $('.logoutBut').css({'display':'inline'});
        $('.welcome').html('Welcome ' + data);
        $('.loginSuccess').css({'display':'inline'});
        $('#loginForm').css({'display':'none'});
        $('.manageBut').css({'display':'inline'});
        }else{
                 // logout page
            $('.regisBut').css({'display':'inline'});
            $('.loginBut').css({'display':'inline'});
            $('.logoutBut').css({'display':'none'});
            $('.welcome').html('');
            $('.loginSuccess').css({'display':'none'});
            $('#loginForm').css({'display':'block'});
        }
    })
});

$('#mndropdown,#mndropdown-content').on('mouseover', function(){
    $('#mndropdown-content').css({'display':'inline-block'});
});

$('#mndropdown,#mndropdown-content').on('mouseout', function(){
    $('#mndropdown-content').css({'display':'none'});
});


$('#maledropdown').on('mouseover', function(){
    $('#maledropdown-content').css({'display':'inline-block'});
});

$('#maledropdown').on('mouseout', function(){
    $('#maledropdown-content').css({'display':'none'});
});


$('#femaledropdown').on('mouseover', function(){
    $('#femaledropdown-content').css({'display':'inline-block'});
});

$('#femaledropdown').on('mouseout', function(){
    $('#femaledropdown-content').css({'display':'none'});
});

$('#unidropdown').on('mouseover', function(){
    $('#unidropdown-content').css({'display':'inline-block'});
});

$('#unidropdown').on('mouseout', function(){
    $('#unidropdown-content').css({'display':'none'});
});




