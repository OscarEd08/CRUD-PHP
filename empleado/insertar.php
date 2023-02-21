<!--Logica para insertar en la tabla-->
<?php
include_once("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idempleado = $_POST["idempleado"];
    $nombres = $_POST["nombres"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $fecingreso = $_POST["fecingreso"];
    $idcargo = $_POST["idcargo"];
    $iddepartamento = $_POST["iddepartamento"];
    $sueldo = $_POST["sueldo"];
    $comision = $_POST["comision"];
    $jefe = $_POST["jefe"];

    $sql = "INSERT INTO empleado (idempleado,apellido,nombres, email, telefono, fecingreso,idcargo,iddepartamento,sueldo,comision,jefe) 
            VALUES ('$idempleado','$apellido','$nombres', '$email', '$telefono', '$fecingreso' ,'$idcargo','$iddepartamento', '$sueldo', '$comision' ,'$jefe')";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5 mb-5">
    <!-- Agregar el formulario para insertar un nuevo registro -->
    <h2 class="mt-5 mb-4">Agregar nuevo empleado</h2>
    <form action="insertar.php" method="post">
        <div class="form-group">
            <label for="idempleado">ID</label>
            <input type="text" class="form-control" id="idempleado" name="idempleado" required>
        </div>
        <div class="form-group">
            <label for="nombres">Nombre:</label>
            <input type="text" class="form-control" id="nombres" name="nombres" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" required>
        </div>
        <div class="form-group">
            <label for="fecingreso">Fecha de ingreso:</label>
            <input type="date" class="form-control" id="fecingreso" name="fecingreso">
        </div>

        <div class="form-group">
            <label for="idcargo">Cargo:</label>
            <select class="form-control" id="idcargo" name="idcargo" required>
                <option value="">Seleccionar cargo</option>
                <?php
                    // Obtener los cargos de la base de datos y mostrarlos en el select
                    include "../conexion.php";
                    $query = "SELECT idcargo,nombre FROM cargo";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row['idcargo'] . "'>" . $row['idcargo'] . " - " . $row['nombre'] . "</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="iddepartamento">Departamento:</label>
            <select class="form-control" id="iddepartamento" name="iddepartamento" required>
                <option value="">Seleccionar departamento</option>
                <?php
                // Obtener los departamentos de la base de datos y mostrarlos en el select
                $query = "SELECT iddepartamento,nombre FROM departamento";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['iddepartamento'] . "'>" . $row['iddepartamento'] . " - ". $row['nombre'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="sueldo">Sueldo</label>
            <input type="text" class="form-control" id="sueldo" name="sueldo" required>
        </div>
        <div class="form-group">
            <label for="comision">Comision</label>
            <input type="text" class="form-control" id="comision" name="comision" required>
        </div>
        <div class="form-group">
            <label for="jefe">Jefe:</label>
            <select class="form-control" id="jefe" name="jefe">
                <option value="">Seleccionar jefe</option>
                <?php
                // Obtener los empleados de la base de datos y mostrarlos en el select
                include "../conexion.php";
                $query = "SELECT idempleado, CONCAT(nombres, ' ', apellido) AS nombre_completo FROM empleado";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['idempleado'] . "'>". $row['idempleado'] . " - " . $row['nombre_completo'] . "</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Agregar</button>
        <a href="../index.php?tabla=empleado" class="btn btn-primary mt-3">Regresar</a>
    </form>
</div>
</body>
</html>