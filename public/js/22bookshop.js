var imgUrl             = 'http://wechat.100steps.net/img/ad_img1.png';
var lineLink           = 'http://wechat.100steps.net/healing2014/22bookshop'; //这个是分享的网址
var descContent        = '22bookshop，1200bookshop五山分店，致力于传承同时希望打造属于五山的青年空间，位于华工五山正门食街尽头。';
var shareTimelineTitle = '22bookshop';
var shareFriendTitle   = '22bookshop';
var appid              = '';  //这里写开发者接口里的appid


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


