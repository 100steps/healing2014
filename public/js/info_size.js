/*设置info页面各个元素的长宽和偏移位置*/
$(function(){
	$("#photo").css({
		"width": bg_width * 0.4,
		"top": bg_height * 0.1,
		"left": bg_width * 0.3,
	});
	$("#play").css({
		"width": bg_width * 0.073,
		"top": bg_height * 0.474,
		"left": bg_width * 0.073,
	});
	$("#song").css({
		"width": bg_width * 0.7,
		"height": bg_height * 0.07,
		"top": bg_height * 0.46,
		"left": bg_width * 0.2,
	});
	$("#info").css({
		"width": bg_width * 0.7,
		"height": bg_height * 0.15,
		"top": bg_height * 0.57,
		"left": bg_width * 0.2
	});
	$("#back").css({
		"width":bg_width * 0.25,
		"top": bg_height * 0.81
	});
	$("#vote").css({
		"width":bg_width * 0.25,
		"top": bg_height * 0.81,
		"right": "0%"
	});
	$("#song div").css({
		"height": bg_height * 0.07
	});
});