<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>选手简介-<?php echo $detail->name; ?></title>
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
			//设置已访问cookie【这部分你要不要挪到php里？】
			var GET = $.urlGet();
			$.cookie(GET["id"], "done", {expires: 20});
						
			//加载选手歌曲【注意判断扩展名】
			var musicSrc = "/record/<?php echo $detail->filename; ?>"	
			$("#music_mp3").attr("src", musicSrc + ".mp3");
			// $("#music_ogg").attr("src", musicSrc + ".ogg");		//有些歌手没有ogg的
			
			//按钮事件
			$("#play").click(function(){
				audio = $("audio")[0];
				audio.play();
			});
			$("#song").click(function(){
				audio = $("audio")[0];
				audio.play();
			});
			$("#back").click(function(){
				location.href = "/healing2014/vote";
			});
			$("#vote").click(function(){
				location.href = "/healing2014/vote/submit/<?php echo $detail->id; ?>";		//【投票处理页面（此处暂时连到投票成功页）】
			});
		});
	</script>
	<style type="text/css">
		div, img{
			position: absolute;
			/* background-color: black; */
		}
		div{
			color: white;
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
			/* font-weight: bold; */
		}
	</style>
</head>
<body>
	<img src="/img/vote_bg2.png" id="bg" alt="" />
	<img id="photo" alt="" src="/img/photo/<?php echo $detail->id; ?>.png"/>	<!--后台获取头像路径-->
	<img id="play" class="button" src="/img/play.png" alt="" />
	<div id="song"><div><?php echo $detail->song; ?></div></div>	<!--后台获取歌曲名-->
	<div id="info">	<!--后台获取选手简介-->
		<?php echo $detail->introduction; ?>
		<br/>
		参赛宣言：<?php echo $detail->declaration; ?>
	</div>
	<img id="back" src="/img/back.png" class="button" alt="" />
	<img id="vote" src="/img/vote2.png" class="button" alt="" />
	<audio>
		<source id="music_mp3" type="audio/mpeg">
		<source id="music_ogg" type="audio/ogg"> 
	</audio>
	
</body>
</html>