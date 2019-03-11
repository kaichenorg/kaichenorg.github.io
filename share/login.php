<?php
	session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$user = test_input($_POST["username"]);
		$passwd = test_input($_POST["password"]);
		if (($user == 'admin') & ($passwd == '123')) {
			// store session data
			$_SESSION['login']=1;
			header("Location: manager.php"); 
			exit;
		}
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
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
	<div class="outer" align='center'><img src="resource/footprint.png"></div>
	<div class="main">
		<div class="title" align='center'>Resource Download Manager</div><br />
		<form action='login.php' method="post">
		<table cellpadding="0" border="1" align='center'>
			<tbody>
			<tr> 
			<td>username:</td>
			<td><input type="text" name="username"></td>
			</tr>
			<tr> 
			<td>passaword:</td>
			<td><input type="password" name="password"></td>
			</tr>
			<tr> 
			<td></td>
			<td align='center'><input type="submit" value='login'> <input type="reset" value='reset'></td>
			</tr>
			</tbody>
		</table>
		</form>
	</div>
</body>
</html>
