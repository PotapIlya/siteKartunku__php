<?php

setcookie ("login", '', time() - 50000, '/');
setcookie ("id", '', time() - 50000, '/');

header('Location: /');