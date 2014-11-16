<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>投票结果</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="zh-CN" />
	<link rel="stylesheet" rev="stylesheet" href="/css/global.css" type="text/css" />
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery.urlget.js"></script>
	<script type="text/javascript" src="/js/global.js"></script>
	<script type="text/javascript">
		/**
		* 生成选手资料项
		* @photoSrc: 选手照片路径
		* @name: 选手名字
		* @songName: 歌曲名字
		* @votePercent: 票数百分比,范围(0~100),不带“%”号【也就是说要麻烦达仔自己计算啦~】
		*/
		function buildSingerItem(photoSrc, name, songName, votePercent){
			if($("#container .item").length >= 6)		//判断是否超出页面所能放置的选手个数
				return;
			$(' <div class="item">	\
					<img class="photo" src="' + photoSrc + '" alt="" />	\
					<div class="info"><div>	\
						<span class="name">' + name + '</span>	\
						歌曲：' + songName + '	\
					</div></div>	\
					<div class="vote">	\
						<div class="bar" style="width: ' + votePercent + '%"></div>	\
					</div>	\
				</div>	'
			).appendTo("#container");
		}
		$(function(){
			//设置翻页页码【注意：没有判断参数是否合理】

			$("#preview").click(function(){
				location.href = '/healing2014/vote/result/1'; 
			});
			$("#page").html("第" + <?php echo $pageId; ?> + "页");
			$("#next").click(function(){
				location.href = '/healing2014/vote/result/2'; 
			});
 			$("#back").click(function(){
				location.href = "/healing2014/vote";
			});
			$("#store").click(function(){
				location.href = "/healing2014/vote/award";
			});
 			
			//【建立选手资料项的demo，自行循环调用=v=】
<?php
if($pageId == 1){ //第一页
?>
			buildSingerItem("/img/photo/1.png", "<?php echo $result[0]->name; ?>", "<?php echo $result[0]->song; ?>", " <?php echo $result[0]->percent; ?>" );
			buildSingerItem("/img/photo/2.png", "<?php echo $result[1]->name; ?>", "<?php echo $result[1]->song; ?>", " <?php echo $result[1]->percent; ?>" );
			buildSingerItem("/img/photo/3.png", "<?php echo $result[2]->name; ?>", "<?php echo $result[2]->song; ?>", " <?php echo $result[2]->percent; ?>" );
			buildSingerItem("/img/photo/4.png", "<?php echo $result[3]->name; ?>", "<?php echo $result[3]->song; ?>", " <?php echo $result[3]->percent; ?>" );
			buildSingerItem("/img/photo/5.png", "<?php echo $result[4]->name; ?>", "<?php echo $result[4]->song; ?>", " <?php echo $result[4]->percent; ?>" );
			buildSingerItem("/img/photo/6.png", "<?php echo $result[5]->name; ?>", "<?php echo $result[5]->song; ?>", " <?php echo $result[5]->percent; ?>" );
<?php
}else{ //第二页
?>
			buildSingerItem("/img/photo/7.png" , "<?php echo $result[6]->name; ?>", "<?php echo $result[6]->song; ?>", "<?php echo $result[6]->percent; ?>");
			buildSingerItem("/img/photo/8.png" , "<?php echo $result[7]->name; ?>", "<?php echo $result[7]->song; ?>", "<?php echo $result[7]->percent; ?>");
			buildSingerItem("/img/photo/9.png" , "<?php echo $result[8]->name; ?>", "<?php echo $result[8]->song; ?>", "<?php echo $result[8]->percent; ?>");
			buildSingerItem("/img/photo/10.png", "<?php echo $result[9]->name; ?>", "<?php echo $result[9]->song; ?>", "<?php echo $result[9]->percent; ?>");
<?php
}
?>
		});
	</script>
	<script type="text/javascript" src="/js/result_size.js?ver=2"></script>
	<style type="text/css">
		img, #container, .button, #page{
			position: absolute;
		}
		#page{
			display: inline-block;
			text-align: center;
			/* background-color: pink; */
		}
	</style>
	<link rel="stylesheet" rev="stylesheet" href="/css/singer_item.css" type="text/css" />
</head>
<body>
	<img src="/img/result_bg2.png" id="bg" alt="" />
	<div id="container">
	</div>
	<img src="/img/preview.png" id="preview" class="button" alt="" />
	<div id="page">第1页</div>
	<img src="/img/next.png" id="next" class="button" alt="" />
	<img src="/img/enter_store.png" id="store" class="button" alt="" />
	<img src="/img/back2.png" id="back" class="button" alt="" />
	
</body>
</html>