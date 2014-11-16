<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>治愈人气王</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="zh-CN" />
	<link rel="stylesheet" rev="stylesheet" href="/css/global.css" type="text/css" />
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="/js/global.js"></script>
	<script type="text/javascript" src="/js/index_size.js"></script>
	<script type="text/javascript">
		$(function(){
			$(".photo").each(function(){		//根据cookies记录显示头像
				var id = $(this).attr("id"); 
				if (!$.cookie(id)){
					$(this).attr({
						"src": "/img/photo/unknown.png",
					});
				}
				else{
					var photoSrc = "/img/photo/" + id +".png";
					$(this).attr({
						"src": photoSrc ,
					});
				}
			});
			$(".photo").click(function(){
				var audioId = "#record" + $(this).attr("id"); 
				var audio = $(audioId)[0];
				if (!audio.paused){		//播放歌曲是单击跳转选手介绍
					location.href = "/healing2014/vote/detail/" + $(this).attr("id");
				}
				else{		//未播放歌曲时单击播放歌曲
					$("audio").each(function(){
						if(!$(this)[0].paused)
							$(this)[0].pause();
					});
					audio.play();
				}
			});
		});
	</script>
	<style type="text/css">
		#container{
			position: absolute;
			/* background-color: white; */
		}
		.photo{
			float: left;
			margin-bottom: 11%;
			margin-right: 3%;
			width: 20.5%;
			border-style: solid;
			border-color: #FFF;
		}
		#invisible{
			float: left;
			margin-bottom: 10%;
			margin-right: 3%;
			width: 22%;
		}
	</style>
</head>
<body>
	<img src="/img/index_bg.png" id="bg" alt="" />
	<div id="container">
		<!-- 选手头像 -->
		<img id="1" src="/img/photo/unknown.png" alt="" class="photo button" />
		<img id="2" src="/img/photo/unknown.png" alt="" class="photo button" />
		<img id="3" src="/img/photo/unknown.png" alt="" class="photo button" />
		<img id="4" src="/img/photo/unknown.png" alt="" class="photo button" />
		<img id="5" src="/img/photo/unknown.png" alt="" class="photo button" />
		<img id="6" src="/img/photo/unknown.png" alt="" class="photo button" />
		<img id="7" src="/img/photo/unknown.png" alt="" class="photo button" />
		<img id="8" src="/img/photo/unknown.png" alt="" class="photo button" />
		<div alt="" id="invisible"></div>
		<img id="9" src="/img/photo/unknown.png" alt="" class="photo button" />
		<img id="10" src="/img/photo/unknown.png" alt="" class="photo button" />

		<!-- 选手歌曲（因浏览器兼容问题提供两种歌曲格式） -->
		<audio id="record1">
			<source src="/record/01lin.mp3" type="audio/mpeg"> 
		</audio>
		<audio id="record2">
			<source src="/record/02wei.mp3" type="audio/mpeg">
			<source src="/record/02wei.ogg" type="audio/ogg"> 
		</audio>
		<audio id="record3">
			<source src="/record/03li.mp3" type="audio/mpeg"> 
		</audio>
		<audio id="record4">
			<source src="/record/04chen.mp3" type="audio/mpeg">
			<source src="/record/04chen.ogg" type="audio/ogg"> 
		</audio>
		<audio id="record5">
			<source src="/record/05cai.mp3" type="audio/mpeg"> 
		</audio>
		<audio id="record6">
			<source src="/record/06xu.mp3" type="audio/mpeg"> 
		</audio>
		<audio id="record7">
			<source src="/record/07li.mp3" type="audio/mpeg"> 
			<source src="/record/07li.ogg" type="audio/ogg"> 
		</audio>
		<audio id="record8">
			<source src="/record/08wei.mp3" type="audio/mpeg"> 
			<source src="/record/08wei.ogg" type="audio/ogg"> 
		</audio>
		<audio id="record9">
			<source src="/record/09wei.mp3" type="audio/mpeg"> 
		</audio>
		<audio id="record10">
			<source src="/record/10nian.mp3" type="audio/mpeg"> 
		</audio>
	</div>
</body>
</html>