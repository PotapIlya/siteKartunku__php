<?php
require_once '../templates/__header.php';
include '../templates/__openTopPage.php';
?>


<section class="topPersone">
	<div class="container">
		<h1 class="text-center mb-5">
			Top Persone
		</h1>
		<div class="row align-items-center">


            <?
			require_once '../../modules/mysql.php';

            $queryPict = $mysql->prepare("SELECT * FROM catalotpersone");
            $queryPict->execute();
            $resPict = $queryPict->fetchAll(PDO::FETCH_ASSOC);

			foreach ($resPict as $value)
			{
            ?>
			<div class="topPersone__box col-3">
				<div class="topPersone__item w-100">
					<img data-image="<?=$value['image']?>" class="openModal mw-100" src="/uploads/users/<?=$value['id_user']?>/<?=$value['image']?>" alt="">
					<div class="topPersone__like" data-id="<?=$value['id']?>">
						<?
                        $queryLike = $mysql->prepare("SELECT is_user FROM likes WHERE is_post=:is_post");
                        $queryLike->execute([
                        		'is_post' => $value['id'],
						]);
                        $resLike = $queryLike->fetchAll(PDO::FETCH_ASSOC);
						?>
						<span class="countLike"><?=count($resLike)?></span>
						<div>&#10084;</div>
					</div>
				</div>
			</div>
			<? } ?>

		</div>
	</div>
</section>


<?php
require_once '../templates/__footer.php';
?>
