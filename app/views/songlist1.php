<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>BBT治愈系</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<link href="/css/songlist.css" rel="stylesheet" />
		<style type="text/css">
			body {padding-top: 15px;padding-bottom: 40px;}
			.pageSelect {margin:-2;width:70px;height:29px;background:#EEEEEE;}
		</style>
		<script>
			function changePage(){
				var val = document.getElementById("pages").value;window.location.href=("?page="+val);
			}
		</script>
	</head>
	<body>
		<div>
			<table class="table table-striped">
				<thead>
				<tr>
				<th></th>
				<th></th>
				</tr>
				</thead>
				<tbody>
<?php 
	foreach ($songlist as $key => $row) {
?>
					<tr>
					<td><img src="<?php echo $row->avatar;?>" width='50' height='50'></td>
					<td>
<?php 
	if($row->gender=='m')
		echo '<span style="color:#3071A9">'; 
	else 
		echo '<span style="color:#FF5151">'; 
	if($row->type!='微信')echo '@'; 
		echo $row->name.'</span> : '.$row->song.('['.$row->tel.']').'   ('.$row->created_at." From ".$row->type.")";
?>
					</td>
					</tr>
<?php 
	}
?>
				</tbody>
			</table>
		</div>

		<div class="footer container  well-small muted">
			<small style="text-align:center">
				<div class="span6 offset3">
					<p>
					百步梯治愈系，创新只为与你分享。<br/>
					<img src="http://wechat.100steps.net/favicon.ico" alt="logo" />Copyright© 2014
					</p>
				</div>
			</small>
		</div>
	</body>
</html>