<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
	<!-- Agregar los estilos de Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1 class="mt-5 mb-4">Editar registro cargo</h1>
		<?php
		// Verificar si se ha enviado el formulario
		if (isset($_POST['submit'])) {
			// Obtener los datos del formulario
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
			$sueldo_min = $_POST['sueldo_min'];
			$sueldo_max = $_POST['sueldo_max'];

			// Incluir archivo de conexión a la base de datos
			include('../conexion.php');

			// Actualizar el registro en la tabla "cargo"
			$query = "UPDATE cargo SET nombre='$nombre', sueldo_min='$sueldo_min', sueldo_max='$sueldo_max' WHERE idcargo='$id'";
			$resultado = mysqli_query($conn, $query);

			// Verificar si la actualización fue exitosa
			if ($resultado) {
				echo '<div class="alert alert-success" role="alert">El cargo se ha actualizado correctamente.</div>';
			} else {
				echo '<div class="alert alert-danger" role="alert">Ha ocurrido un error al actualizar el cargo: ' . mysqli_error($conn) . '</div>';
			}

			// Cerrar conexión a la base de datos
			mysqli_close($conn);
		} else {
			// Obtener el ID del registro a editar
			$id = $_GET['idcargo'];

			// Incluir archivo de conexión a la base de datos
			include('../conexion.php');

			// Obtener el registro de la tabla "cargo" correspondiente al ID
			$query = "SELECT * FROM cargo WHERE idcargo='$id'";
			$resultado = mysqli_query($conn, $query);

			// Verificar si se encontró el registro
			if (mysqli_num_rows($resultado) == 1) {
				$fila = mysqli_fetch_assoc($resultado);
				?>
				<form action="editar.php" method="post">
					<input type="hidden" name="id" value="<?php echo $fila['idcargo']; ?>">
					<div class="form-group">
						<label>Nombre:</label>
						<input type="text" name="nombre" class="form-control" value="<?php echo $fila['nombre']; ?>" required>
					</div>
					<div class="form-group">
						<label>Sueldo mínimo:</label>
						<input type="number" name="sueldo_min" class="form-control" value="<?php echo $fila['sueldo_min']; ?>" required>
					</div>
					<div class="form-group">
						<label>Sueldo máximo:</label>
						<input type="number" name="sueldo_max" class="form-control" value="<?php echo $fila['sueldo_max']; ?>" required>
                        </div>
				<button type="submit" name="submit" class="btn btn-primary mt-3">Actualizar registro</button>
			</form>
			<?php
		} else {
			echo '<div class="alert alert-danger" role="alert">No se encontró el registro con el ID ' . $id . '</div>';
		}

		// Cerrar conexión a la base de datos
		mysqli_close($conn);
	}
	?>
	<a href="../index.php?tabla=cargo" class="btn btn-secondary mt-3">Regresar</a>
</div>
