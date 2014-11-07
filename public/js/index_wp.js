var imgUrl      = 'http://wechat.100steps.net/img/fire.png';
var lineLink    = 'http://wechat.100steps.net/healing2014';
var descContent = '';
var shareTitle  = '治愈系2014';
var appid       = '';
var shareTitle  = 'BBT治愈系';
var momentTitle = 'BBT治愈系';

s=window.innerHeight/500;
ss=250*(1-s);

$('.wrap').css('-webkit-transform','scale('+s+','+s+') translate(0px,-'+ss+'px)');

$("#submit").("click",function(){
	if(submitted)
		return;
	else
		submitted = true;

	var name   = $("#userName").text();
	var song   = $("#songVal").val();
	var tel    = $("#telVal").val();

	var t = document.getElementById("sexselect"); 
	var sex = (t.options[t.selectedIndex].value);

	var t = document.getElementById("schoolselect"); 
	var school = (t.options[t.selectedIndex].value);
	
	// 检查表单
	if(song==""){
		alert("请输入歌曲名字~");
		submitted = false;
		return;
	}
	if(tel==""){
		alert("请输入电话~");
		submitted = false;
		return;
	}
	if(sex=='null'){
		alert("请选择性别~");
		submitted = false;
		return;
	}
	if(school=='null'){
		alert("请选择学校~");
		submitted = false;
		return;
	}


	shareTitle = name + '在治愈系点歌啦!';
	descContent = '我在治愈系点了《' + song + '》,快拨打' + tel + '治愈我吧~';
	momentTitle =  name + '在治愈系点了一首《' + song + '》, 求治愈~';

	$.ajax({
		type: 'POST',
		url: 'http://wechat.100steps.net/healing2014',
		// post payload:
		data: { 
			name: name ,
			song: song ,
			tel: tel ,
			sex: sex ,
			school: school
		},
		dataType: 'json',
		contentType: 'application/json',
		success: function(data){
			// alert('点歌成功!分享到朋友圈');
			var query = encodeURI("song="+song+"&tel="+tel+"&name="+name);
			location.href = 'http://wechat.100steps.net/healing2014/success?'+query;
		},
		error: function(xhr, type){
			alert('Ajax error!');
			submitted = false;
		}
	})
});


function shareFriend() {
	WeixinJSBridge.invoke('sendAppMessage',{
		"appid": appid,
		"img_url": imgUrl,
		"img_width": "640",
		"img_height": "640",
		"link": lineLink,
		"desc": descContent,
		"title": shareTitle
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
		"title": momentTitle
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

