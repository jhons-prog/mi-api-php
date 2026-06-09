<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$host   = "mysql.railway.internal";
$dbname = "railway";
$user   = "root";
$pass   = "JgTKMgtAGsGaNDaLJpIeAPIqMJtnmJpI";
$port   = 3306;

$conn = mysqli_connect($host, $user, $pass, $dbname, $port);

if (!$conn) {
    echo json_encode(["error" => mysqli_connect_error()]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$input  = json_decode(file_get_contents("php://input"), true);

// GET - listar todos
if ($method === 'GET') {
    $result = mysqli_query($conn, "SELECT * FROM productos");
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

// POST - agregar
elseif ($method === 'POST') {
    $nombre      = mysqli_real_escape_string($conn, $input['nombre']);
    $precio      = mysqli_real_escape_string($conn, $input['precio']);
    $descripcion = mysqli_real_escape_string($conn, $input['descripcion']);
    $sql = "INSERT INTO productos (nombre, precio, descripcion) VALUES ('$nombre', '$precio', '$descripcion')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true, "id" => mysqli_insert_id($conn)]);
    } else {
        echo json_encode(["error" => mysqli_error($conn)]);
    }
}

// PUT - editar
elseif ($method === 'PUT') {
    $id          = (int)$input['id'];
    $nombre      = mysqli_real_escape_string($conn, $input['nombre']);
    $precio      = mysqli_real_escape_string($conn, $input['precio']);
    $descripcion = mysqli_real_escape_string($conn, $input['descripcion']);
    $sql = "UPDATE productos SET nombre='$nombre', precio='$precio', descripcion='$descripcion' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => mysqli_error($conn)]);
    }
}

// DELETE - eliminar
elseif ($method === 'DELETE') {
    $id  = (int)$input['id'];
    $sql = "DELETE FROM productos WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => mysqli_error($conn)]);
    }
}

mysqli_close($conn);
?>
