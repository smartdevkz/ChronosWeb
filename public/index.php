<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new \App\App;

require __DIR__ . '/../app/config/routes.php';

$app->run();
