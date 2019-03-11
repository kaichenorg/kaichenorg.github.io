<?php
	session_start();
	if (!isset($_SESSION['login']) or ($_SESSION['login']!=1) ) 
	{		
		header("Location: login.php"); 
		exit;
	}	
	
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$filename = test_input($_GET["filename"]);
		$rand_str = generate_string(6);
		while(is_file('randomfiles/' . $rand_str))
		{
			$rand_str = generate_string(6);
		}
		$myfile = fopen('randomfiles/' . $rand_str, "w") or die("Unable to open file!");
		if ($myfile)
		{
			fwrite($myfile, 'downloadfiles/' . $filename);
			fclose($myfile);
			$_SESSION['downloadurl'] = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"]. '/share/download.php?key=' . $rand_str;
		}
	}
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	function generate_string( $length = 8 ) {  
		// 字符集，可任意添加你需要的字符  
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!';  
		$charslen = strlen($chars);
		$rand_str = '';  
		for ( $i = 0; $i < $length; $i++ )  
		{  
			$rand_str .= $chars[ mt_rand(0, $charslen - 1) ];  
		}  
		return $rand_str;  
	} 
	
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=windows-1252">
	<title>Following Devil's Footprints</title>
	<!--load web font from Google-->
	<link href="resource/css.css" rel="stylesheet" type="text/css">
	<link href="resource/main.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="resource/ZeroClipboard.min.js" ></script>
</head>

<body>
	<div class="outer" align='center'><img src="resource/footprint.png"></div>
	<div class="main" align='center'>
		<div class="title" align='center'>Resource Download Manager</div><br />
		<table cellpadding="0" border="1" align='center'>
			<tbody>
			<?php
				print "<tr><td><a href='{$_SESSION['downloadurl']}' target='_blank'>{$_SESSION['downloadurl']}</a></td><td><button id='copy_button' data-clipboard-text='{$_SESSION['downloadurl']}'>copy</button></td></tr>";
			?>
			</tbody>
		</table>
	</div>

	<script type="text/javascript">
		if(window.clipboardData){
			//for IE
			var copyBtn = document.getElementById("copy_button");
			copyBtn.onclick = function(){ 
				var text = this.getAttribute("data-clipboard-text");
				window.clipboardData.setData('text',text); 
				alert("复制成功，地址为： \n" + text);
			} 
		}else{
			var client = new ZeroClipboard(document.getElementById("copy_button"));
			client.on("ready", function(readyEvent) {
				client.on("aftercopy", function(event) {
					alert("复制成功，地址为： \n" + event.data["text/plain"]);
				});
			});
		}
	</script>
</body>
</html>
