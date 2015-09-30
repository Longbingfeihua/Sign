<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<script src="<?= BASE_URL?>/public/js/discuss_list.js"></script>
</head>
<body>
	<div class="discuss_main_div auto" >
		<div class="discuss_list_title""></div>
		<div class="discuss_list_tool"></div>
		<div class="discuss_list_body"">
		<?php foreach($details as $vo){?>
			<div class="discuss_one_list auto">
				<div class="discuss_one_list_up"><span class="discuss_author"><?= $vo['author']?></span><span class="discuss_create_time"><?=Date('Y/m/d H:i:s')?></span></div>
				<div class="discuss_one_list_down"><span class="discuss_view icon-lemon"></span><a href="<?= BASE_URI?>/Discuss/detail/id/<?=$vo['id']?>"><?= $vo['title']?></a></div>
			</div>
	    <?php } ?>
		</div>
		<div id="discuss_editor" class="discuss_new_publish">
			<script id="container" name="content" type="text/plain">
        		这里写你的初始化内容
   			 </script>
			<script type="text/javascript" src="<?= BASE_URL?>/common/ueditor/ueditor.config.js"></script>
			<script type="text/javascript" src="<?= BASE_URL?>/common/ueditor/ueditor.all.js"></script>
			<script type="text/javascript">
				var ue = UE.getEditor('container');
			</script>
		</div>
		<div class="discuss_aside_div discuss_new_publish_icon">
			<div class="icon-edit" title="发表新主题"></div>
			<div></div>
			<div></div>
		</div>
		<div class="discuss_list_tool"></div>
	</div>
</body>
</html>