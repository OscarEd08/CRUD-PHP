<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid mt-5">
        <div class="container-fluid p-5 mb-4 bg-dark text-white">
            <h1>
                CRUD PHP & MySQL
            </h1>
        </div>
        <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light">   
            <div class="container-fluid mb-4">
                <ul class="navbar-nav nav-tabs mt-1">
                    <li class="nav-item">
                    <a                         
                        class="px-4 fs-5 nav-link<?php 
                            if (!isset($_GET['tabla']) || $_GET['tabla'] == 'empleado') 
                                echo ' active'; ?>" 
                        href="index.php?tabla=empleado">Empleados</a>
                    </li>
                    <li class="nav-item">
                    <a class="px-4 fs-5 nav-link<?php 
                            if (isset($_GET['tabla']) && $_GET['tabla'] == 'cargo') 
                            echo ' active'; ?>" 
                        href="index.php?tabla=cargo">Cargos</a>
                    </li>
                    <li class="nav-item">
                    <a class="px-4 fs-5 nav-link<?php 
                            if (isset($_GET['tabla']) && $_GET['tabla'] == 'departamento') 
                            echo ' active'; ?>" 
                        href="index.php?tabla=departamento">Departamentos</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <a class="btn btn-outline-success fs-5"
                        class="nav-link<?php
                            if (!isset($_GET['tabla']) || $_GET['tabla'] == 'reporte-total') 
                            echo ' active'; ?>" 
                        href="index.php?tabla=reporte-total"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                         Reporte Resumen
                    </a>
                </form>
            </div>
        </nav>
        </div>
        <?php
            if (isset($_GET['tabla']) && $_GET['tabla'] == 'cargo') {
                include 'cargo/cargo.php';
            } 
            else if(isset($_GET['tabla']) && $_GET['tabla'] == 'departamento'){
                include 'departamento/departamento.php';
            }
            else if(isset($_GET['tabla']) && $_GET['tabla'] == 'reporte-total'){
                include 'reporte.php';
            }
            else {
                include 'empleado/empleado.php';
            }
        ?>
    </div>
</body>

</html>
