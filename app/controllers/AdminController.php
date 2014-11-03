<?php

class AdminController extends BaseController {

	public function edit(){
		return View::make('edit');
	}

	public function build(){
		return View::make('build');
	}

	public function create(){

		if(isset($_POST['area'])){
			$data = trim($_POST['area']);
			$arr = explode("\r",$data);
			//print_r($arr);exit;
		}else{
			exit;
		}
		//ini_set("display_errors",1);
		header("Content-type: image/x-png");
		header("Content-Disposition: attachment; filename=治愈系".time().".png");

		$bg = imagecreatefrompng('/webroot/healing2014/app/imgbuilder/bg.png');
		list($bg_w, $bg_h, $head_attr) = getimagesize("/webroot/healing2014/app/imgbuilder/bg.png");

		$foot = imagecreatefrompng('/webroot/healing2014/app/imgbuilder/foot.png');
		list($foot_w, $foot_h, $foot_attr) = getimagesize('/webroot/healing2014/app/imgbuilder/foot.png');

		$test = imagecreate(640, 248);
		imagecolorallocate($test, 0, 0, 0);
		$text_color = imagecolorallocate($bg, 0xFF, 0xFF, 0xFF);

		$head_offset = 50;

		$left_offset = 100;

		$font_size = 18;

		$song = 20;

		$line_w = 640;

		$line_h = 47;

		$font = '/webroot/healing2014/app/imgbuilder/wqy-zenhei.ttc';

		imagettftext($bg, 30 , 0, 220, 50, $text_color, $font , '治愈系歌单');

		foreach($arr as $key=>$value){
			if(!strstr($value,'	'))$value = preg_replace ('/ /',"               ",$value,1);
			$value = preg_replace ('/	/',"               ",$value,1);
			$y = $head_offset+($key+1)*$line_h;
			imagettftext($bg,$font_size, 0, $left_offset, $y, $text_color, $font , trim($value));
		}

		$test = imagecreate(640, 248);
		imagecolorallocate($test, 0, 0, 0);

		imagecopy($bg, $foot, 0,$head_offset+$song*($line_h+2)-10, 0, 0, 640, 248);

		imagepng($bg);
		imagedestroy($bg);

		exit;
	}


	public function export(){
		date_default_timezone_set('Asia/Shanghai');

		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');

		/** Include PHPExcel */
		require_once '/webroot/healing2014/app/PHPExcel.php';


		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Zhang Junda")
									 ->setLastModifiedBy("Zhang Junda")
									 ->setTitle("BBT") //标题
									 ->setSubject("BBT") //主题
									 ->setDescription("BBT")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Test result file");

		$db = new PDO('mysql:host=localhost;dbname=wechat', 'wechat', 'wechat@)!#');
		$db->query("SET NAMES utf8");

		$arr = array ( 0=>"微博转发" , 1=>"微博评论" , 2=>"微信" , 3=>"手工添加" , 4=>NULL);
		$objPHPExcel->createSheet();
		$objPHPExcel->createSheet(); 
		$objPHPExcel->createSheet(); 
		$objPHPExcel->createSheet(); 
		foreach($arr as $key => $val){
			
			@$objPHPExcel->setActiveSheetIndex($key++)
		            ->setCellValue('A1', '昵称')
		            ->setCellValue('B1', $val.'内容')
		            ->setCellValue('C1', '电话')
		            ->setCellValue('D1', '歌曲')
					->setCellValue('E1', '时间');
			
			if(!empty($val))
				$res = $db->query("SELECT * FROM healing WHERE type = '$val' AND tel!='' ORDER BY `created_at` DESC " );
			else
				$res = $db->query("SELECT * FROM healing WHERE tel!='' ORDER BY `created_at` DESC " );
			$count=2;
			
			while($row = $res->fetch()){
				// Add some data
				@$objPHPExcel->getActiveSheet()
							->setCellValue('A'.$count, '@'.$row['name'])
							->setCellValue('B'.$count, $row['text'])
							->setCellValue('C'.$count, $row['tel'])
							->setCellValue('D'.$count, $row['song'])
							->setCellValue('E'.$count, $row['created_at']);
							
				$rowHeight  = 18;
				if(mb_strlen($row['text'])>200){
					$rowHeight = 65;	
				}elseif(mb_strlen($row['text'])>100){
					$rowHeight = 35;
				}
				$objPHPExcel->getActiveSheet()->getRowDimension($count++)->setRowHeight($rowHeight); 
						
			}
			
			$res = NULL;
			
			//设置居中
			$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			 
			// Set column widths ,像素 = val * 7
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(26);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(80);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(19);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(19);
			
			//$objPHPExcel->getActiveSheet()->getColumnDimension('B')-> setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getStyle('B1:B'.$count)->getAlignment()->setWrapText(true);
			
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('From'.$val);
			
			
		}
		$db = NULL;
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Healing.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');


		exit;

	}

	public function update(){
		if(!empty($_POST['id'])&& $_POST['type']=='update'){
			if(!is_numeric($_POST['id']))exit;
			$db    = new PDO('mysql:host=localhost;dbname=wechat', 'wechat', 'wechat@)!#');
			$db->query("SET NAMES utf8");
			$table = 'healing';
			$id    =$_POST['id'];
			$col   =$_POST['col'];
			$val   =trim($_POST['val']);
			$sql   = "update `$table` set `$col`='$val' where `id`='$id'";
			$db->exec($sql) or die('failed : '.$sql);
			$db    = NULL;
		}
		if(!empty($_POST['type'])&& $_POST['type']=='insert'){
			$db          = new PDO('mysql:host=localhost;dbname=wechat', 'wechat', 'wechat@)!#');
			$db->query("SET NAMES utf8");
			$table       = 'healing';
			$tel         =addslashes($_POST['tel']);
			$song        =addslashes($_POST['song']);
			$currentTime =addslashes($_POST['currentTime']);
			$sql         = "insert into `$table` set `tel`='$tel' , `song`='$song' , `text`='手工添加' ,`type`='手工添加' , `created_at`='$currentTime' ";
			$db->exec($sql) or die('failed : '.$sql);
			$db          = NULL;
			echo 'success';
		}
		if(!empty($_POST['type'])&& $_POST['type']=='remove'){
			$id    =trim($_POST['id']);
			if(!is_numeric($id))exit;
			$db    = new PDO('mysql:host=localhost;dbname=wechat', 'wechat', 'wechat@)!#');
			$db->query("SET NAMES utf8");
			$table = 'healing';
			$sql   = "delete from `$table` where `id`='$id'";
			$db->exec($sql) or die('failed : '.$sql);
			$db    = NULL;
			echo 'success';
		}
	}

}