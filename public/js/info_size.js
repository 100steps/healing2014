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
		"font-size": bg_width * 0.04,
	});
	$("#info").css({
		"width": bg_width * 0.75,
		"height": bg_height * 0.15,
		"top": bg_height * 0.56,
		"left": bg_width * 0.2,
		"font-size": bg_width * 0.026,
	});
	$("#back").css({
		"height": bg_height * 0.05,
		"top": bg_height * 0.81
	});
	$("#vote").css({
		"height":bg_height * 0.05,
		"top": bg_height * 0.81,
		"right": "0%",
	});
	$("#song div").css({
		"height": bg_height * 0.07
	});
});