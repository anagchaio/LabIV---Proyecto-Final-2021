<!-- Navigation-->
<?php
require_once(VIEWS_PATH . "nav-student.php");

?>

<body>

    <!-- Header-->

        <div class="conteiner-card" style="margin-left:8.5vh; margin-top:15vh;">
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
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Ver Empresas</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">Lista de Propuestas</a>

                    </div>

                </div>
                <div class="card-footer text-muted">
                    <div class="d-grid gap-2 col-6 mx-auto">
                    <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT .  "Student/ShowStudent/" . $_SESSION['student']->getStudentId()  ?>">Perfil</a>
                    <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT .  "JobOffer/SendEmailRegistration/" . $_SESSION['student']->getEmail()  ?>">ENVIAR MAIL</a>

                    </div>
                </div>
            </div>
        </div>

</body>