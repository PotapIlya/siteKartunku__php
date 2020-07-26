<!DOCTYPE html>
<html lang="ru">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta charset="UTF-8">
	<title>ShapeUp</title>

	<link rel="icon" href="/buld/img/logo.png" sizes="16x16">

	<link rel="stylesheet" href="/assets/release/app/modules.css">
	<link rel="stylesheet" href="/assets/release/css/style.css">

</head>
<body>


<header class="header py-3">
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light d-flex align-items-center justify-content-between">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="logo d-flex justify-content-between align-items-center">
				<a href="/" class="d-flex align-items-center">
					<h3>logo</h3>
				</a>
			</div>
<? if (isset($_COOKIE['login'])): ?>
			<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
				<ul class="navbar-nav d-flex justify-content-around col-6 text-center">

					<li class="nav-item">
						<a class="nav-link" href="/pages/auth/persone/personeCab.php">Мой профиль</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/pages/auth/topPict.php">Топ</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Отзывы</a>
					</li>
				</ul>
			</div>
			<div>
				<a href="/modules/register/exit.php" class="button">Выйти</a>
<?php else: ?>
				<div>
					<a href="/pages/guest/login.php" class="button">Войти</a>
					<a href="/pages/guest/register.php" class="button">Зарегистрироваться</a>
				</div>
<?php endif; ?>
			</div>
		</nav>
	</div>
</header>
<main>