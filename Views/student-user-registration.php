<?php

?>

<main class="d-flex align-items-center justify-content-center height-100">
    <div class="content">
        <header class="text-center">
            <h4 style="color: rgb(145, 39, 177)">
                <?php
                if (isset($invalidEmail)) {
                    echo "Error: el email no corresponde a un estudiante activo.";
                }
                if (isset($registedEmail)) {
                    echo "Error: el email ya se encuentra en el sistema.";
                }
                if (isset($DBerror)) {
                    echo "Error: No se puede acceder a la base de datos. Intente mas tarde.";
                }
                ?>
            </h4>
        </header>

        <form action="<?php echo FRONT_ROOT ?>Student/Register" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
            <h3 class="title-login">Ingresar Datos</h3>

            <div class="form-group">
                <!-- <label for="">Email</label> -->
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar email" required>
            </div>
            <div class="form-group" style="margin-bottom: 5vh;">
                <!-- <label for="">password</label> -->
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar contraseña" required>
            </div>
            <button class="btn btn-primary btn-block btn-lg" type="submit">Registrarse como Alumno</button>
           
        </form>
    </div>
</main>