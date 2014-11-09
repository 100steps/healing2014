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
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/index_wp.js?rnd=<?php echo rand();?>"></script>
	</head>
	<body>		
		<div>		
			<div class="page page-5-1">
				<div class="wrap">
					<div id="userInfo">
						<img id="headImg" src="<?php echo $userInfo->headimgurl; ?>" width="87px" height="87px" border="3"/><br/>
						<p id="userName"><?php echo ($userInfo->nickname_html); ?></p>
					</div>

					<form method="post">
						<div class="row collapse" id="song">
							<span class="columns small-2 box-left" >
								<label for="name" >歌曲</label>
							</span>
							<span class="columns small-8 end box-right" style="">
								<input type="text" required="required" name="song" id="songVal" placeholder="XXX"/>
							</span>
						</div>

						<div class="row collapse" id="tel">
							<span class="columns small-2 box-left" >
								<label for="name" >手机号</label>
							</span>
							<span class="columns small-8 end box-right" style="">
								<input type="number" required="required" name="tel" id="telVal" placeholder="长号或短号" />
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
							<img id="submit" src="http://wechat.100steps.net/img/page5_img1.png?ver=2" onclick="submitHealing();" />
						</div>

						<div class="row collapse">
							<img class="img_2" src="http://wechat.100steps.net/img/footer3.png" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>