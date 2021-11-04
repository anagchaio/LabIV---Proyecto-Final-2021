<!-- Navigation-->
<?php
require_once('nav.php');
?>

<body>

    <!-- Header-->




    <header>

        <div class="conteiner-card">
            <div class="card text-center " style="width: 60rem;">
                <div class="card-header">
                    Home
                </div>
                <div class="card-body">
                    <h5 class="card-title">Bienvenido</h5>
                    <p class="card-text">En esta interfaz prodrás realizar las siguientes acciones</p>
                    <div class="d-grid gap-2 col-6 mx-auto">

                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Lista de Empresas</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>Company/RedirectAddForm">Agregar Empresa</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">Lista de Propuestas</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>JobOffer/RedirectAddFormJobOffer">Agregar Propuestas</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>Student/ShowListView">Lista de Alumnos</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>Career/Update">Actualizar Carreras</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>JobPosition/Update">Actualizar Posiciones</a>
                    </div>

                </div>
                <div class="card-footer text-muted">

                </div>
            </div>
        </div>



        <!-- <div class="container-menu px-4 px-lg-5 text-center">
            <h1 class="mb-1">Bienvenido</h1>
            <h2> Fuiste reconocido como Admin </h2>
            <h5 class="mb-5"><em>En esta interfaz prodrás realizar las siguientes acciones</em></h5>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Lista de Empresas</a>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>Company/RedirectAddForm">Agregar Empresa</a>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">Lista de Propuestas</a>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>JobOffer/RedirectAddFormJobOffer">Agregar Propuestas</a>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>Student/ShowListView">Lista de Alumnos</a>
            <br><br><br>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>Career/Update">Actualizar Carreras</a>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>JobPosition/Update">Actualizar Posiciones</a>
            
        </div> -->
    </header>

</body>