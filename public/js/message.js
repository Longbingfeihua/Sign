function show()
{
	$(function(){
		$.post(
			"http://sign.com/index.php/Message/show/",
			function(data)
			{
				//console.log(data);
				if(data == "null"){
					return false;
				}else{
					var obj = eval('('+data+')');
					var content = '';
					for(i=0;i<obj.length;i++)
					{
						content += '<div>' + obj[i].name + '<div>'+ obj[i].message +'</div></div>';
					}
					$(".message_body").html(content);
				}
			}
		)	
	})
}
setInterval("show()",1000);

$(function(){
	$(".message_area").keydown(function(e){
		var e = e || event;
		var message = $(this).val();
		var font_size = $(this).css("font-size");
		var font_weight = $(this).css("font-weight");
		var font_style = $(this).css("font-style");
		var color = $(this).css("color");
		if(font_weight == "600")
		{
			message = "<b>"+message+"</b>";
		}
		if(font_style == "italic")
		{
			message = "<i>"+message+"</i>";
		}
		message = '<span style="margin-left:10px;font-size:'+font_size+'">'+message+'</span>';
		var keycode = e.which || e.keyCode;
		if (keycode == 13) 
		{
			if(message != '')
			{
				$.post(
					"http://sign.com/index.php/Message/create/",
					{message:message},
					function(data)
					{
						
					}
				)	
			}
			$(this).val('');
	 	}
	})
	
	$(".message_nav li").hover(function(){
		$(this).css("font-size","22px");
		$(this).css("color","orange");
	},function(){
		$(this).css("font-size","18px");
		$(this).css("color","#ccc");
	})
	
	$(".message_eye").click(function(){
		var i = Math.random()*(3-1)+1;
		if(i < 2)
		{
			$(".message_body").css("background-color","pink");
		}else if(i < 2.5 )
		{
			$(".message_body").css("background-color","yellow");
		}else{
			$(".message_body").css("background-color","#fff");
		}	
	})
	
	$(".message_remove").click(function(){
		$.post("http://sign.com/index.php/Message/clear/",
			{action:1},
			function(data){
				if(data)
				{
					$(".message_body").html('');
				}
			}
		)
	})
	
	$(".nav_style li").click(function(){
		var classtype = $(this).attr("class");
		var status = $(this).attr("on");
		if(status == "false")
		{
			if(classtype == "bold")
			{
				$(".message_area").css("font-weight",600);
			}else if(classtype == "italic")
			{
				$(".message_area").css("font-style","italic");
			}else if(classtype == "font")
			{
				$(".message_area").css("font-size","25px");
			}
			$(this).attr("on","true");
			$(this).css("color","green");
		}else{
			if(classtype == "bold")
			{
				$(".message_area").css("font-weight",400);
			}else if(classtype == "italic")
			{
				$(".message_area").css("font-style","normal");
				
			}else if(classtype == "font")
			{
				$(".message_area").css("font-size","20px");
			}
			$(this).attr("on","false");
			$(this).css("color","#ccc");
		}		
	})
})