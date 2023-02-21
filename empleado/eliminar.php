<!DOCTYPE html>
<html>
<head>
    <title>CRUD</title>
	<!-- Agregar los estilos de Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1 class="mt-5 mb-4">Eliminar registro empleado</h1>
		<?php
		// Obtener el ID del registro a eliminar
		$idempleado = $_GET['idempleado'];

		// Incluir archivo de conexión a la base de datos
		include('../conexion.php');

		// Eliminar el registro de la tabla "empleado" correspondiente al ID
		$query = "DELETE FROM empleado WHERE idempleado='$idempleado'";
		$resultado = mysqli_query($conn, $query);

		// Verificar si la eliminación fue exitosa
		if ($resultado) {
			echo '<div class="alert alert-success" role="alert">El empleado se ha eliminado correctamente.</div>';
		} else {
			echo '<div class="alert alert-danger" role="alert">Ha ocurrido un error al eliminar el empleado: ' . mysqli_error($conn) . '</div>';
		}

		// Cerrar conexión a la base de datos
		mysqli_close($conn);
		?>
		<a href="../index.php?tabla=empleado" class="btn btn-secondary mt-3">Regresar</a>
	</div>
</body>
</html>
