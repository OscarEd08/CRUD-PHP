<!DOCTYPE html>
<html>
<head>
    <title>CRUD</title>
	<!-- Agregar los estilos de Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1 class="mt-5 mb-4">Eliminar registro departamento</h1>
		<?php
		// Obtener el ID del registro a eliminar
		$iddepartamento = $_GET['iddepartamento'];

		// Incluir archivo de conexión a la base de datos
		include('../conexion.php');

		// Eliminar el registro de la tabla "departamento" correspondiente al ID
		$query = "DELETE FROM departamento WHERE iddepartamento='$iddepartamento'";
		$resultado = mysqli_query($conn, $query);

		// Verificar si la eliminación fue exitosa
		if ($resultado) {
			echo '<div class="alert alert-success" role="alert">El departamento se ha eliminado correctamente.</div>';
		} else {
			echo '<div class="alert alert-danger" role="alert">Ha ocurrido un error al eliminar el departamento: ' . mysqli_error($conn) . '</div>';
		}

		// Cerrar conexión a la base de datos
		mysqli_close($conn);
		?>
		<a href="../index.php?tabla=departamento" class="btn btn-secondary mt-3">Regresar</a>
	</div>
</body>
</html>
