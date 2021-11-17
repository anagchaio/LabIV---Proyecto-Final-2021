<?php

?>

<main class="d-flex align-items-center justify-content-center height-100">
    <div class="content">
        <header class="text-center">
            <div class="text-center">
                <h4 style="color: rgb(145, 39, 177)">
                    <?php
                    if (isset($invalidEmail)) {
                        echo "Error: el email no se encuentra en el sistema. Debe registrarse.";
                    }
                    if (isset($notActiveStudent)) {
                        echo "Error: el usuario no esta activo. Comuniquese con la UTN.";
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
                    if (isset($DBerror)) {
                        echo "Error: No se puede acceder a la base de datos. Intente mas tarde.";
                    }
                    ?>
                </h4>
            </div>
        </header>

        <form action="<?php echo FRONT_ROOT ?>Home/login" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
            <h2 class="title-login">Bolsa de Empleos IT</h2>
            <div class="form-group">
                <!-- <label for="">Email</label> -->
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar email" required>
            </div>
            <div class="form-group" style="margin-bottom: 5vh;">
                <!-- <label for="">password</label> -->
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar contraseña" required>
            </div>
            <button class="btn btn-primary btn-block btn-lg" type="submit">Iniciar Sesión</button>
            <div class="text-center">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/ShowStudentRegister">Crear una nueva cuenta</a>
            </div>
            <div class="text-center" style="display: flex; margin-left: 5vh">
                <a >¿Registrarse como empresa?</a>
                
                <a style="margin-left: 2vh;" href="<?php echo FRONT_ROOT ?>Home/ShowCompanyRegister">Ingrese aquí</a>
            </div>

        </form>
    </div>
</main>