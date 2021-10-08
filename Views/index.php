<?php
  
    require_once('nav.php');
    //API Student Test
    /* use DAO\StudentDAO as studentDAO;


    $studentDAO = new studentDAO();

    $students = $studentDAO->getAll();

    var_dump($students); 

    use DAO\CareerDAO as CareerDAO;

    $careerDao = new CareerDAO();

    $career = $careerDao->GetAll();

    var_dump($career);*/

?>

<main class="d-flex align-items-center justify-content-center height-100">
    <div class="content">
        <header class="text-center">
            <h2>Bolsa de Empleos IT</h2>
            <h4 style="color: rgb(145, 39, 177)">
            <?php
                if (isset($invalidEmail)) {
                    echo "Error: el usuario no se encuentra en el sistema.";
                }
                if (isset($userNotLogged)) {
                    echo "Error: Debe estar loggeado para acceder.";
                }
            ?>
            </h4>
        </header>

        <form action="<?php echo FRONT_ROOT ?>Home/login" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar email" required>
            </div>
            <button class="btn btn-primary btn-block btn-lg" type="submit">Iniciar Sesión</button>
        </form>
    </div>
</main>
