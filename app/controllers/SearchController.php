<?php

class SearchController extends BaseController {

	public function searchKeyword( $keyword ){

		$keyword = urldecode($keyword);
		if($keyword=='null')$keyword='';

		if(Session::has('userInfo')){
			$userInfo = Session::get('userInfo');
			$openid   = $userInfo->openid;
			$nickname = $userInfo->nickname;
		}else{
			$openid = '';
			$nickname = '';
		}

		//记录
		DB::table('search_record')->insert(
			array(
				'keyword'  => $keyword , 
				'openid'   => $openid ,
				'nickname' => $nickname
			)
		);


		$result = DB::table('songlist')
					->where('song', '!=', '')		
					->where(function($query) use ($keyword){
						$query->where('song', 'like' , '%'.$keyword.'%' )
						// ->orWhere('name', 'like' , '%'.$keyword.'%' )
						->orWhere('tel', 'like' , '%'.$keyword.'%' );
					});
			

		if(Input::has('school1') && Input::get('school1')=='0' ){ //华工
			$result = $result->where('school', '!=', '1');
		}
		if(Input::has('school2') && Input::get('school2')=='0'){ //华师
			$result = $result->where('school', '!=', '2');
		}
		if(Input::has('school3') && Input::get('school3')=='0'){ //华农
			$result = $result->where('school', '!=', '3');
		}
		if(Input::has('school4') && Input::get('school4')=='0'){ 
			$result = $result->where('school', '!=', '4');
		}

		$result = $result->count();
		$array = array('count'=>$result);

		header('Content-type: application/json;charset=utf-8');
		echo json_encode($array,JSON_UNESCAPED_UNICODE);
		exit();
	}

	private function getSonglist( $keyword , $start = 0 , $count = 6 ){
		$result = DB::table('songlist')
			->select(DB::raw('avatar'))
			->skip($start)
			->take($count)
			->where('song', '!=', '')
			->where(function($query) use ($keyword){
						$query->where('song', 'like' , '%'.$keyword.'%' )
						// ->orWhere('name', 'like' , '%'.$keyword.'%' )
						->orWhere('tel', 'like' , '%'.$keyword.'%' );
					})		
			->orderBy('created_at', 'desc');
		
		if(Input::has('school1') && Input::get('school1')=='0' ){ //华工
			$result = $result->where('school', '!=', '1');
		}
		if(Input::has('school2') && Input::get('school2')=='0'){ //华师
			$result = $result->where('school', '!=', '2');
		}
		if(Input::has('school3') && Input::get('school3')=='0'){ //华农
			$result = $result->where('school', '!=', '3');
		}
		if(Input::has('school4') && Input::get('school4')=='0'){ 
			$result = $result->where('school', '!=', '4');
		}

		$result = $result->get();
		return $result;
	}

	private function getSonglist_detail( $keyword , $start = 0 , $count = 6 ){

		$result = DB::table('songlist')
			->skip($start)
			->take($count)
			->where('song', '!=', '')
			->where(function($query) use ($keyword){
						$query->where('song', 'like' , '%'.$keyword.'%' )
						// ->orWhere('name', 'like' , '%'.$keyword.'%' )
						->orWhere('tel', 'like' , '%'.$keyword.'%' );
					})
			->orderBy('created_at', 'desc');
			

		if(Input::has('school1') && Input::get('school1')=='0' ){ //华工
			$result = $result->where('school', '!=', '1');
		}
		if(Input::has('school2') && Input::get('school2')=='0'){ //华师
			$result = $result->where('school', '!=', '2');
		}
		if(Input::has('school3') && Input::get('school3')=='0'){ //华农
			$result = $result->where('school', '!=', '3');
		}
		if(Input::has('school4') && Input::get('school4')=='0'){ 
			$result = $result->where('school', '!=', '4');
		}

		$result = $result->get();
		return $result;
		
	}

	public function getSongJSON($keyword , $pageId){ //pageId starts from 1
		$keyword = urldecode($keyword);
		if($keyword=='null')$keyword='';

		$songlist = $this->getSonglist( $keyword , ($pageId-1)*6 );
		header('Content-type: application/json;charset=utf-8');
		echo json_encode($songlist,JSON_UNESCAPED_UNICODE);
		exit();
	}


	public function createSonglistPNG($keyword , $pageId=1){
		$keyword = urldecode($keyword);
		if($keyword=='null')$keyword='';

		// load data
		$songlist = $this->getSonglist_detail( $keyword , ($pageId-1)*6 );

		// config
		$font_file            = '/webroot/healing2014/app/imgbuilder/msyh.ttc';
		$emoji_file           = '/webroot/healing2014/app/imgbuilder/seguiemj.ttf';
		$font_size            = 17;
		$font_size_id         = 20;
		$font_size_school     = 14;
		$font_size_emoji      = 28;
		$font_angle           = 0;
		$font_song_leftborder = 155;
		$line_height          = 105;

		//创建图片
		$background = imagecreatefrompng('/webroot/healing2014/public/img/songlist_v2.png');
		list($bg_w, $bg_h, $head_attr) = getimagesize("/webroot/healing2014/public/img/songlist_v2.png");
		$headImg = imagecreatefrompng('/webroot/healing2014/public/img/headImg.png');

		//设定颜色
		$text_color        = imagecolorallocate($background, 0xFF, 0xFF, 0xFF); //2-4参数RGB
		$text_color2       = imagecolorallocate($background, 246, 255, 238); 
		$background_color1 = imagecolorallocate($background, 121, 212, 201); //浅色
		$background_color2 = imagecolorallocate($background, 98, 204, 191); //深色
		$sex_color1        = imagecolorallocate($background, 0xCC, 0XFF, 0XFF);
		$sex_color2        = imagecolorallocate($background, 0XFF, 0XE6, 0XEF); 
		$sex_color3        = imagecolorallocate($background, 0XE3, 0XFF, 0XCE); 
	
		for ($i=0; $i<6 ; $i++) {
			if(!isset($songlist[$i]))
				break;

			//draw ID
			$info = imagettfbbox($font_size_id , $font_angle , $font_file , "ID: ".$songlist[$i]->name );
			$ID_length = $info[2] - $info[0]; //右下角位置-左下角位置
			imagettftext($background, $font_size_id , $font_angle , $font_song_leftborder , 32 + $line_height*$i , 
				$text_color, $font_file , "ID: ".$songlist[$i]->name );

			//draw tel
			imagettftext($background, $font_size , $font_angle , $font_song_leftborder , 94 + $line_height*$i , 
				$text_color, $font_file , $songlist[$i]->tel );

			//draw song
			imagettftext($background, $font_size , $font_angle , $font_song_leftborder , 64 + $line_height*$i , 
				$text_color, $font_file , "想听 ".$songlist[$i]->song);

			//draw gender
			if($songlist[$i]->gender==1){ //male
				imagettftext($background, $font_size_emoji , $font_angle , $font_song_leftborder +$ID_length +5 , 32 + $line_height*$i , 
					$sex_color1, $emoji_file , '♂');
			}elseif($songlist[$i]->gender==2){ //female
				imagettftext($background, $font_size_emoji , $font_angle , $font_song_leftborder +$ID_length +5 , 32 + $line_height*$i , 
					$sex_color2, $emoji_file , '♀');
			}else{ //unknown
				imagettftext($background, $font_size_emoji , $font_angle , $font_song_leftborder +$ID_length +5 , 32 + $line_height*$i , 
					$sex_color3, $emoji_file , '⚥');			
			}

			//draw school
			if($songlist[$i]->school==0){ //未知
				// imagettftext($background, $font_size_school , $font_angle , $font_song_leftborder +$ID_length +35 , 32 + $line_height*$i , 
				// 	$text_color2, $font_file , "来自星星");
			}elseif($songlist[$i]->school==1){ //华工
				imagettftext($background, $font_size_school , $font_angle , $font_song_leftborder +$ID_length +35 , 32 + $line_height*$i , 
					$text_color2, $font_file , "来自华工");
			}elseif($songlist[$i]->school==2){ //华师
				imagettftext($background, $font_size_school , $font_angle , $font_song_leftborder +$ID_length +35 , 32 + $line_height*$i , 
					$text_color2, $font_file , "来自华师");
			}elseif($songlist[$i]->school==3){ //华农
				imagettftext($background, $font_size_school , $font_angle , $font_song_leftborder +$ID_length +35 , 32 + $line_height*$i , 
					$text_color2, $font_file , "来自华农");
			}elseif($songlist[$i]->school==4){ //广外
				imagettftext($background, $font_size_school , $font_angle , $font_song_leftborder +$ID_length +35 , 32 + $line_height*$i , 
					$text_color2, $font_file , "来自广外");
			}
			
			$headImg = imagecreatefrompng('/webroot/healing2014/public/img/headImg.png');

		}


		// Output and free from memory
		header("Content-type: image/x-png");
		// header("Content-Disposition: attachment; filename=治愈系".time().".png");
		
		imagepng($background);
		imagedestroy($background);

		exit;
	}




}