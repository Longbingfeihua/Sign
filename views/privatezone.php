<script src="<?= BASE_URL ?>/public/js/privatezone.js"></script>
<script src="<?= BASE_URL ?>/public/js/circle.js"></script>
<div class="zone_title">Wellcome to PrivateZone</div>
<div class="zone_main">
	<div class="zone_l">
		<div class="zone_l_pic">
			<img id="zone_icon" src="<?= $userdata['iconpath'] ? $userdata['iconpath'] : BASE_URL.'/public/image/defaultIcon.jpg' ; ?>" class="img-rounded" width=180px title="点击上传头像"> <!-- img-circle -->
			
			<form id="zone_upload_form" action="<?= BASE_URI?>/PrivateZone/changeIcon/1" method="post" enctype="multipart/form-data" target="zone_iframe">
<!-- 			转接到iframe中显示图片上传，而避免页面跳转 ，路径方法若无参数，必须加斜杠-->
			<input id="zone_upload" type="file" name="icon">
			<input id="zone_upload_submit" type="submit" name="sub">
			</form>
			<iframe name="zone_iframe" id="zone_iframe">
			</iframe>
		</div>
		<div class="zone_l_red auto">
<!--
			<table class="table table-striped table-hover">
				<tr>
					<td>xxxxx</td>
					<td>xxxxx</td>
					<td>xxxxx</td>
					<td>xxxxx</td>
				</tr>
				<tr>
					<td>xxxxx</td>
					<td>xxxxx</td>
					<td>xxxxx</td>
					<td>xxxxx</td>
				</tr>
				<tr>
					<td>xxxxx</td>
					<td>xxxxx</td>
					<td>xxxxx</td>
					<td>xxxxx</td>
				</tr>
			</table>
-->
			<p class="zone_tag auto">
				<span class="zone_l_boom icon-th-large"></span>
			</p>
		</div>	
	</div>
	<div class="zone_r">
		<div class="zone_r_t">
			<div class="zone_r_title bg-success">关注的好友</div>
				<div class="zone_r_corll panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<?php foreach($friend as $key => $vo){ ?>				
				  <div class="panel panel-default">
				    <div class="panel-heading zone_r_heading" style="background-color: #fff "role="tab">
				      <h4 class="panel-title">
				        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key?>" aria-expanded="false">
				          <?= $vo['name']?>
				        </a>
				        <span class="zone_star star icon-star" title="点击取消关注"></span>
				      </h4>
				    </div>
				    <div id="collapse<?= $key?>" class="panel-collapse collapse" role="tabpanel">  <!-- collapse in 为展开-->
				      <div class="panel-body">
					  	<?= $vo['address']?>
				      </div>
				    </div>
				  </div>
				  <?php } ?>
			</div>
		</div>
		<div class="zone_r_b">
			<div class="zone_r_b_l">
				
			</div>
			<div class="zone_r_b_r">
				<span class="fr_tip icon-github-alt"> 新加入的小伙伴</span>
				<div class="sign_home_circle_div" id="sign_main_circle_div">
					<?php foreach($detail as $vo){?>
						<a href=""><?= $vo;?></a>
					<?php } ?>
		   		</div>
	   		</div>
   		</div>
	</div>
</div>