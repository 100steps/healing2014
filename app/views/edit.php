<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>治愈系后台</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="./index.ico" >
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/idialog.css" rel="stylesheet">
        <style type="text/css">
			body {
				padding-top: 15px;
				padding-bottom: 40px;
			}
        </style>
    </head>
    <body>
    <div>
    	<button type="button" class="btn btn-success" id="addbutton">手工添加记录</button>
        <button type="button" class="btn btn-danger"  id="removebutton">删除记录</button>
        <button type="button" class="btn btn-primary" id="exportToXLSX">导出Excel表格</button>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>头像</th>
            <th>内容</th>
            <th>电话</th>
            <th>歌曲</th>
          </tr>
        </thead>
        <tbody>
    <?php
		//ini_set('display_errors',1);
		(!isset($_GET['page']) || !preg_match("/^\d+$/",$_GET['page']) )? $page=0 : $page=$_GET['page'];
		$db = new PDO('mysql:host=localhost;dbname=wechat', 'wechat', 'wechat@)!#');
		$db->query("SET NAMES utf8");
		$res = $db->query("SELECT COUNT( * ) from healing where tel!=''");
		$row = $res->fetch();
		$count = $row[0]; //总结果数
		echo '共'.$count.'条记录';
		$pagecnt = ceil($count/15);
		$res = $db->query("SELECT * FROM healing where tel!='' ORDER BY `created_at` DESC limit ".($page*15).',15 ' );
		
		while($row = $res->fetch()){
			//if(empty($row[text]))continue;
			
		
	?> 
          <tr class="active" id="<?php echo $row['id'];?>">
            <td><input type="checkbox"> </td>
            <td><a target="_blank" href="<?php if($row['uid']!=''){echo 'http://weibo.com/u/'.$row['uid'];} else echo '#';?>"><img src="<?php echo $row['avatar'];?>"></a></td>
            <td><a target="_blank" href="<?php if($row['uid']!=''){echo 'http://weibo.com/u/'.$row['uid'];} else echo '#';?>"><?php if($row['gender']=='m')echo '<span style="color:#3071A9">'; else echo '<span style="color:#FF5151">'; echo '@'.$row['name'].'</span></a> : '.telHighlight($row['text']).'  ('.$row['created_at']." From $row[type] )";?></td>
            <td col="tel" width="10%"><?php echo $row['tel']; ?></td>
            <td col="song"  width="15%"><?php echo $row['song']; ?></td>
          </tr>
	<?php
		}
	?>
        </tbody>
      </table>
    </div><!-- /example -->
    
    <div align="center">
        <ul class="pagination">
          <li <?php if(!$page)echo 'class="disabled"';?>><a <?php if($page)echo 'href="?page=0"';?>>&laquo;</a></li>
        <?php
            ($pagecnt-$page<5)?$page1=$pagecnt-5:$page1=$page-2;
            ($page1<0)?$page1=0: (1);
            $i=1;
            do{
                echo '<li';
                if($page1==$page)echo ' class="active" ';
                echo '><a ';
				if($page1!=$page)echo 'href="?page='.$page1.'"';
				echo '>'.++$page1.'</a></li>';
            }while($i++<5);
        ?>
          <li <?php if($pagecnt-$page<5)echo 'class="disabled"';?>><a <?php if($pagecnt-$page>=5)echo 'href="?page='.($pagecnt-1).'"';?>>&raquo;</a></li>
        </ul>
        
    </div>
    
    
    
    
    <script src="http://wechat.100steps.net/js/admin/jquery-1.10.2.min.js"></script>
    <script src="http://wechat.100steps.net/js/admin/jquery.artDialog.min.js"></script>
    <script src="http://wechat.100steps.net/js/admin/edit.js"></script>
    </body>
</html>

<?php
	
	function telHighlight($str){
		$str = htmlspecialchars($str);
		$patterns[0] = "/\&lt\;(.*)\&gt\;/U";
		$patterns[1] = "/《(.*)》/U";
		$patterns[2] = "/＜(.*)＞/U";
		$patterns[3] = '/\&quot;(.*)\&quot\;/U';
		$patterns[4] = '/“(.*)”/U';
		$patterns[5] = '/≪(.*)≫/U';
		$patterns[6] = '/〈(.*)〉/U';
		foreach ($patterns as $pattern){
			$res = preg_match_all($pattern,$str,$arr);
			if($arr){
				foreach($arr[1] as $val){
					if(empty($val))continue;
					$str = str_replace($val , '<b>'.$val.'</b>' , $str);	
				}
			}
		}
		$pattern = "/\d{11}|\d{6}|\d{5}/";	
		$res = preg_match_all($pattern,$str,$arr);
		if($arr){
			foreach($arr[0] as $val){
				if(empty($val))continue;
				$str = str_replace($val , '<b>'.$val.'</b>' , $str);	
			}
		}
		return $str;
	}
?>