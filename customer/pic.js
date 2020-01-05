$('.bas').on('mouseover',function(){
    var basPic = $('.basPic');
    var runPic = $('.runPic');
    runPic.css('display','none');
    basPic.css('display','block');
});

$('.run').on('mouseover',function(){
    var basPic = $('.basPic');
    var runPic = $('.runPic');
    basPic.css('display','none');
    runPic.css('display','block');
});

