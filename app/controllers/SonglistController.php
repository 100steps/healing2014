<?php

class SonglistController extends BaseController {

	public function showSonglist(){
		$songlist = $this->getSonglist();
		foreach ($songlist as $key => $value) {
			$value->song = $this->telHighlight($value->song);
		}
		// return View::make('songlist1')->with('songlist',$songlist);
		return View::make('songlist');
	}

	public function createSonglistPNG($pageId){
		// load data
		$songlist = $this->getSonglist(($pageId-1)*15);

		// config
		$font_file  = '/webroot/healing2014/app/imgbuilder/msyh.ttc';
		$emoji_file = '/webroot/healing2014/app/imgbuilder/seguiemj.ttf';
		$font_size  = 18;
		$font_angle = 0;
		$font_tel_rightborder = 205;
		$font_song_leftborder = 244;

		//创建图片
		$background = imagecreatefrompng('/webroot/healing2014/public/img/songlist_background.png');
		list($bg_w, $bg_h, $head_attr) = getimagesize("/webroot/healing2014/public/img/songlist_background.png");

		//设定颜色
		$text_color        = imagecolorallocate($background, 0xFF, 0xFF, 0xFF); //2-4参数RGB
		$background_color1 = imagecolorallocate($background, 203, 203, 203); 
		$background_color2 = imagecolorallocate($background, 200, 200, 200); 
		$sex_color1        = imagecolorallocate($background, 0xCC, 0XFF, 0XFF);
		$sex_color2        = imagecolorallocate($background, 0XFF, 0XE6, 0XEF); 
		$sex_color3        = imagecolorallocate($background, 0XE3, 0XFF, 0XCE); 


		
		for ($i=0; $i<15 ; $i++) {
			if(!isset($songlist[$i]))
				break;
			//draw tel
			$info = imagettfbbox($font_size , $font_angle , $font_file , $songlist[$i]->tel );
			$font_length = $info[2] - $info[0]; //右下角位置-左下角位置
			imagettftext($background, $font_size , $font_angle , $font_tel_rightborder - $font_length , 30+round(700/15*$i)  , $text_color, $font_file , $songlist[$i]->tel );
			//draw song
			imagettftext($background, $font_size , $font_angle , $font_song_leftborder , 30+round(700/15*$i) , $text_color, $font_file , $songlist[$i]->song);
			//draw gender
			if($songlist[$i]->gender==1){ //male
				imagettftext($background, $font_size , $font_angle , $font_tel_rightborder+5 , 30+round(700/15*$i) , $sex_color1, $emoji_file , '♂');
			}elseif($songlist[$i]->gender==2){ //female
				imagettftext($background, $font_size , $font_angle , $font_tel_rightborder+5 , 30+round(700/15*$i) , $sex_color2, $emoji_file , '♀');
			}else{ //unknown
				imagettftext($background, $font_size , $font_angle , $font_tel_rightborder+5 , 30+round(700/15*$i) , $sex_color3, $emoji_file , '⚥');			
			}
		}


		
		// Output and free from memory
		header("Content-type: image/x-png");
		// header("Content-Disposition: attachment; filename=治愈系".time().".png");
		
		imagepng($background);
		imagedestroy($background);

		exit;
	}

	public function getSongJSON($pageId){ //pageId starts from 1
		$songlist = $this->getSonglist(($pageId-1)*15);
		header('Content-type: application/json;charset=utf-8');
		echo json_encode($songlist,JSON_UNESCAPED_UNICODE);
		exit();
	}


	private function getSonglist( $start = 0 ,$count = 15 ){
		return DB::table('songlist')->skip($start)->take($count)->get();
	}


	private function telHighlight($str){
		$str = htmlspecialchars($str);
		$patterns[0] = "/\&lt\;(.*)\&gt\;/U";
		$patterns[1] = "/《(.*)》/U";
		$patterns[2] = "/＜(.*)＞/U";
		$patterns[3] = '/\&quot;(.*)\&quot\;/U';
		$patterns[4] = '/“(.*)”/U';
		$patterns[5] = '/≪(.*)≫/U';
		$patterns[6] = '/〈(.*)〉/U';
		foreach ($patterns as $pattern){
			$res = preg_match_all($pattern,$str,$arr);
			if($arr){
				foreach($arr[1] as $val){
					if(empty($val))continue;
					$str = str_replace($val , '<b>'.$val.'</b>' , $str);	
				}
			}
		}
		$pattern = "/\d{11}|\d{6}|\d{5}/";	
		$res = preg_match_all($pattern,$str,$arr);
		if($arr){
			foreach($arr[0] as $val){
				if(empty($val))continue;
				$str = str_replace($val , '<b>'.$val.'</b>' , $str);	
			}
		}
		return $str;
	}




}