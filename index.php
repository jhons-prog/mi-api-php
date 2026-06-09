<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

$host   = getenv('MYSQLHOST') ?: getenv('MYSQL_HOST');
$dbname = getenv('MYSQLDATABASE') ?: getenv('MYSQL_DATABASE');
$user   = getenv('MYSQLUSER') ?: getenv('MYSQL_USER');
$pass   = getenv('MYSQLPASSWORD') ?: getenv('MYSQL_PASSWORD');
$port   = getenv('MYSQLPORT') ?: getenv('MYSQL_PORT') ?: 3306;

$conn = mysqli_connect($host, $user, $pass, $dbname, $port);

if (!$conn) {
    echo json_encode(["error" => mysqli_connect_error()]);
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM productos");
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);
?>
