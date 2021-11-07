<!-- Navigation-->
<?php
require_once(VIEWS_PATH . "nav-student.php");

?>

<body>

    <!-- Header-->

    <header >


        <div class="conteiner-card" style="margin-left:8.5vh">
            <div class="card text-center " style="width: 60rem;">
                <div class="card-header">
                    Home
                </div>
                <div class="card-body">
                    <h5 class="card-title">Bienvenido</h5>
                    <p class="card-text">En esta interfaz prodrás realizar las siguientes acciones</p>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Ver Empresas</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">Lista de Propuestas</a>

                    </div>

                </div>
                <div class="card-footer text-muted">
                    <div class="d-grid gap-2 col-6 mx-auto">
                    <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT .  "Student/ShowStudent/" . $_SESSION['student']->getStudentId()  ?>">Perfil</a>

                    </div>
                </div>
            </div>
        </div>
    </header>

</body>