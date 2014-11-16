<?php
class VoteController extends BaseController {

	//没有微信登录全部跳转
	public function __construct(){
		
	}

	public function showList(){
		if(Session::has('userInfo')){
			return View::make('vote_main');
		}else{
			return Redirect::to('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1046e0a03d48a298&redirect_uri=http%3A%2F%2Fwx.mapp.scut.edu.cn%2Fbbt%2Fauth3.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
		}
	}

	public function showList_test(){ //主页面
		if(Session::has('userInfo')){
			return View::make('vote_main');
		}else{
			return Redirect::to('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1046e0a03d48a298&redirect_uri=http%3A%2F%2Fwx.mapp.scut.edu.cn%2Fbbt%2Fauth3.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
		}
		
	}

	public function showDetailPage($id){ //选手介绍页面
		$detail = DB::table('vote_list')->where('id', $id)->first();

		if(isset($detail->name)){
			return View::make('vote_detail')->with('detail',$detail);
		}
		
	}

	public function showSuccessPage(){ 
		return View::make('vote_success');
	}

	public function showResultPage($pageId){ 
		if( $pageId != '2' || $pageId == '1' )
			$pageId = 1;
		else
			$pageId = 2;

		$result = DB::table('vote_list')->get();
		$sum = 0;

		foreach ($result as $key => $value) {
			$sum += $value->votecount;
		}
		foreach ($result as &$value) {
			$value->percent = $value->votecount / $sum * 100;
		}

		return View::make('vote_result')->with('pageId',$pageId)->with('result',$result);
	}

	public function showAwardPage(){ //奖品展示
		return View::make('vote_award');
	}

	public function submitVote($id){
		if(Session::has('userInfo')){
			$result = $this->vote($id);

			if($result){ //投票成功,跳转到成功页面
				return Redirect::to('healing2014/vote/success');
			}else{ //投票失败,弹框,跳转到?
				echo "<script>alert('你已经投过票啦!现在跳转到结果页面。');location.href='/healing2014/vote/result/1';</script>";
			}
		}else{
			return Redirect::to('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1046e0a03d48a298&redirect_uri=http%3A%2F%2Fwx.mapp.scut.edu.cn%2Fbbt%2Fauth3.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
		}
	}

	private function vote($vote_id){ //投票处理
		if(Session::has('userInfo')){
			$userInfo = Session::get('userInfo');

			if(DB::table('vote_record')->where('openid', $userInfo->openid )->first()){ //已投票
				return false;
			}else{ 																		//未投票
				DB::table('vote_record')->insert(
					array(
						'openid'  => $userInfo->openid, 
						'vote_id' => $vote_id,
						'ip_address' => $this->getIP()
					)
				);

				$votecount = DB::table('vote_list')->where('id', $vote_id)->pluck('votecount');
				DB::table('vote_list')
					->where('id', $vote_id)
            		->update(array('votecount' => ++$votecount));

            	return true;
			}
		}else{

		}
	}


	private function getIP(){
		$ip  = getenv("REMOTE_ADDR");  
		$ip1 = getenv("HTTP_X_FORWARDED_FOR");  
		$ip2 = getenv("HTTP_CLIENT_IP");  
		($ip1) ? $ip = $ip1 : null;  
		($ip2) ? $ip = $ip2 : null;  
		return $ip;
	}

}