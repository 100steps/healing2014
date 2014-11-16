var bg_width;		//页面宽度
var bg_height;	//页面高度
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
