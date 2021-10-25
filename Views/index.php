<?php

?>

<main class="d-flex align-items-center justify-content-center height-100">
    <div class="content">
        <header class="text-center">
            <h2>Bolsa de Empleos IT</h2>
            <h4 style="color: rgb(145, 39, 177)">
            <?php
                if (isset($invalidEmail)) {
                    echo "Error: el email no se encuentra en el sistema. Debe registrarse.";
                }
                if (isset($succesfulRegistration)) {
                    echo "El usuario fue registrado correctamente en el sistema.";
                }
                if (isset($userNotLogged)) {
                    echo "Error: Debe estar loggeado para acceder.";
                }
                if (isset($userNotAdmin)) {
                    echo "Error: Debe estar loggeado como Administrador para acceder.";
                }
            ?>
            </h4>
        </header>

        <form action="<?php echo FRONT_ROOT ?>Home/login" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar email" required>
            </div>
            <div class="form-group">
                <label for="">password</label>
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar contraseña" required>
            </div>
            <button class="btn btn-primary btn-block btn-lg" type="submit">Iniciar Sesión</button>
        </form>
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/ShowRegister">Registrarse</a>
    </div>
</main>
