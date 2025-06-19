<?php
include 'conexion.php';

//procesar la actualizacion cuando se envia el formulario 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    //acrualizar producto
    $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ? WHERE id = ?";
    $res = $conn->prepare($sql);
    $res->execute([$nombre, $descripcion, $precio, $stock, $id]);
    header("Location: index.php?success=Producto actualizado correctamente");
    exit();
}
$id = $_GET['id'];
$sql = "SELECT * FROM productos WHERE id = ?";
$res = $conn->prepare($sql);
$res->execute([$id]);
$producto = $res->fetch(PDO::FETCH_ASSOC);

if (!$producto){
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Editar producto</title>
</head>
<body>
    <form method="post">
        <input type="hidder" name="id" value="<?=$producto['id']?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?=htmlspecialchars ($producto['nombre'])?>" required>
        <br>
        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion" ><?=htmlspecialchars($producto['descripcion']) ?></textarea>
        <br>
        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" value="<?=$producto['precio']?>" required>
        <br>
        <input type="submit" value="Actualizar Producto">
        <a href="index.php">Cancelar</a>
    </form>    
</body>
</html>