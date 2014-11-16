<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>投票成功</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="zh-CN" />
	<link rel="stylesheet" rev="stylesheet" href="/css/global.css" type="text/css" />
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/global.js"></script>
	<script type="text/javascript" src="/js/success_size.js"></script>
	<script type="text/javascript">
		$(function(){
			$("#store").click(function(){
				location.href = "/healing2014/vote/award";
			});
			$("#result").click(function(){
				location.href = "/healing2014/vote/result/1";
			});
		});
	</script>
	<style type="text/css">
		img{
			position: absolute;
		}
	</style>
</head>
<body>
	<img src="/img/success_bg.png" id="bg" alt="" />
	<img src="/img/enter_store.png" id="store" class="button" alt="" />
	<img src="/img/result.png" id="result" class="button" alt="" />
	
</body>
</html>