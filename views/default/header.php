<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> trlogic </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src='/js/main.js'></script>
	<link rel="stylesheet" href="/css/main.css">
</head>
<body>
	<div class="row header">
		<a href="/" class='home ml-5 mt-2'> <?=HOME?> </a>
		<div class="lang_block">
			<span> <?=LANG?> </span>
			<a href='#' onclick="setLang('<?=$_SESSION['lang']?>');"> <?=$_SESSION['lang']?> </a>
		</div>
		<?php if (isset($_SESSION['userData'])): ?>
			<div class="logout_block">
				<a href='#' onclick="logout();"> <?=LOGOUT?> </a>			
			</div>
		<?php endif; ?>	
	</div>

