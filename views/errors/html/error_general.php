<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="refresh" content="3;url=<?php echo site_url()."/".$url; ?>"/>
<meta charset="utf-8">
<title>页面提示</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin-left: -200px;
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
	width: 400px;
	position: fixed;
	top:20%;
	left: 50%;
}

p {
	margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
	<div id="container">
		<h1 style="color: red;"><?php echo $heading; ?></h1>
		<p>如果你的浏览器没有自动跳转，请<?php echo anchor($url,"点击这里此链接") ; ?></p>
	</div>
</body>
</html>