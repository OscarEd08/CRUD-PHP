<!DOCTYPE html>
<html>
<head>
    <title>CRUD</title>
	<!-- Agregar los estilos de Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1 class="mt-5 mb-4">Eliminar registro cargo</h1>
		<?php
		// Obtener el ID del registro a eliminar
		$idcargo = $_GET['idcargo'];

		// Incluir archivo de conexión a la base de datos
		include('../conexion.php');

		// Eliminar el registro de la tabla "cargo" correspondiente al ID
		$query = "DELETE FROM cargo WHERE idcargo='$idcargo'";
		$resultado = mysqli_query($conn, $query);

		// Verificar si la eliminación fue exitosa
		if ($resultado) {
			echo '<div class="alert alert-success" role="alert">El cargo se ha eliminado correctamente.</div>';
		} else {
			echo '<div class="alert alert-danger" role="alert">Ha ocurrido un error al eliminar el cargo: ' . mysqli_error($conn) . '</div>';
		}

		// Cerrar conexión a la base de datos
		mysqli_close($conn);
		?>
		<a href="../index.php?tabla=cargo" class="btn btn-secondary mt-3">Regresar</a>
	</div>
</body>
</html>
