<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

$host   = getenv('MYSQLHOST');
$dbname = getenv('MYSQLDATABASE');
$user   = getenv('MYSQLUSER');
$pass   = getenv('MYSQLPASSWORD');
$port   = getenv('MYSQLPORT') ?: 3306;

$conn = mysqli_connect($host, $user, $pass, $dbname, (int)$port);

if (!$conn) {
    echo json_encode(["error" => mysqli_connect_error()]);
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM productos");

if (!$result) {
    echo json_encode(["error" => mysqli_error($conn)]);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);
?>
