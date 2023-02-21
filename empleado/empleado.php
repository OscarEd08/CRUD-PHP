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
                    <th>Apellido</th>
                    <th>Nombres</th>
                    <th>Fecha Ingreso</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>ID Cargo</th>
                    <th>ID Departamento</th>
                    <th>Sueldo</th>
                    <th>Comision</th>
                    <th>Jefe</th>
                    <th class="table-active">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
				// Incluir archivo de conexión a la base de datos
				include('conexion.php');

				// Obtener todos los registros de la tabla "cargo"
				$query = "SELECT * FROM empleado";
				$resultado = mysqli_query($conn, $query);

				// Mostrar los registros en la tabla
				while ($fila = mysqli_fetch_assoc($resultado)) {
					?>
                <tr>
                    <td><?php echo $fila['idempleado']; ?></td>
                    <td><?php echo $fila['apellido']; ?></td>
                    <td><?php echo $fila['nombres']; ?></td>
                    <td><?php echo $fila['fecingreso']; ?></td>
                    <td><?php echo $fila['email']; ?></td>
                    <td><?php echo $fila['telefono']; ?></td>
                    <td><?php echo $fila['idcargo']; ?></td>
                    <td><?php echo $fila['iddepartamento']; ?></td>
                    <td><?php echo $fila['sueldo']; ?></td>
                    <td><?php echo $fila['comision']; ?></td>
                    <td><?php echo $fila['jefe']; ?></td>
                    <td>
                        <a href="empleado/editar.php?idempleado=<?php echo $fila['idempleado']; ?>" class="btn btn-info btn-sm me-3 fs-6 text-white">Editar</a>
                        <a href="empleado/eliminar.php?idempleado=<?php echo $fila['idempleado']; ?>" class="btn btn-danger btn-sm ms-3 fs-6" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</a>
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
            <a href="empleado/insertar.php" class="btn btn-warning mt-5 fs-5 text-white">Agregar nuevo registro</a>  
        </div>
    </div>
</body>
</html>