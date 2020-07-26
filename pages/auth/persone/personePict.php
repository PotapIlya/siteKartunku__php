<?php
require_once '../../templates/__header.php';
?>


<section class="personePict py-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <? include '../../templates/__sidebar.php' ?>
			<div class="col-9">
				<h1 class="text-center mb-3">Картинки</h1>
				<div>

					<form id="personePict" class="d-flex justify-content-center align-items-center py-3" enctype="multipart/form-data">
<!--					<form method="POST" action="../../../modules/auth/persone/personePict.php" class="d-flex justify-content-center align-items-center py-3" enctype="multipart/form-data">-->
						<input type="file" name="image">
						<label class="d-flex flex-column text-center mr-2">
							<span>Описание</span>
							<textarea name="description" cols="30" rows="5"></textarea>
						</label>
						<button type="submit">Загрузить</button>
					</form>


					<div class="personePict__wrapper row align-items-center">

						<?
						$queryPict = $mysql->prepare("SELECT * FROM catalotpersone WHERE id_user=:id_user");
						$queryPict->execute([
							'id_user' => $_COOKIE['id'],
						]);
						$resPict = $queryPict->fetchAll(PDO::FETCH_ASSOC);


						foreach ($resPict as $value)
						{
						?>
						<div class="col-3">
							<div class="personePict__item w-100">
								<img class="w-100" src="/uploads/users/<?=$_COOKIE['id']?>/<?=$value['image']?>" alt="">
								<div data-image="<?=$value['image']?>" class="personePictDelete personePict__delete">&#10008;</div>
							</div>
						</div>
						<? } ?>
					</div>

				</div>
			</div>
        </div>
    </div>
</section>


<?php
require_once '../../templates/__footer.php';
?>
