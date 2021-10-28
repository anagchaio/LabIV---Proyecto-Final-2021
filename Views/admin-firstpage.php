<!-- Navigation-->
<?php
 require_once('nav.php');
?>
<body>

    <!-- Header-->
    <header class="masthead d-flex align-items-center">
        <div class="container-menu px-4 px-lg-5 text-center">
        <!-- <div class="view-container"> -->
            <h1 class="mb-1">Bienvenido</h1>
            <h2> Fuiste reconocido como Admin </h2>
            <h5 class="mb-5"><em>En esta interfaz prodrás realizar las siguientes acciones</em></h5>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Lista de Empresas</a>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>Company/RedirectAddForm">Agregar Empresa</a>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">Lista de Propuestas</a>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>Student/ShowListView">Lista de Alumnos</a>
        </div>
    </header>

</body>
