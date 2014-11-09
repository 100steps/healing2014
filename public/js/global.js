var bg_width;		//屏幕宽度
var bg_height;	//屏幕高度
$(function(){
	bg_width = $(window).width();
//	alert(bg_width);
	bg_height = bg_width / 640 * 960;
	if ($(window).height() > bg_height)
		bg_height = $(window).height();
	$("#bg").css({
		"width": bg_width,
		"height": bg_height,
	});
});
