<?php
dl('pdo_mysql.so');
echo json_encode(["ext" => get_loaded_extensions(), "pdo" => PDO::getAvailableDrivers()]);
?>
