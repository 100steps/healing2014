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
    } else {
        return {};
    }
})();

var imgUrl             = 'http://wechat.100steps.net/img/fire.png';
var lineLink           = 'http://wechat.100steps.net/healing2014'; //这个是分享的网址
var descContent        = '';
var shareTimelineTitle = 'BBT治愈系';
var shareFriendTitle   = 'BBT治愈系';
var appid              = '';  //这里写开发者接口里的appid

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


