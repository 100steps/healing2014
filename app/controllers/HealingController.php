<?php
require_once __DIR__.'/emoji.php';

class HealingController extends BaseController {

	private $access_token;
	private $expires_in;
	private $refresh_token;
	private $openid;

	public function auth($code){ 
		$result = $this->get_access_token($code);
		
		if(!isset($result->errcode)){

			$this->access_token  = $result->access_token;
			$this->expires_in    = $result->expires_in;
			$this->refresh_token = $result->refresh_token;
			$this->openid        = $result->openid;

			$userInfo = $this->getUserInfo();

			// 改变头像的分辨率
			$userInfo->headimgurl = substr($userInfo->headimgurl, 0 , strlen($userInfo->headimgurl)-1 ).'/96';

			// 改变emoji表情编码
			$userInfo->nickname = emoji_softbank_to_unified($userInfo->nickname);
			$userInfo->nickname_html = emoji_unified_to_html($userInfo->nickname);

			Session::put('userInfo',$userInfo);
			
			if($userInfo->openid == 'oTIXKt2z1AAxHMxi8MHDaYP4GkzU'){
				return Redirect::to('http://wechat.100steps.net/healing2014');
			}else{
				// echo '治愈系工地施工中~';
				return Redirect::to('http://wechat.100steps.net/healing2014');
			}
			
		}else{
			echo 'Invalid code!';
		}
	}

	public function auth2($code){ 
		$result = $this->get_access_token($code);
		
		if(!isset($result->errcode)){

			$this->access_token  = $result->access_token;
			$this->expires_in    = $result->expires_in;
			$this->refresh_token = $result->refresh_token;
			$this->openid        = $result->openid;

			$userInfo = $this->getUserInfo();

			// 改变头像的分辨率
			$userInfo->headimgurl = substr($userInfo->headimgurl, 0 , strlen($userInfo->headimgurl)-1 ).'/96';

			// 改变emoji表情编码
			$userInfo->nickname = emoji_softbank_to_unified($userInfo->nickname);
			$userInfo->nickname_html = emoji_unified_to_html($userInfo->nickname);

			Session::put('userInfo',$userInfo);
			
			if($userInfo->openid == 'oTIXKt2z1AAxHMxi8MHDaYP4GkzU'){
				return Redirect::to('http://wechat.100steps.net/healing2014/list');
			}else{
				// echo '治愈系工地施工中~';
				return Redirect::to('http://wechat.100steps.net/healing2014/list');
			}
			
		}else{
			echo 'Invalid code!';
		}
	}

	public function auth3($code){ 
		$result = $this->get_access_token($code);
		
		if(!isset($result->errcode)){

			$this->access_token  = $result->access_token;
			$this->expires_in    = $result->expires_in;
			$this->refresh_token = $result->refresh_token;
			$this->openid        = $result->openid;

			$userInfo = $this->getUserInfo();

			// 改变头像的分辨率
			$userInfo->headimgurl = substr($userInfo->headimgurl, 0 , strlen($userInfo->headimgurl)-1 ).'/96';

			// 改变emoji表情编码
			$userInfo->nickname = emoji_softbank_to_unified($userInfo->nickname);
			$userInfo->nickname_html = emoji_unified_to_html($userInfo->nickname);

			Session::put('userInfo',$userInfo);
			
			if($userInfo->openid == 'oTIXKt2z1AAxHMxi8MHDaYP4GkzU'){
				return Redirect::to('http://wechat.100steps.net/healing2014/test/vote');
			}else{
				// echo '治愈系工地施工中~';
				return Redirect::to('http://wechat.100steps.net/healing2014/test/vote');
			}
			
		}else{
			echo 'Invalid code!';
		}
	}

	public function index(){
		// if(time()<1415453400){
		// 	header("Content-type: text/html; charset=utf-8");
		// 	echo '<h1>治愈系活动于11月8号21点30分开始,敬请留意~</h1>';
		// 	exit;
		// }

		if(Session::has('userInfo')){
			if(preg_match("/534.30/",$_SERVER["HTTP_USER_AGENT"])){ //miui独立拉出来设置CSS
				return View::make('index')->with('userInfo', Session::get('userInfo'))->with('system','MIUI');
			}elseif(preg_match("/MSIE/",$_SERVER["HTTP_USER_AGENT"])){ //该死的IE,WP不要治愈了好嘛?
				return View::make('index_wp')->with('userInfo', Session::get('userInfo'));
			}else{ //正常
				return View::make('index')->with('userInfo', Session::get('userInfo'));
			}	
		}else{
			// return View::make('index');
			return Redirect::to('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1046e0a03d48a298&redirect_uri=http%3A%2F%2Fwx.mapp.scut.edu.cn%2Fbbt%2Fauth.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
		}
	}

	public function save(){
		$input = file_get_contents("php://input");
		$array = array();
		parse_str($input,$array);
		// var_dump($array);

		$song         = new Song;
		$song->name   = $array['name'];
		$song->song   = $array['song'];
		$song->tel    = $array['tel'];
		$song->gender = $array['sex'];
		$song->school = $array['school'];
		$song->mid    = 'fakeid'.time();
		
		if(Session::has('userInfo')){
			$userInfo     = Session::get('userInfo');
			$song->openid = $userInfo->openid;
			$song->avatar = $userInfo->headimgurl;
			$song->mid    = $userInfo->openid.time();
		}

		$result = $song->save();

		// 保存点歌分享信息到session
		$share = new stdClass;
		$share->name = $song->name;
		$share->song = $song->song;
		$share->tel  = $song->tel;
		Session::put('share',$share);


		if($result){
			return Response::json(array('msg' => 'success'));
		}else{
			return Response::json(array('msg' => 'failure'));
		}
	}

	public function success(){
		if(Session::has('userInfo')){
			return View::make('success');
		}else{
			return Redirect::to('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1046e0a03d48a298&redirect_uri=http%3A%2F%2Fwx.mapp.scut.edu.cn%2Fbbt%2Fauth.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
		}
		
	}

	public function show22bookshop(){
		return View::make('22bookshop');
	}


	/*
	|--------------------------------------------------------------------------
	| 通过code换取网页授权access_token
	|--------------------------------------------------------------------------
	|
	| 正确时返回的JSON数据包如下：
	| {
	|   "access_token":"ACCESS_TOKEN",
	|   "expires_in":7200,
	|   "refresh_token":"REFRESH_TOKEN",
	|   "openid":"OPENID",
	|   "scope":"SCOPE"
	| }
	|
	*/
	private function get_access_token($code){
		$baseurl = 'https://api.weixin.qq.com/sns/oauth2/access_token';
		$query = array(
			'appid'      => Config::get('wechat.appid'),
			'secret'     => Config::get('wechat.appsecret'),
			'code'       => $code,
			'grant_type' => 'authorization_code'
		);
		$url    = $baseurl.'?'.http_build_query($query);
		$json   = file_get_contents($url);
		$result = json_decode($json);
		return $result;
	}


	/*
	|--------------------------------------------------------------------------
	| 拉取用户信息(需scope为 snsapi_userinfo)
	|--------------------------------------------------------------------------
	|
	| {
	|   "openid":" OPENID",
	|   " nickname": NICKNAME,
	|   "sex":"1",
	|   "province":"PROVINCE"
	|   "city":"CITY",
	|   "country":"COUNTRY",
	|    "headimgurl":    "http://wx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/46", 
	|	"privilege":[
	|	"PRIVILEGE1"
	|	"PRIVILEGE2"
	|    ]
	|}
	|
	*/
	public function getUserInfo(){
		$baseurl = 'https://api.weixin.qq.com/sns/userinfo';
		$query = array(
			'access_token' => $this->access_token,
			'openid'       => $this->openid,
			'lang'         => 'zh_CN' 
		);
		$url = $baseurl.'?'.http_build_query($query);
		$json = file_get_contents($url);
		return json_decode($json);
	}

}