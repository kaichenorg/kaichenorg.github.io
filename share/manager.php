<?php
	session_start();
	if (!isset($_SESSION['login']) or ($_SESSION['login']!=1) ) 
	{		
		header("Location: login.php"); 
		exit;
	}	
	
	/**********************
	一个简单的目录递归函数
	第一种实现办法：用dir返回对象
	***********************/
	function get_allfiles($parentpath, $directory) 
	{ 
		$result = array();
		$mydir = dir($directory); 
		while($file = $mydir->read())
		{ 
			if (($file==".") OR ($file==".."))
			{
				continue;
			}
			else if(is_dir("{$directory}/{$file}"))
			{
				$result = array_merge($result, get_allfiles("{$parentpath}{$file}/", "{$directory}/{$file}")); 
			} 
			else 
			{
				array_push($result, $parentpath . $file); 
			}
		}
		$mydir->close(); 
		return $result;
	} 
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=windows-1252">
	<title>Following Devil's Footprints</title>
	<!--load web font from Google-->
	<link href="resource/css.css" rel="stylesheet" type="text/css">
	<link href="resource/main.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="outer" align='right'><a href='logout.php'>logout</a></div>
	<div class="outer" align='center'><img src="resource/footprint.png"></div>
	<div class="main" align='center'>
		<div class="title" align='center'>Resource Download Manager</div><br />
		<table cellpadding="0" border="1" align='center'>
			<tbody>
			<?php
				$allfiles = get_allfiles('','downloadfiles');
				foreach ($allfiles as $file) 
				{
					print "<tr><td> {$file} </td><td> " . filesize('downloadfiles/' . $file) . " Bytes </td><td> <a href='create.php?filename={$file}' target='_blank'>generate link</a> </td></tr>";
				}
			?>
			</tbody>
		</table>
	</div>
</body>
</html>
