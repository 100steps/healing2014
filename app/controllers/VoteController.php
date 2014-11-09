<?php
class VoteController extends BaseController {

	//没有微信登录全部跳转
	public function __construct(){
		// if(Session::has('userInfo')){
		// 	return View::make('success');
		// }else{
		// 	return Redirect::to('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1046e0a03d48a298&redirect_uri=http%3A%2F%2Fwx.mapp.scut.edu.cn%2Fbbt%2Fauth.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
		// }
	}

	public function showList(){
		echo '<h1>治愈人气王：有没有一首歌可以打动你的心灵？有没有一支曲可以治愈你的伤口？有没有一个人可以得到你的掌声？现在，用你鼓励与赞扬的掌声，给歌者一个重新回到舞台的机会，唱起那首可以治愈你心灵的歌，让伟大的治愈人气王，捧起最终的治愈之杯，得到整个治愈国度最崇高的敬意吧！活动介绍：在这里，我们将让新生代南、北校决赛后遗憾淘汰的选手每人做出一个自己拿手音乐的录音并推送出来，届时由大家来投票。最终得票最高的一位歌者将被选为治愈人气王，不仅可以得到治愈人气终极大奖，还可以得到在新生代南北校总决赛时上台演唱的机会！投票即将开始，敬请期待～</h1>';
	}

	public function showList_test(){
		return View::make('vote_main');
	}

	public function showDetailPage($id){
		return View::make('vote_detail');
	}

	public function addVote(){

	}

	public function checkVote(){

	}

}