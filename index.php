<?php
echo json_encode(["ext" => get_loaded_extensions(), "pdo" => PDO::getAvailableDrivers()]);
?>
