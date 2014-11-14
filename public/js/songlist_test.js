$(document).on("pageinit","#pageone",function(){
	// alert('页面宽度:' + document.body.clientWidth + "\n页面高度:"  + document.body.clientHeight);

	var current_page = $(".songlist").attr("currentcount");
	loadSonglistHeadimgJSON(current_page);

	var height = $('.headimglist table tr').height();

	// var div_height = $(".searchBox").height();
	// $(".searchInput").attr("line-height",div_height+'px');

	var searchMode = false;

	$("#next").on("tap",function(){
		var list_count = parseInt($(".songlist").attr("listcount"));
		var current_page = parseInt($(".songlist").attr("currentcount"));
		var result_page = Math.ceil(parseInt($(".songlist").attr("result"))/7 );
		var keyword = $("#keyword").val();

		if(searchMode){
			if(current_page<result_page){
				$(".songlist").attr("currentcount",++current_page);
				loadResult_with_keyword(keyword , current_page);
				$("#pagenum").text(current_page);
			}
		}else{
			if(current_page<list_count){
				$(".songlist").attr("currentcount",++current_page);
				loadSongImg(current_page);
				loadSonglistHeadimgJSON(current_page);
				
				$("#pagenum").text(current_page);
			}
		}
	});

	$("#prev").on("tap",function(){
		var list_count = parseInt($(".songlist").attr("listcount"));
		var current_page = parseInt($(".songlist").attr("currentcount"));
		var result_page = Math.ceil(parseInt($(".songlist").attr("result"))/7 );
		var keyword = $("#keyword").val();

		if(searchMode){
			if(current_page>1){
				$(".songlist").attr("currentcount",--current_page);
				loadResult_with_keyword(keyword , current_page);
				$("#pagenum").text(current_page);
			}
		}else{
			if(current_page>1){
				$(".songlist").attr("currentcount",--current_page);
				loadSongImg(current_page);
				loadSonglistHeadimgJSON(current_page);

				$("#pagenum").text(current_page);
			}
		}	
	});

	//随机
	$("#random").on("tap",function(){
		var max = parseInt($(".songlist").attr("listcount"))-1;
		var min = 1;
		var cnt = max-min+1;  
    	var rnd = Math.floor(Math.random() * cnt + min);

		loadSongImg(rnd);
		loadSonglistHeadimgJSON(rnd);
	});

	//搜索
	$("#submit").on("tap",function(){
		var keyword = $("#keyword").val();

		if(keyword!=''){
			searchMode = true; //开启搜索模式

			loadResult_with_keyword(keyword , 1);
		}else{
			return;
		}		
	});

	//学校选择
	$(".school").on("tap",function(){
		$(this).toggleClass("schoolselected");
	});

	//复位
	$("#reset").on("tap",function(){
		searchMode = false; //关掉搜索模式

		loadSongImg('1');
		loadSonglistHeadimgJSON('1');
		$("#keyword").val('');
		$("#pagenum").text('1');
		$("#pagetotal").text($(".songlist").attr("listcount"));
	});


	function loadSonglistHeadimgJSON(id){
		var src = 'http://wechat.100steps.net/healing2014/gen/json/' + id;
		$.getJSON(src, function(json){
			for (var i=0 ; i < 6; i++) {
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

		for (var i=0 ; i < 6; i++) { //恢复头像为默认
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



	function loadSonglistHeadimgJSON_with_keyword(keyword , id){
		var src_url = 'http://wechat.100steps.net/healing2014/gen/json/keyword/' + keyword + '/' + id;
		var target_url = addSchoolSelectQueryString(src_url);

		$.getJSON(target_url, function(json){
			for (var i=0 ; i < 6; i++) {
				if(json[i].avatar!=undefined)
					$('#head'+i).attr('src', json[i].avatar);
			};
		});

		
		var img_height = Math.round(height*0.75);
		$(".headimg").css('width', img_height+'px');
		$(".headimg").css('height', img_height+'px');
	}

	function loadSongImg_with_keyword(keyword , id){
		var src_url = 'http://wechat.100steps.net/healing2014/gen/songlist/keyword/' + keyword + '/' + id;
		var target_url = addSchoolSelectQueryString(src_url);

		//load image
		var img = new Image;
		img.src = target_url;
		img.className= 'songimg';

		for (var i=0 ; i < 6; i++) { //恢复头像为默认
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

	function loadResult_with_keyword(keyword , id){
		var src_url = 'http://wechat.100steps.net/healing2014/gen/keyword/' + keyword;
		var target_url = addSchoolSelectQueryString(src_url);
		
		$.getJSON(target_url, function(json){
			result = parseInt(json.count);
			pagetotal = Math.ceil(result/7);

			//改变页数
			$(".songlist").attr("result", result);
			

			if(result){
				$("#pagenum").text(id);
				$("#pagetotal").text(pagetotal);

				loadSongImg_with_keyword(keyword,id);
				loadSonglistHeadimgJSON_with_keyword(keyword,id);
			}else{
				searchMode = false;
				alert('找不到结果~ (暂时只支持按照歌名或者电话搜索哦)');
			}
		});
	}

	function addSchoolSelectQueryString(src_url){
		var school1 = $("#school1").hasClass("schoolselected");
		var school2 = $("#school2").hasClass("schoolselected");
		var school3 = $("#school3").hasClass("schoolselected");
		var school4 = $("#school4").hasClass("schoolselected");

		target_url = src_url + '?';

		if(!school1){
			target_url = target_url + 'school1=0&';
		}else{
			target_url = target_url + 'school1=1&';
		}

		if(!school2){
			target_url = target_url + 'school2=0&';
		}else{
			target_url = target_url + 'school2=1&';
		}

		if(!school3){
			target_url = target_url + 'school3=0&';
		}else{
			target_url = target_url + 'school3=1&';
		}

		if(!school4){
			target_url = target_url + 'school4=0&';
		}
		else{
			target_url = target_url + 'school4=1&';
		}

		return target_url;
	}

});

