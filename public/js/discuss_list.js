$(function(){
    $('.discuss_one_list').hover(function(){
        $(this).css('backgroundColor','powderblue');
    },function(){
        $(this).css('backgroundColor','#fff');
    })

    $('.discuss_new_publish_icon').on('click',function(){
        $('.discuss_new_publish').fadeToggle(1000);
    })
})
