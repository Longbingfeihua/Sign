$(function(){
	$(".zone_l_boom").hover(function(){
		$(this).attr("class","zone_l_boom icon-th-large icon-spin");
		},function(){
		$(this).attr("class","zone_l_boom icon-th-large");
	})
	
	$(".star").hover(function(){
		$(this).attr("class","zone_star star icon-star icon-spin");
		},function(){
		$(this).attr("class","zone_star star icon-star");
	})
	
	$("#zone_icon").click(function(){
		$("#zone_upload").unbind("click").click();
		$("#zone_upload").change(function(){
			$("#zone_upload_submit").unbind("click").click();
			document.getElementById("zone_iframe").onload=function(){//必须等iframe加载完成之后，才能获取里面的数据，否则为空。
				var newpath = getIframeContent();
				if(newpath.length>1)
				{
					$("#zone_icon").attr("src",newpath);
				}
			}
		})
	})
})

function shine()
{
	$(function(){
		$(".fr_tip").fadeIn(1000).fadeOut(1000);
	})
}
setInterval("shine()", 1000);

function getIframeContent(){  //获取iframe中文档内容
	 var doc;
	 if (document.all){ // IE 
	  	doc = document.frames["zone_iframe"].document; 
	 }else{ // 标准
	  	doc = document.getElementById("zone_iframe").contentDocument; 
	 }
	 return doc.body.innerHTML;
} 