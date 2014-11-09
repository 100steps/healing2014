$(document).on("pageinit","#pageone",function(){
	// alert('页面宽度:' + document.body.clientWidth + "\n页面高度:"  + document.body.clientHeight);

	var current_page = $(".songlist").attr("currentcount");
	loadSonglistHeadimgJSON(current_page);

	$("#next").on("tap",function(){
		var list_count = parseInt($(".songlist").attr("listcount"));
		var current_page = parseInt($(".songlist").attr("currentcount"));

		if(current_page<list_count){
			$(".songlist").attr("currentcount",++current_page);
			loadSongImg(current_page);
			loadSonglistHeadimgJSON(current_page);
			
			$("#pagenum").text(current_page);
		}
	});

	$("#prev").on("tap",function(){
		var list_count = parseInt($(".songlist").attr("listcount"));
		var current_page = parseInt($(".songlist").attr("currentcount"));
		
		if(current_page>1){
			$(".songlist").attr("currentcount",--current_page);
			loadSongImg(current_page);
			loadSonglistHeadimgJSON(current_page);

			$("#pagenum").text(current_page);
		}
	});

	$("#random").on("tap",function(){
		var max = parseInt($(".songlist").attr("listcount"))-1;
		var min = 1;
		var cnt = max-min+1;  
    	var rnd = Math.floor(Math.random() * cnt + min);

		loadSongImg(rnd);
		loadSonglistHeadimgJSON(rnd);
	});


	function loadSonglistHeadimgJSON(id){
		var src = 'http://wechat.100steps.net/healing2014/gen/json/' + id;
		$.getJSON(src, function(json){
			for (var i=0 ; i < 7; i++) {
				if(json[i].avatar!=undefined)
					$('#head'+i).attr('src', json[i].avatar);
			};
		});

		var height = $('.headimglist table tr').height();
		var img_height = Math.round(height*0.75);
		$(".headimg").css('width', img_height+'px');
		$(".headimg").css('height', img_height+'px');
	}

	function loadSongImg(id){
		//load image
		var img = new Image;
		img.src = 'http://wechat.100steps.net/healing2014/gen/songlist/' + id;
		img.className= 'songimg';

		for (var i=0 ; i < 7; i++) { //恢复头像为默认
			$('#head'+i).attr('src', "/img/headImg.png");
		};

		$('.songlist').html('<img src="/img/loading0.gif" class="loadingImg"/>');

		img.onload = function(){
			// 需要执行的程序
			$('.songlist').html(''); 
			document.getElementById('songlist').appendChild(img);

			// 该死的IE
			$(".songimg").height('100%');
			$(".songimg").width("auto");
		}
	}
});

