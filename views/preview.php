<div class="preview"style="border:1px solid grey;width:100%;height:300px;background: center center no-repeat"></div>
<input id="upinput" type="file" name="up">
<span class="info"><span>
<hr/>
<script>
     var
     upfile = document.querySelector('#upinput'),
     preview = document.querySelector('.preview'),
     info = document.querySelector('.info');

     upfile.addEventListener('change',function(){ //dom添加相应的事件监听函数
          preview.style.backgroundImage = '';//清除背景图片
          //console.log(upfile.value);
          if(!upfile.value){ //验证是否有文件加载
               info.innerText = '无文件';
               return;
          }
          //console.log(upfile.files[0])
          var file = upfile.files[0];//获取file控件的files属性值
          var Rtype = /^image\/(jpeg|png)$/;
          var type = file.type.split('.').pop();
          if(!Rtype.test(type)){
               info.innerText = '图片格式不对';
               return;
          }               
          info.innerText = file.name;
          if(!window.FileReader){
               info.innerText = '浏览器不支持FileReader对象';
               return;
          }          
          var reader = new FileReader();//初始化h5 FileReader对象 读取文件
          reader.onload = function(e){ //读完回调函数
          var data = e.target.result;
          console.log(data);
          preview.style.backgroundImage = 'url('+data+')';
          info.innerText = '加载完毕';
          
          var ajax = new XMLHttpRequest();//ajax传后台
          if(!window.FormData){
	          info.innerText = '不支持formdata';
	          return;
          }
          var formdata = new FormData();
          formdata.append('file',file);
          //formdata.append('name','sss');
	      ajax.onreadystatechange = function(){
		     if(this.readyState == 4 && this.status == 200){
			     console.log(this.responseText);
		     }
	      }
	      ajax.open('post','./upload.php',true);
	      ajax.send(formdata);
         }
          reader.readAsDataURL(file); //以DataURL形式读取文件
     })  
     //-----------------------
     
     var Re = /^(\w{3}c|eee|sc)\s\w{3}c$/i; 
     console.log(Re.test('sc sssc'));
</script>     