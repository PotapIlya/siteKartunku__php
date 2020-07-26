<?php
require_once '../templates/__header.php';
?>


<section class="infoPersone py-5">
    <div class="container">
        <?
            require_once '../../modules/mysql.php';

            $url = $_SERVER['REQUEST_URI'];
            $url = explode('?', $url);
            $queryInfo = $mysql->prepare("SELECT * FROM infopersone WHERE id_user=:id_user");
            $queryInfo->execute([
                'id_user' => $url[1],
            ]);
            $resInfo = $queryInfo->fetchAll(PDO::FETCH_ASSOC);



			$queryPict = $mysql->prepare("SELECT * FROM catalotpersone WHERE id_user=:id_user");
			$queryPict->execute([
				'id_user' => $url[1],
			]);
			$resPict = $queryPict->fetchAll(PDO::FETCH_ASSOC);


			$queryLikes = $mysql->prepare("SELECT is_post FROM likes WHERE is_user=:is_user");
        	$queryLikes->execute([
				'is_user' => $resInfo[0]['id_user'],
			]);
			$resLikes = $queryLikes->fetchAll(PDO::FETCH_ASSOC);
        ?>
       <div>
           <div class="d-flex flex-column col-10 m0-auto">
               <h2 class="text-center py-5">
                   Профиль
               </h2>
               <div class="d-flex justify-content-between">
                   <ul class="list-inline">
                       <li>
                           <b>Имя :</b> :  <?=$resInfo[0]['name']?>
                       </li>
                       <li>
                           <b>Фамилия</b> : <?=$resInfo[0]['surname']?>
                       </li>
                       <li>
                           <b>О нем</b> : <?=$resInfo[0]['text']?>
                       </li>
                   </ul>
                   <div class="col-4">
                       <img class="mw-100" src="/uploads/users/<?=$url[1]?>/<?=$resInfo[0]['image']?>" alt="">
					   <strong>
						   Всего: <?=count($resLikes)?> лайков
					   </strong>
                   </div>
               </div>
           </div>
           <div>
               <h2 class="text-center py-5">
                   Работы
               </h2>
               <div class="align-items-center row">
                   <?
                   foreach ($resPict as $val)
                   {
                   ?>
                   <div class="col-3">
                       <img class="mw-100" src="/uploads/users/<?=$url[1]?>/<?=$val['image']?>" alt="">
                   </div>
                   <? } ?>
               </div>
           </div>
       </div>
    </div>
</section>


<?php
require_once '../templates/__footer.php';
?>
