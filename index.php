<?php
echo json_encode([
    "mysqli" => extension_loaded('mysqli'),
    "pdo_mysql" => extension_loaded('pdo_mysql'),
    "host" => getenv('mysql.railway.internal'),
    "port" => getenv('3306'),
    "db" => getenv('railway'),
    "user" => getenv('root')
]);
?>
