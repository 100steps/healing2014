<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BBT治愈系</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/css/reset.css?ver=2" />
		<link rel="stylesheet" type="text/css" href="/css/index.css?rnd=<?php echo rand();?>" />
		<link rel="stylesheet" type="text/css" href="/css/foundation.css" />
		<link rel="stylesheet" type="text/css" href="/css/animations.css" />
		<link rel="stylesheet" type="text/css" href="/css/php-emoji.css?ver=2" />
	</head>
	<body>		
		<div>		
			<div class="page page-1-1 page-current">
				<div class="wrap">
					<img class="img_2 pt-page-scaleUp" src="http://wechat.100steps.net/img/page1_img2.png?ver=2" />
					<img class="img_3 pt-page-flipInLeft" src="http://wechat.100steps.net/img/page1_img3.png?ver=3" />
					<img class="img_4 pt-page-moveIconUp" src="http://wechat.100steps.net/img/page1_icon_up.png" />
				</div>
			</div>
			<div class="page page-2-1 hide">
				<div class="wrap">
					<img class="img_1 hide pt-page-scaleUp" src="http://wechat.100steps.net/img/page2_img1.png" />
					<img class="img_2 hide pt-page-scaleUp" src="http://wechat.100steps.net/img/page2_img2.png" />
					<img class="img_3 hide pt-page-scaleUp" src="http://wechat.100steps.net/img/page2_img3.png" />
					<img class="img_4 hide pt-page-scaleUp" src="http://wechat.100steps.net/img/page2_img4.png" />
					<img class="img_5 hide pt-page-scaleUp" src="http://wechat.100steps.net/img/page2_img5.png?ver=3" />
					<img class="img_6 hide pt-page-moveIconUp" src="http://wechat.100steps.net/img/page2_icon_up.png" />
				</div>
			</div>
			<div class="page page-3-1 hide">
				<div class="wrap">
					<img class="img_1 hide pt-page-scaleUp" src="http://wechat.100steps.net/img/page3_img1.png" />
					<img class="img_2 hide pt-page-flipInLeft" src="http://wechat.100steps.net/img/page3_img2.png?ver=3" />
					<img class="img_3 hide pt-page-moveIconUp" src="http://wechat.100steps.net/img/page3_icon_up.png" />
				</div>
			</div>
			<div class="page page-4-1 hide">
				<div class="wrap">
					<img class="img_1 hide pt-page-scaleUp" src="http://wechat.100steps.net/img/page4_img1.png" />
					<img class="img_2 hide pt-page-scaleUp" src="http://wechat.100steps.net/img/page4_img2.png?ver=2" />
					<img class="img_3 hide pt-page-scaleUp" src="http://wechat.100steps.net/img/page4_img3.png" />
					<img class="img_4 hide pt-page-moveIconUp" src="http://wechat.100steps.net/img/page4_icon_up.png" />
				</div>
			</div>


			<div class="page page-5-1 hide">
				<div class="wrap">
<?php
	if(isset($userInfo)&&isset($system)&&$system=='MIUI'){ //该死的MIUI
?>
					<div id="userInfo">
						<img id="headImg" src="<?php echo $userInfo->headimgurl; ?>" width="87px" height="87px"/><br/>
						<p id="userName"><?php echo ($userInfo->nickname_html); ?></p>
					</div>
<?php
	}elseif(isset($userInfo)){
?>
					<div id="userInfo">
						<img id="headImg" src="<?php echo $userInfo->headimgurl; ?>" width="87px" height="87px" border="3"/><br/>
						<p id="userName"><?php echo ($userInfo->nickname_html); ?></p>
					</div>
<?php
	}else{
?>
					<div id="userInfo">
						<img id="headImg" src="http://wx.qlogo.cn/mmopen/W2iaF57XbMFprDAZanIYfkicwdHibVxe9nWicQf1OnH9PumiaILEYldnUvpj6rC5Cc0Ks15Vgib9NrzruhoKhhyIjtrqng0Vx1l52H/0" width="87px" height="87px" /><br/>
						<p id="userName"><?php echo '达仔'; ?></p>
					</div>

<?php
	}
?>

					<form method="post">
						<div class="row collapse" id="song">
							<span class="columns small-2 box-left" >
								<label for="name" >歌曲</label>
							</span>
							<span class="columns small-8 end box-right" style="">
								<input type="text" required="required" name="song" id="songVal" placeholder="XXX" 
								onfocus="javascript:document.getElementById('footer').style.display='none';" 
								onblur="javascript:document.getElementById('footer').style.display='block';"  />
							</span>
						</div>

						<div class="row collapse" id="tel">
							<span class="columns small-2 box-left" >
								<label for="name" >手机号</label>
							</span>
							<span class="columns small-8 end box-right" style="">
								<input type="number" required="required" name="tel" id="telVal" placeholder="长号或短号" 
								onfocus="javascript:document.getElementById('footer').style.display='none';" 
								onblur="javascript:document.getElementById('footer').style.display='block';" />
							</span>
						</div>

						<div class="row collapse" id="sex">
							<span class="columns small-2 box-left">
								<label for="sex" >性别</label>
							</span>
							<span class="columns small-8 end box-right" style="">
								<select name="sex" id="sexselect" required="required">
									<option value="null">请选择……</option>
									<option value="2">女</option>
									<option value="1">男</option>
									<option value="0">保密</option>
								</select>
							</span>
						</div>

						<div class="row collapse" id="school">
							<span class="columns small-2 box-left"  >
								<label for="school">学校</label>
							</span>
							<span class="columns small-8 end box-right"  style="">
								<select name="school"  id="schoolselect" required="required" disabled>
									<option value="null">请选择……</option>
									<option value="1" selected>华南理工大学</option>
									<option value="2">华南师范大学</option>
									<option value="3">华南农业大学</option>
									<option value="4">广东外语外贸大学</option>
									<option value="5">其他</option>
								</select>
							</span>
						</div>

						<div class="row collapse" id="school">
							<img id="submit" src="http://wechat.100steps.net/img/page5_img1.png?ver=2" />
						</div>

						<div class="row collapse" id="footer">
							<img class="img_2" src="http://wechat.100steps.net/img/footer3.png" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
	<script src="js/zepto.min.js"></script>
	<script src="js/touch.js"></script>
	<script src="js/index.js?rnd=<?php echo rand();?>"></script>
</html>