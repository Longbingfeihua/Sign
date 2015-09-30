$(function(){
	$('[data-toggle="tooltip"]').tooltip()

	//window.onscroll=function(){
	//	 var top=document.body.scrollTop||document.documentElement.scrollTop;  
	//	console.log($('.discuss_main_div').innerHeight()-top )
	//}

	$(window).scroll(function(){
		var scrollTop = $(this).scrollTop();
		var scrollHeight = $(document).height();
		var windowHeight = $(this).height();
		if(scrollHeight-(scrollTop + windowHeight)<200){
			$('.discuss_replay').fadeIn(1000);
		}else{
			$('.discuss_replay').fadeOut(1000);
		}
	});

	$('.discuss_user_info_div_up ,.discuss_user_info_div_bottom').hover(function(){
		$(this).on('mousemove',function(e){
			//$(this).text('X轴:'+e.pageX+'Y轴:'+e.pageY);
		}).css('border','4px solid grey');
	},function(){
		$(this).css('border','1px solid grey').text('');
	})
	
	$(".discuss_mission_div div:nth-child(1)").hover(function(){
		$(this).addClass('color1');
	},function(){
		$(this).removeClass('color1');
	}).on('click',function(){
		$('.discuss_replay').fadeToggle(1000);
	})

})