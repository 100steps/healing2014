<?php

class SonglistController extends BaseController {

	public function showSonglist(){		
		$song_count = DB::table('songlist')->where('song', '!=', '')->count();
		$list_count = ceil($song_count/7);
		return View::make('songlist')->with('list_count',$list_count);
	}

	public function showSonglist_test(){		
		$song_count = DB::table('songlist')->where('song', '!=', '')->count();
		$list_count = ceil($song_count/7);
		return View::make('songlist_test')->with('list_count',$list_count);
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


	public function createSonglistPNG_v2($pageId){
		// load data
		$songlist = $this->getSonglist( ($pageId-1)*7 , 7 );

		// config
		$font_file            = '/webroot/healing2014/app/imgbuilder/msyh.ttc';
		$emoji_file           = '/webroot/healing2014/app/imgbuilder/seguiemj.ttf';
		$font_size            = 17;
		$font_size_id         = 20;
		$font_size_school     = 14;
		$font_size_emoji      = 28;
		$font_angle           = 0;
		$font_song_leftborder = 125;
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
	
		for ($i=0; $i<7 ; $i++) {
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

			//draw head image
			//bool imagecopy ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h )
			// imagecopy($background, $headImg, 30, 12+$line_height*$i , 0, 0, 80, 80);

			// break;
		}

		// for ($i=0; $i<7 ; $i++) {
		// 	imagefilledrectangle ($background , 0 , 0 , 500 , 105*1 , $background_color1 );
		// 	imagefilledrectangle ($background , 0 , 105*1 , 500 , 105*2 , $background_color2 );
		// 	imagefilledrectangle ($background , 0 , 105*2 , 500 , 105*3 , $background_color1 );
		// 	imagefilledrectangle ($background , 0 , 105*3 , 500 , 105*4 , $background_color2 );
		// 	imagefilledrectangle ($background , 0 , 105*4 , 500 , 105*5 , $background_color1 );
		// 	imagefilledrectangle ($background , 0 , 105*5 , 500 , 105*6 , $background_color2 );
		// 	imagefilledrectangle ($background , 0 , 105*6 , 500 , 735 , $background_color1 );
		// }

		// Output and free from memory
		header("Content-type: image/x-png");
		// header("Content-Disposition: attachment; filename=治愈系".time().".png");
		
		imagepng($background);
		imagedestroy($background);

		exit;
	}


	public function getSongJSON($pageId){ //pageId starts from 1
		$songlist = $this->getSonglist(($pageId-1)*7);
		header('Content-type: application/json;charset=utf-8');
		echo json_encode($songlist,JSON_UNESCAPED_UNICODE);
		exit();
	}

	public function getFavouriteSongJSON(){
		$favourite = DB::table('songlist')->groupBy('status')->orderBy('name', 'desc');
		header('Content-type: application/json;charset=utf-8');
		echo json_encode($favourite,JSON_UNESCAPED_UNICODE);
		exit();
	}

	private function getSonglist( $start = 0 ,$count = 7 ){
		return DB::table('songlist')->skip($start)->take($count)->where('song', '!=', '')->orderBy('created_at', 'desc')->get();
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