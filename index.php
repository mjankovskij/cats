<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require_once __DIR__ . '/vendor/autoload.php';
date_default_timezone_set('Europe/Vilnius');
define('INSTALL_DIR', '/cats/');
define('URL', 'http://' . $_SERVER['SERVER_NAME'] . INSTALL_DIR);
define('URI', explode('/', str_replace(INSTALL_DIR, '', $_SERVER['REQUEST_URI'])));
define('DIR', __DIR__);
App::router();
?>
</body>
</html>