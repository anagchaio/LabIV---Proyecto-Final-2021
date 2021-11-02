<!-- Navigation-->
<?php
               require_once(VIEWS_PATH . "nav-student.php");
           
?>

<body>

    <!-- Header-->

    <header class="masthead d-flex align-items-center">



        <div class="container-menu px-4 px-lg-5 text-center">
            <!-- <div class="view-container"> -->
            <h1 class="mb-1">Bienvenido</h1>
            <h5 class="mb-5"><em>En esta interfaz prodrás realizar las siguientes acciones</em></h5>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Ver Empresas</a>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">Lista de Propuestas</a>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT .  "Student/ShowStudent/" . $student->getStudentId()  ?>">Perfil</a>

        </div>
    </header>

</body>