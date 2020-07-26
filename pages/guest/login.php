<?php
require_once '../templates/__header.php';
?>

<section class="py-5">
    <div class="container">
        <h2 class="text-center pb-5">Вход</h2>
<!--        <form class=" d-flex flex-column col-4 m0-auto" method="POST" action="../../modules/register/login.php">-->
        <form id="login" class="d-flex flex-column col-4 m0-auto">

            <input name="login" placeholder="Login" type="text">
            <input name="password" placeholder="Пароль" type="text">
            <div class="m0-auto">
                <button type="submit">
                    Отправить
                </button>
            </div>
        </form>
    </div>
</section>






<?php
require_once '../templates/__footer.php';
?>
