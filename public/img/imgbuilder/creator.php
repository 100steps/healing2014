<?php
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

$bg = imagecreatefrompng('bg.png');
list($bg_w, $bg_h, $head_attr) = getimagesize("bg.png");
$foot = imagecreatefrompng('foot.png');
list($foot_w, $foot_h, $foot_attr) = getimagesize('footer.png');

$test = imagecreate(640, 248);
imagecolorallocate($test, 0, 0, 0);
$text_color = imagecolorallocate($bg, 0xFF, 0xFF, 0xFF);

$head_offset = 50;

$left_offset = 100;

$font_size = 18;

$song = 20;

$line_w = 640;

$line_h = 47;

$font = './wqy-zenhei.ttc';

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


