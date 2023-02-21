<!--Logica para insertar en la tabla-->
<?php
include_once("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idcargo = $_POST["idcargo"];
    $nombre = $_POST["nombre"];
    $sueldo_min = $_POST["sueldo_min"];
    $sueldo_max = $_POST["sueldo_max"];

    $sql = "INSERT INTO cargo (idcargo,nombre, sueldo_min, sueldo_max) VALUES ('$idcargo','$nombre', '$sueldo_min', '$sueldo_max')";
    if (mysqli_query($conn, $sql)) {
        echo '<a href="../index.php" style="text-decoration: none;"><div class="alert alert-success" role="alert">El registro se ha actualizado correctamente. Presion aqui para regresar</div></a>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Ha ocurrido un error al actualizar el registro: ' . mysqli_error($conn) . '</div>';
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD</title>
    <!-- Agregar los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5 mb-5">
    <!-- Agregar el formulario para insertar un nuevo registro -->
    <h2 class="mt-5 mb-4">Agregar nuevo cargo</h2>
        <form action="insertar.php" method="post">
            <div class="form-group">
				<label>ID:</label>
				<input type="text" name="idcargo" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Nombre:</label>
				<input type="text" name="nombre" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Sueldo mínimo:</label>
				<input type="number" name="sueldo_min" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Sueldo máximo:</label>
				<input type="number" name="sueldo_max" class="form-control" required>
			</div>
			<button type="submit" class="btn btn-primary mt-3">Agregar</button>
            <a href="../index.php" class="btn btn-primary mt-3">Regresar</a>
        </form>
</div>
</body>
</html>