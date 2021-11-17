<?php
require_once('nav-company.php');
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
                    <div class="d-grid gap-2 col-6 mx-auto">


                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">Lista de Propuestas</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>JobOffer/RedirectAddFormJobOffer/">Agregar Propuestas</a>
                        <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT .  "Company/ShowCompany/" . $_SESSION['company']->getCompanyId()  ?>">Mis datos</a>



                    </div>

                </div>

                <div class="card-footer text-muted">
                <div class="d-grid gap-2 col-6 mx-auto">

                    </div>
                </div>
            </div>
        </div>

    </header>

</body>