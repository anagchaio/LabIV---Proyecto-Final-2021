<!-- Navigation-->
<?php
require_once('nav.php');
?>

<body>

    <header>

        <div class="conteiner-card" style="margin-left:8.5vh">
            <div class="card text-center " style="width: 60rem;">
                <div class="card-header">
                    Home
                </div>
                <div class="card-body">
                    <h5 class="card-title">Bienvenido</h5>
                    <p class="card-text">En esta interfaz prodrás realizar las siguientes acciones</p>
                    <h4 style="color: rgb(145, 39, 177)">
                        <?php                        
                        if (isset($DBerror)) {
                            echo "Error: No se puede acceder a la base de datos. Intente mas tarde.";
                        }
                        ?>
                    </h4>
                    <div class="d-grid gap-2 col-6 mx-auto">

                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Lista de Empresas</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>Company/RedirectAddForm">Agregar Empresa</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">Lista de Propuestas</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>JobOffer/RedirectAddFormJobOffer">Agregar Propuestas</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>Student/ShowListView">Lista de Alumnos</a>

                    </div>

                </div>
                <div class="card-footer text-muted">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>Career/Update">Actualizar Carreras</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>JobPosition/Update">Actualizar Posiciones</a>
                    </div>
                </div>
            </div>
        </div>

    </header>

</body>