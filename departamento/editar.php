<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
    <!-- Agregar los estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Editar registro departamento</h1>
        <?php
		// Verificar si se ha enviado el formulario
		if (isset($_POST['submit'])) {
			// Obtener los datos del formulario
			$iddepartamento = $_POST['iddepartamento'];
			$nombre = $_POST['nombre'];
			$idubicacion = $_POST['idubicacion'];
			// Incluir archivo de conexión a la base de datos
			include('../conexion.php');

			// Actualizar el registro en la tabla "departamento"
			$query = "UPDATE departamento SET nombre='$nombre', idubicacion='$idubicacion' WHERE iddepartamento='$iddepartamento'";
			$resultado = mysqli_query($conn, $query);

			// Verificar si la actualización fue exitosa
			if ($resultado) {
				echo '<div class="alert alert-success" role="alert">El departamento se ha actualizado correctamente.</div>';
			} else {
				echo '<div class="alert alert-danger" role="alert">Ha ocurrido un error al actualizar el departamento: ' . mysqli_error($conn) . '</div>';
			}

			// Cerrar conexión a la base de datos
			mysqli_close($conn);
		} else {
			// Obtener el ID del registro a editar
			$iddepartamento = $_GET['iddepartamento'];

			// Incluir archivo de conexión a la base de datos
			include('../conexion.php');

			// Obtener el registro de la tabla "departamento" correspondiente al ID
			$query = "SELECT * FROM departamento WHERE iddepartamento='$iddepartamento'";
			$resultado = mysqli_query($conn, $query);

			// Verificar si se encontró el registro
			if (mysqli_num_rows($resultado) == 1) {
				$fila = mysqli_fetch_assoc($resultado);
				?>
        <form action="editar.php" method="post">
            <input type="hidden" name="iddepartamento" value="<?php echo $fila['iddepartamento']; ?>">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo $fila['nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="idubicacion">ID Ubicacion:</label>
                    <?php
						include "../conexion.php";
						$query = "SELECT idubicacion,direccion FROM ubicacion";
						$result = mysqli_query($conn, $query);
                    ?>
				<select class="form-control" id="idubicacion" name="idubicacion">
					<option value=""></option>
					<?php while ($row = mysqli_fetch_array($result)) { ?>
            			<option value="<?= $row['idubicacion'] ?>" <?= ($row['idubicacion'] == $fila['idubicacion']) ? 'selected' : '' ?>><?= $row['idubicacion'] ?> - <?= $row['direccion'] ?></option>
        			<?php } ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary mt-3">Actualizar registro</button>
        </form>
        <?php
		} else {
			echo '<div class="alert alert-danger" role="alert">No se encontró el registro con el ID ' . $iddepartamento . '</div>';
		}

		// Cerrar conexión a la base de datos
		mysqli_close($conn);
	}
	?>
        <a href="../index.php?tabla=departamento" class="btn btn-secondary mt-3">Regresar</a>
    </div>