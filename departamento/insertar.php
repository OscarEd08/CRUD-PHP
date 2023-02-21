<!--Logica para insertar en la tabla-->
<?php
include_once("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $iddepartamento = $_POST["iddepartamento"];
    $nombre = $_POST["nombre"];
    $idubicacion = $_POST["idubicacion"];

    $sql = "INSERT INTO departamento (iddepartamento,idubicacion,nombre) 
            VALUES ('$iddepartamento','$idubicacion','$nombre')";
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
    <h2 class="mt-5 mb-4">Agregar nuevo departamento</h2>
    <form action="insertar.php" method="post">
        <div class="form-group">
            <label for="iddepartamento">ID Departamento</label>
            <input type="text" class="form-control" id="iddepartamento" name="iddepartamento" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre Departamento:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="idubicacion">ID Ubicacion:</label>
            <select class="form-control" id="idubicacion" name="idubicacion" required>
                <option value="">Seleccionar ID</option>
                <?php
                // Obtener los cargos de la base de datos y mostrarlos en el select
                include "../conexion.php";
                $query = "SELECT idubicacion,direccion FROM ubicacion";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['idubicacion'] . "'>" . $row['idubicacion'] . " - " . $row['direccion'] . "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Agregar</button>
        <a href="../index.php?tabla=departamento" class="btn btn-primary mt-3">Regresar</a>
    </form>
</div>
</body>
</html>