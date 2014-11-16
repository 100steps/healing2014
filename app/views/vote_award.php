<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>奖品介绍</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="zh-CN" />
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery.forwp.js"></script>
	<script type="text/javascript" src="/js/jquery.mobile-1.4.5.min.js"></script>
	<script type="text/javascript" src="/js/global.js"></script>
	<script type="text/javascript" src="/js/award_size.js"></script>
	<link rel="stylesheet" rev="stylesheet" href="/css/animations.css" type="text/css" />
	<link rel="stylesheet" rev="stylesheet" href="/css/global.css" type="text/css" />
	<script type="text/javascript">
		$(document).bind('mobileinit', function(){
            $.event.special.swipe.horizontalDistanceThreshold = 20;		//更改触发滑动距离
		})
		$(function(){
			$("#store").bind("swipeleft",function(){
				$("#store").addClass("pt-page-moveToLeft");				
				$("#award").addClass("pt-page-moveFromRight");				
				$("#option1").css("background", "rgba(0,0,0,.2)");
				$("#option2").css("background", "rgba(0,0,0,.6)");
				setTimeout(function(){
					$("#store").removeClass("pt-page-moveToLeft");				
					$("#award").removeClass("pt-page-moveFromRight");
					$(".bg").toggleClass("now");
				}, 600)
			});
			$("#award").bind("swiperight",function(){
				$("#award").addClass("pt-page-moveToRight");				
				$("#store").addClass("pt-page-moveFromLeft");				
				$("#option1").css("background", "rgba(0,0,0,.6)");
				$("#option2").css("background", "rgba(0,0,0,.2)");
				setTimeout(function(){
					$("#store").removeClass("pt-page-moveFromLeft");				
					$("#award").removeClass("pt-page-moveToRight");				
					$(".bg").toggleClass("now");
				}, 600)
			});
		});
	</script>
	<style type="text/css">
		.bg{
			display: inline-block;
			position: absolute;
			top: 0px;
			left: 0px;
			z-index: 0;
		}
		.now{
			z-index: 1;
		}
		#nav{
			position: absolute;
			text-align: center;
			z-index: 2;
		}
		.circle{
			position: relative;
			display: inline-block;
			background: rgba(0,0,0,.2);
			-moz-border-radius: 50%;		/* Gecko browsers */
			-webkit-border-radius: 50%;		/* Webkit browsers */
			border-radius: 50%;				/* W3C syntax */
		}
		#option1{
			background: rgba(0,0,0,.6);
		}
	</style>
</head>
<body>
	<img src="/img/sony_store.png" id="store" class="bg now" alt="" />
	<img src="/img/sony_award.png" id="award" class="bg" alt="" />
	<div id="nav">
		<div class="circle" id="option1"></div>
		<div class="circle" id="option2"></div>
	</div>
</body>
</html>