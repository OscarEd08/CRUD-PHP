<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte General</title>
    <!-- Agregamos los estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>

<div class="container-fluid px-5">
  <h4 class="mt-2">Reporte general de empleado</h4>
  <form action="" method="post">
    <div class="form-group">
      <label for="idempleado" class="my-3">Seleccione el ID del empleado:</label>
      <select class="form-control" id="idempleado" name="idempleado">
        <?php
		      include("conexion.php");
          $sql = "SELECT idempleado FROM empleado ORDER BY idempleado";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<option value='" . $row['idempleado'] . "'>" . $row['idempleado'] . "</option>";
            }
          } else {
            echo "No hay empleados registrados";
          }
        ?>
      </select>
    </div>
    <button type="submit" class="btn btn-success mt-4 mb-5">Generar reporte</button>
  </form>

  <!--Se muestra el reporte-->
  <?php
  if (isset($_POST['idempleado'])) {
    $idempleado = $_POST['idempleado'];

    $sql = "SELECT empleado.idempleado, CONCAT(empleado.nombres, ' ' ,empleado.apellido) as nombrecompleto, 
				   empleado.fecingreso, empleado.email, empleado.telefono, empleado.sueldo, empleado.comision, 
				   CONCAT(jefe.nombres, ' ' ,Jefe.apellido) as jefenombre, jefe.email as jefeemail ,
				   departamento.nombre as departamento, CONCAT(ubicacion.direccion, ' - ',ubicacion.ciudad) as direccion ,
				   cargo.nombre as cargo, cargo.sueldo_min as sueldo_min, cargo.sueldo_max as sueldo_max 
			FROM empleado
			LEFT JOIN empleado as jefe ON empleado.jefe = jefe.idempleado
			INNER JOIN departamento ON empleado.iddepartamento = departamento.iddepartamento
			INNER JOIN ubicacion ON departamento.idubicacion = ubicacion.idubicacion
			INNER JOIN cargo ON empleado.idcargo = cargo.idcargo
			WHERE empleado.idempleado = '$idempleado'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
	?>	
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
              <h4>Información Personal</h4>
              <p><strong>Nombre Completo:</strong> <?php echo $row ['nombrecompleto']; ?></p>
              <p><strong>Fecha de Ingreso:</strong> <?php echo $row ['fecingreso']; ?></p>
              <p><strong>Email:</strong> <?php echo $row ['email']; ?></p>
              <p><strong>Teléfono:</strong> <?php echo $row ['telefono']; ?></p>
              <p><strong>Salario:</strong> <?php echo $row['sueldo'] ?></p>
          </div>
          <div class="col-md-4">
              <h4>Información del Cargo</h4>
              <p><strong>Cargo:</strong> <?php echo $row['cargo'] ?></p>
              <p><strong>Departamento:</strong> <?php echo $row['departamento'] ?></p>
              <p><strong>Ubicación:</strong> <?php echo $row['direccion'] ?></p>
              <p><strong>Sueldo Mínimo:</strong> <?php echo $row['sueldo_min'] ?></p>
              <p><strong>Sueldo Máximo:</strong> <?php echo $row['sueldo_max'] ?></p>
              <p><strong>Comisión:</strong> <?php echo $row['comision'] ?>%</p>
          </div>
          <div class="col-md-4">
              <h4>Información del Jefe</h4>
              <?php if ($row['jefenombre']) { ?>
                  <p><strong>Nombre:</strong> <?php echo $row['jefenombre'] ?></p>
                  <p><strong>Email:</strong> <?php echo $row['jefeemail'] ?></p>
              <?php } else { ?>
                  <p>Este empleado no tiene jefe.</p>
              <?php } ?>
          </div>
      </div>
    </div>
	<?php
	}
	else {
      echo "No se encontró al empleado seleccionado";
    }
  }
   ?>
</div>
</body>
</html>
