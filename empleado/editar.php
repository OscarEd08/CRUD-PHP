<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
    <!-- Agregar los estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Editar registro empleado</h1>
        <?php
		// Verificar si se ha enviado el formulario
		if (isset($_POST['submit'])) {
			// Obtener los datos del formulario
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
			// Incluir archivo de conexión a la base de datos
			include('../conexion.php');

			// Actualizar el registro en la tabla "empleado"
			$query = "UPDATE empleado 
                      SET nombres='$nombres', apellido='$apellido', email='$email', telefono='$telefono', fecingreso='$fecingreso', idcargo='$idcargo', iddepartamento='$iddepartamento', sueldo='$sueldo', comision='$comision', jefe='$jefe' 
                      WHERE idempleado='$idempleado'";
			$resultado = mysqli_query($conn, $query);
			// Verificar si la actualización fue exitosa
			if ($resultado) {
				echo '<div class="alert alert-success" role="alert">El empleado se ha actualizado correctamente.</div>';
			} else {
				echo '<div class="alert alert-danger" role="alert">Ha ocurrido un error al actualizar el empleado: ' . mysqli_error($conn) . '</div>';
			}

			// Cerrar conexión a la base de datos
			mysqli_close($conn);
		} else {
			// Obtener el ID del registro a editar
			$idempleado = $_GET['idempleado'];

			// Incluir archivo de conexión a la base de datos
			include('../conexion.php');

			// Obtener el registro de la tabla "empleado" correspondiente al ID
			$query = "SELECT * FROM empleado WHERE idempleado='$idempleado'";
			$resultado = mysqli_query($conn, $query);

			// Verificar si se encontró el registro
			if (mysqli_num_rows($resultado) == 1) {
				$fila = mysqli_fetch_assoc($resultado);
				?>
        <form action="editar.php" method="post">
            <input type="hidden" name="idempleado" value="<?php echo $fila['idempleado']; ?>">
            <div class="form-group">
                <label>Nombres:</label>
                <input type="text" name="nombres" class="form-control" value="<?php echo $fila['nombres']; ?>" required>
            </div>
            <div class="form-group">
                <label>Apellido:</label>
                <input type="text" name="apellido" class="form-control" value="<?php echo $fila['apellido']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="text" name="email" class="form-control" value="<?php echo $fila['email']; ?>" required>
            </div>
            <div class="form-group">
                <label>Telefono:</label>
                <input type="text" name="telefono" class="form-control" value="<?php echo $fila['telefono']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label>Fecha de ingreso:</label>
                <input type="text" name="fecingreso" class="form-control" value="<?php echo $fila['fecingreso']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="idcargo">ID Cargo:</label>
                <?php
						include "../conexion.php";
						$query = "SELECT idcargo,nombre FROM cargo";
						$result = mysqli_query($conn, $query);
                    ?>
                <select class="form-control" id="idcargo" name="idcargo">
                    <option value=""></option>
                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <option value="<?= $row['idcargo'] ?>"
                        <?= ($row['idcargo'] == $fila['idcargo']) ? 'selected' : '' ?>><?= $row['idcargo'] ?> -
                        <?= $row['nombre'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="iddepartamento">ID Departamento:</label>
                <?php
						include "../conexion.php";
						$query = "SELECT iddepartamento,nombre FROM departamento";
						$result = mysqli_query($conn, $query);
                    ?>
                <select class="form-control" id="iddepartamento" name="iddepartamento">
                    <option value=""></option>
                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <option value="<?= $row['iddepartamento'] ?>"
                        <?= ($row['iddepartamento'] == $fila['iddepartamento']) ? 'selected' : '' ?>>
                        <?= $row['iddepartamento'] ?> - <?= $row['nombre'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Sueldo:</label>
                <input type="text" name="sueldo" class="form-control" value="<?php echo $fila['sueldo']; ?>" required>
            </div>
            <div class="form-group">
                <label>Comision:</label>
                <input type="text" name="comision" class="form-control" value="<?php echo $fila['comision']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="jefe">Jefe:</label>
                <select class="form-control" id="jefe" name="jefe">
                    <option value="">Seleccione un jefe</option>
                    <?php
                        // Obtener los empleados de la base de datos y mostrarlos en el select
                        include "../conexion.php";
                        $query = "SELECT idempleado, CONCAT(nombres, ' ', apellido) AS nombre_completo FROM empleado";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $selected = ($row['idempleado'] == $fila['jefe']) ? "selected" : "";
                            echo "<option value='" . $row['idempleado'] . "' " . $selected . ">" . $row['idempleado'] . " - " . $row['nombre_completo'] . "</option>";
                        }
                     ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary mt-3">Actualizar registro</button>
        </form>
        <?php
		} else {
			echo '<div class="alert alert-danger" role="alert">No se encontró el registro con el ID ' . $idempleado . '</div>';
		}

		// Cerrar conexión a la base de datos
		mysqli_close($conn);
	}
	?>
        <a href="../index.php?tabla=empleado" class="btn btn-secondary mt-3">Regresar</a>
    </div>