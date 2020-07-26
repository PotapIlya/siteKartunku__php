<?php
	require_once '../../../modules/mysql.php';

	$url = $_SERVER['REQUEST_URI'];
	$url = explode('/', $url);
	$url = end($url);
	$url = explode('.', $url);

	$query = $mysql->prepare("SELECT * FROM sidebar");
	$query->execute();
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<aside class="personeSidebar col-3">
    <ul class="list-inline">
		<?
			foreach ($res as $val)
			{
		?>
			<li class="<?if($val['name'] === $url[0]) echo 'active'?>">
				<a href="/pages/auth/persone/<?=$val['name']?>.php">
					<?=$val['title']?>
				</a>
			</li>
		<? } ?>


<?//=$_COOKIE['login']?>
<?//=$_COOKIE['id']?>

    </ul>
</aside>