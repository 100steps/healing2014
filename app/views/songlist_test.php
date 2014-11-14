<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BBT治愈系-歌单</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
		<!-- <link rel="stylesheet" href="/css/jquery.mobile-1.4.5.min.css" /> -->
		<link rel="stylesheet" type="text/css" href="/css/reset.css?ver=2" />
		<link rel="stylesheet" type="text/css" href="/css/songlist_test.css?rnd=<?php echo rand();?>" />
		<!-- <link rel="stylesheet" type="text/css" href="/css/foundation.css" /> -->	
	</head>
	<body>
		

		<div class="page page-1-1" id="pageone" data-role="page">
			<div class="searchBox">
				<table class="searchArea">
					<tr><td>
						<input type="text" class="searchInput" placeholder="搜索歌曲 / 号码" id="keyword"  data-role="none"/>
						<img class="searchReset" id="reset" src="/img/songlist_reset.png" />
					</td></tr>
					<tr><td>
						<span class="from">来自 : </span>
						<span class="schoolselected school" id="school1">华工</span>
						<span class="schoolselected school" id="school2">华农</span>
					</td></tr>				
				</table>
				<span style="color:white" id="submit">搜索</span>
			</div>

			<div class="songlist" id="songlist" listcount="<?php echo $list_count; ?>"  currentcount="1" result="0" >
				<img src="http://wechat.100steps.net/healing2014/gen/songlist/1" class="songimg" />
			</div>

			<div class="headimglist">
				<table>
					<tr><td><img id="head0" class="headimg" src="/img/headImg.png"></td></tr>
					<tr><td><img id="head1" class="headimg" src="/img/headImg.png"></td></tr>
					<tr><td><img id="head2" class="headimg" src="/img/headImg.png"></td></tr>
					<tr><td><img id="head3" class="headimg" src="/img/headImg.png"></td></tr>
					<tr><td><img id="head4" class="headimg" src="/img/headImg.png"></td></tr>
					<tr><td><img id="head5" class="headimg" src="/img/headImg.png"></td></tr>
				</table>
			</div>

			<div class="pageControl">
				<img id="prev" class="pageControlImg" src="/img/songlist_prev.png?ver=2" />
				<span id="pagenum">1</span><span> of </span><span id="pagetotal"><?php echo $list_count; ?></span>
				<img id="next" class="pageControlImg" src="/img/songlist_next.png?ver=2" />
				<img id="random" class="pageControlImg" src="/img/songlist_rand.png?ver=3" />
			</div>

			<div class="footerdiv">
				<img class="footer" src="http://wechat.100steps.net/img/footer2.png" />
			</div>
		</div>

		<script src="/js/jquery-1.11.1.min.js"></script>
		<script src="/js/jquery.mobile-1.4.5.min.js"></script>
		<script src="/js/songlist_test.js?rnd=<?php echo rand();?>"></script>
	</body>
</html>