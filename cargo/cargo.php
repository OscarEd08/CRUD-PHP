<!DOCTYPE html>
<html>
<head>
    <title>CRUD</title>
    <!-- Agregar los estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid mb-5 text-center">
        <!-- Agregar la tabla de la base de datos -->
        <div class="table-responsive">
        <table class="table">
            <thead class="table-light">
            <tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Sueldo Mínimo</th>
					<th>Sueldo Máximo</th>
                    <th class="table-active">Opciones</th>
				</tr>
            </thead>
            <tbody>
                <?php
				// Incluir archivo de conexión a la base de datos
				include('conexion.php');

				// Obtener todos los registros de la tabla "cargo"
				$query = "SELECT * FROM cargo";
				$resultado = mysqli_query($conn, $query);

				// Mostrar los registros en la tabla
				while ($fila = mysqli_fetch_assoc($resultado)) {
					?>
                <tr>
                    <td><?php echo $fila['idcargo']; ?></td>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['sueldo_min']; ?></td>
                    <td><?php echo $fila['sueldo_max']; ?></td>
                    <td>
                        <a href="cargo/editar.php?idcargo=<?php echo $fila['idcargo']; ?>" class="btn btn-info btn-sm me-3 fs-6 text-white">Editar</a>
                        <a href="cargo/eliminar.php?idcargo=<?php echo $fila['idcargo']; ?>" class="btn btn-danger btn-sm ms-3 fs-6" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</a>
                    </td>
                </tr>
                <?php
				}

				// Cerrar conexión a la base de datos
				mysqli_close($conn);
				?>
            </tbody>
        </table>
        </div>
		<div class="text-center">
            <a href="cargo/insertar.php" class="btn btn-warning mt-5 fs-5 text-white">Agregar nuevo registro</a>  
        </div>
    </div>
</body>

</html>