<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>治愈人气王-xxx</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="zh-CN" />
	<link rel="stylesheet" rev="stylesheet" href="/css/global.css" type="text/css" />
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="/js/jquery.urlget.js"></script>
	<script type="text/javascript" src="/js/global.js"></script>
	<script type="text/javascript" src="/js/info_size.js"></script>
	<script type="text/javascript">
		$(function(){
			//设置已访问cookie
			var GET = $.urlGet();
			$.cookie(GET["id"], "done", {expires: 1});
			
			//加载选手头像（路径由后台获取）
			var photoSrc = "/img/photo/头像.png";
			$("#photo").attr("src", photoSrc);
			
			//加载选手歌曲（路径由后台获取）
			var musicSrc = "/record/What Are Words"		//不带扩展名
			$("#music_ogg").attr("src", musicSrc + ".ogg");
			$("#music_mp3").attr("src", musicSrc + ".mp3");
			
			//按钮事件
			$("#play").click(function(){
				audio = $("audio")[0];
				audio.play();
			});
			$("#back").click(function(){
				location.href = "index.php";
			});
			$("#vote").click(function(){
				location.href = "";
			});
		});
	</script>
	<style type="text/css">
		div{
			position: absolute;
			/*background-color: black;*/
		}
		img{
			position: absolute;
		}
		#photo{
			-moz-border-radius: 50%;		/* Gecko browsers */
			-webkit-border-radius: 50%;		/* Webkit browsers */
			border-radius: 50%;				/* W3C syntax */
		}
		#song div{
			position: relative;
			display: table-cell;
			vertical-align: middle;
			height: 30px;
			/*font-weight: bold;*/
		}
	</style>
</head>
<body>
	<img src="/img/vote_bg2.png" id="bg" alt="" />
	<img id="photo" alt="" />
	<img id="play" class="button" src="/img/play.png" alt="" />
	<div id="song"><div>nothing gonna change my love for you<br/>你好吗</div></div>
	<div id="info">我和你</div>
	<img id="back" src="/img/back.png" class="button" alt="" />
	<img id="vote" src="/img/vote.png" class="button" alt="" />
	<audio>
		<source id="music_ogg" src="/record/喜欢你.ogg" type="audio/ogg"> 
		<source id="music_mp3" src="/record/喜欢你.mp3" type="audio/mpeg">
	</audio>
</body>
</html>