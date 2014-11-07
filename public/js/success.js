(function(){
	var $_GET = (function(){
		var url = window.document.location.href.toString();
		var u = url.split("?");
		if(typeof(u[1]) == "string"){
			u = u[1].split("&");
			var get = {};
			for(var i in u){
				var j = u[i].split("=");
				get[j[0]] = j[1];
			}
			return get;
		}else{
			return {};
		}
	})();

	var now         = { row:1, col:1 }, last = { row:0, col:0};
	const towards   = { up:1, right:2, down:3, left:4};
	var isAnimating = false;
	var pageCount   = 1;
	var submitted   = false;

	var imgUrl             = 'http://wechat.100steps.net/img/fire.png';
	var lineLink           = 'http://wechat.100steps.net/healing2014'; //这个是分享的网址
	var descContent        = '';
	var shareTimelineTitle = 'BBT治愈系';
	var shareFriendTitle   = 'BBT治愈系';
	var appid              = '';  //这里写开发者接口里的appid

	s=window.innerHeight/500;
	ss=250*(1-s);

	$('.wrap').css('-webkit-transform','scale('+s+','+s+') translate(0px,-'+ss+'px)');

	if($_GET['song'] != undefined && $_GET['name'] != undefined && $_GET['tel'] != undefined){
		var song = decodeURI($_GET['song']);
		var name = decodeURI($_GET['name']);
		var tel  = decodeURI($_GET['tel']);
		shareTimelineTitle = descContent = '我在治愈系点了《' + song + '》,快拨打' + tel + '治愈我吧~';
		shareFriendTitle = name + '在治愈系点歌啦!';
	}else{

	}


	function shareFriend() {
	WeixinJSBridge.invoke('sendAppMessage',{
			"appid": appid,
			"img_url": imgUrl,
			"img_width": "640",
			"img_height": "640",
			"link": lineLink,
			"desc": descContent,
			"title": shareFriendTitle
		}, function(res) {
			_report('send_msg', res.err_msg);
		})
	}

	function shareTimeline() {
	WeixinJSBridge.invoke('shareTimeline',{
			"img_url": imgUrl,
			"img_width": "640",
			"img_height": "640",
			"link": lineLink,
			"desc": descContent,
			"title": shareTimelineTitle
		}, function(res) {
			_report('timeline', res.err_msg);
		});
	}

	function shareWeibo() {
		WeixinJSBridge.invoke('shareWeibo',{
			"content": descContent,
			"url": lineLink,
		}, function(res) {
			_report('weibo', res.err_msg);
		});
	}
	// 当微信内置浏览器完成内部初始化后会触发WeixinJSBridgeReady事件。
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		// 发送给好友
		WeixinJSBridge.on('menu:share:appmessage', function(argv){
			shareFriend();
		});
		// 分享到朋友圈
		WeixinJSBridge.on('menu:share:timeline', function(argv){
			shareTimeline();
		});
		// 分享到微博
		WeixinJSBridge.on('menu:share:weibo', function(argv){
			shareWeibo();
		});
	}, false);


	document.addEventListener('touchmove',function(event){
		event.preventDefault(); },false);

	$(document).swipeLeft(function(){
		if (isAnimating) return;
		last.row = now.row;
		last.col = now.col;
		if (last.col==1) {
			now.row = last.row; now.col = 2;
			pageMove(towards.left);
		}
	})
	$(document).swipeRight(function(){
		if (isAnimating) return;
		last.row = now.row;
		last.col = now.col;
		if (last.col==2) {
			now.row = last.row; now.col = 1;
			pageMove(towards.right);
		}
	})
	$(document).swipeUp(function(){})
	$(document).swipeDown(function(){})

	function pageMove(tw){
		var lastPage = ".page-"+last.row+"-"+last.col,
			nowPage = ".page-"+now.row+"-"+now.col;
		
		switch(tw) {
			case towards.up:
				outClass = 'pt-page-moveToTop';
				inClass = 'pt-page-moveFromBottom';
				break;
			case towards.right:
				outClass = 'pt-page-moveToRight';
				inClass = 'pt-page-moveFromLeft';
				break;
			case towards.down:
				outClass = 'pt-page-moveToBottom';
				inClass = 'pt-page-moveFromTop';
				break;
			case towards.left:
				outClass = 'pt-page-moveToLeft';
				inClass = 'pt-page-moveFromRight';
				break;
		}
		isAnimating = true;
		$(nowPage).removeClass("hide");
		
		$(lastPage).addClass(outClass);
		$(nowPage).addClass(inClass);
		
		setTimeout(function(){
			$(lastPage).removeClass('page-current');
			$(lastPage).removeClass(outClass);
			$(lastPage).addClass("hide");
			$(lastPage).find("img").addClass("hide");
			
			$(nowPage).addClass('page-current');
			$(nowPage).removeClass(inClass);
			$(nowPage).find("img").removeClass("hide");
			
			isAnimating = false;
		},600);
	};

})();

