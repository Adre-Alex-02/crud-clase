<?php
include 'conexion.php';

//procesar el formulario cuando se envia
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    //insertar nuevo producto
    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock) VALUES (?,?,?,?)";
    $res = $conn-> prepare($sql);
    $res->execute([$nombre,$descripcion,$precio,$stock]);

    header ("Location: index.php?success=Producto creado correctamente");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
</head>
<body>
    <h1>Agregar Nuevo Producto</h1>
    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion"></textarea>
        <br>
        <label for="precio">Precio:</label>
        <input type="numbre" step="0.01" name="precio" required>
        <br>
        <label for="stock">Stock:</label>
        <input type="number" name="stock" required>
        <br>
        <input type="submit" value="Guardar Producto">
        <a href="index.php">Cancelar</a>
    </form>
    
</body>
</html>