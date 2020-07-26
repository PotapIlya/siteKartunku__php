<?php
require_once '../../templates/__header.php';
?>


<section class="personeCab py-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <? include '../../templates/__sidebar.php' ?>
            <div class="col-9">

                <h1 class="mb-5 text-center">Личный кабинет</h1>

				<?



					$queryRegister = $mysql->prepare("SELECT * FROM register WHERE id=:id");
                	$queryRegister->execute([
							'id' => $_COOKIE['id'],
					]);
					$resRegister = $queryRegister->fetchAll(PDO::FETCH_ASSOC);


					$queryPersone = $mysql->prepare("SELECT * FROM infopersone WHERE id_user=:id_user");
					$queryPersone->execute([
						'id_user' => $resRegister[0]['id'],
					]);
					$resPersone = $queryPersone->fetchAll(PDO::FETCH_ASSOC);
				?>

<!--				<form enctype="multipart/form-data" method="POST" action="/modules/auth/persone/personeCab.php" class="w-100 d-flex flex-column justify-content-between">-->
				<form id="personeCab" enctype="multipart/form-data" class="w-100 d-flex flex-column justify-content-between">
<!--readonly-->
					<div class="d-flex ">
						<ul class="list-inline col-5">
							<li class="d-flex justify-content-between">
								<span>Логин: </span>
								<input  name="login" placeholder="<?=$resRegister[0]['login']?>" value="<?=$resRegister[0]['login']?>" type="text">
							</li>
							<li class="d-flex justify-content-between">
								<span>Имя: </span>
								<input name="name" placeholder="<?=$resPersone[0]['name']?>" value="<?=$resPersone[0]['name']?>" type="text">
							</li>
							<li class="d-flex justify-content-between">
								<span>Фамилия: </span>
								<input name="surname" placeholder="<?=$resPersone[0]['surname']?>" value="<?=$resPersone[0]['surname']?>" type="text">
							</li>
							<li class="d-flex justify-content-between">
								<span>Email: </span>
								<input name="email" placeholder="<?=$resRegister[0]['email']?>" value="<?=$resRegister[0]['email']?>" type="text">
							</li>
							<li class="d-flex justify-content-between">
								<span>Пароль: </span>
								<input name="password" placeholder="<?=$resRegister[0]['password']?>" value="<?=$resRegister[0]['password']?>" type="text">
							</li>
							<li class="d-flex justify-content-between">
								<span>О себе:</span>
								<textarea name="text" placeholder="<?=$resPersone[0]['text']?>">
									<?=$resPersone[0]['text']?>
								</textarea>
							</li>
						</ul>
						<?
							if ($resPersone[0]['image'] === 'defauld.jpg')
							{
                                $image = '/uploads/users/defauld.jpg';
							}
							else
							{
                                $image = '/uploads/users/'.$_COOKIE['id'].'/'.$resPersone[0]['image'].'';
							}
						?>
						<div class="d-flex flex-column justify-content-center align-items-center">
							<div id="personeImage" class="col-6 mb-3">
								<img class="w-100" src="<?=$image?>" alt="">
							</div>
							<span>Фотография:</span>
							<input name="image" type="file"">
						</div>

					</div>


					<div class="ml-5">
						<button type="submit" class="mt-5">
							Сохранить
						</button>
					</div>
				</form>


            </div>
        </div>
    </div>
</section>


<?php
require_once '../../templates/__footer.php';
?>
