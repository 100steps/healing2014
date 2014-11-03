$(document).ready(function(){
	$("tbody>tr:even").removeClass();
	//$("tbody>tr:even").addClass();
	
	$("tbody>tr>td").click(function(){
		var value = $(this).html(); //原始值
		if($(this).find('input').length>0)return;
		var column = $(this).attr("col"); //栏目
		if(!column)return;
		var rowid =  $(this).parents().attr("id"); //行id
		$(this).html("<input id='edit"+rowid+column+"' value='"+value+"'> ");
		$("#edit"+rowid+column).focus();
		$("#edit"+rowid+column).blur(function(){
			var editval = $(this).val();
			if(!editval)editval=null;
			$(this).parents("td").html(editval);
			$(this).parents("td").attr("flag", 0); 
			$.post("./edit",{id:rowid,col:column,val:editval,"type":'update'});
		})
	});
	
	$("tbody>tr>td").mouseover(function(){
		var column = $(this).attr("col"); //栏目
		if(!column)return;
		$(this).css("cursor","pointer");
	});
	
	$("#addbutton").click(function(){
		$.dialog({
			id: 'add',
			content: '<input id="addtel"  class="form-control" name="addtel" type="text" value="" placeholder="电话"  /><br />'
				+ '<input id="addsong"  class="form-control" name="addsong" type="text" value="" placeholder="歌曲"  />',
			fixed: true,
			ok: function () {
				var addtel=document.getElementById('addtel')
				var addsong = document.getElementById('addsong');
			   // pw.select();
				
				$.ajax({
					type: "post",
					url:  "./edit",
					data: {
						"tel":addtel.value,
						"song":addsong.value,
						"currentTime":getNowFormatDate(),
						"type":'insert'
					},
					beforeSend: function() { },
					complete: function() { },
					error: function() {
						$.dialog({
							content: 'POST请求失败!',
							button: [
								{value: '返回',
									callback: function () {return;}
								}
							]
						}); 
					},
					success: function(msg) {
					if(msg=='success')
						$.dialog({
							content: 'POST请求成功',
							button: [
								{value: '确定',
									callback: function () {window.location.reload();}
								}
							]
						});
					else 
						$.dialog({
							content: 'failed to insert!',
							button: [{value: '关闭'}]
							});
						}
				 })
				//pw.focus();
				return false;
			},
			okValue: '提交',
			cancelValue: '取消',
			cancel: function () {}
		});
	});
	
	$("#removebutton").click(function(){
		$.dialog({
			content: '确认要删除所选内容吗?',
			okValue: '确认',
			ok: function () {
				$(document).find("input:checked").each(function() {
					var rowid = ($(this).parents("tr").attr("id"));
					$.post("./edit",{id:rowid,type:'remove'});
				});
				$.dialog({
					content: '删除完成',
					ok: function () {
						window.location.reload();
					}
				});
			},
			cancelValue: '取消',
			cancel: function () {
				return;
			}
		});
	});
	
	$("#sortbutton").click(function(){
		$.dialog({
			content: '默认就是按时间排序的...',
			okValue: '确认',
			ok: function () {
			}
		});
	});
	
	$("#exportToXLSX").click(function(){
		window.location.href="./export";
	});
	
	$("#updateButton").click(function(){
		
	});
});

function getNowFormatDate() {
    var date = new Date();
    var seperator1 = "-";
    var seperator2 = ":";
    var month = date.getMonth() + 1;
    var strDate = date.getDate();
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
            + " " + date.getHours() + seperator2 + date.getMinutes()
            + seperator2 + date.getSeconds();
    return currentdate;
}
