<?php
class VoteController extends BaseController {

	//没有微信登录全部跳转
	public function __construct(){
		if(Session::has('userInfo')){
			return View::make('success');
		}else{
			return Redirect::to('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1046e0a03d48a298&redirect_uri=http%3A%2F%2Fwx.mapp.scut.edu.cn%2Fbbt%2Fauth.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
		}
	}

	public function showList(){

	}

	public function showDetailPage(){

	}

	public function addVote(){

	}

	public function checkVote(){

	}

}