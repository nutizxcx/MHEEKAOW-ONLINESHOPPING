$('.logout').on('click',function(){
    $.post('session.php',{requestByAjax:0},function(){
        Cookies.remove('cart', { path: '/' } );
        location.reload();
    });

});