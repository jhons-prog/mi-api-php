<?php
echo json_encode([
    "mysqli" => extension_loaded('mysqli'),
    "pdo_mysql" => extension_loaded('pdo_mysql'),
    "host" => getenv('MYSQLHOST'),
    "port" => getenv('MYSQLPORT'),
    "db" => getenv('MYSQLDATABASE'),
    "user" => getenv('MYSQLUSER')
]);
?>
