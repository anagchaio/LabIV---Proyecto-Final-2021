<!-- Navigation-->

<body>
    <!-- <div class="area"></div> -->
    <nav class="main-menu">


        <div class="menu-title">
            <a href="<?php echo FRONT_ROOT ?>Home/RedirectAdm">
                <i class="fa fa-home fa-2x"></i>
                <h3 class="title">MENU</h3>
            </a>
        </div>

        <ul>
            <!-- <li>
                <a href="#">
                    <i class="fa fa-home fa-2x"></i>
                    <h3>MENU</h3>
                </a>

            </li> -->
            <li class="has-subnav">
                <a href="<?php echo FRONT_ROOT ?>Company/ShowListView">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">
                        Empresas
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="#">
                    <i class="fa fa-laptop fa-2x"></i>
                    <span class="nav-text">
                        Propuestas
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="<?php echo FRONT_ROOT ?>Student/ShowListView">
                    <i class="fa fa-list fa-2x"></i>
                    <span class="nav-text">
                        Alumnos
                    </span>
                </a>

            </li>
         
            <li class="has-subnav">
                <a href="#">
                    <i class="fa fa-folder-open fa-2x"></i>
                    <span class="nav-text">
                        Mensajes
                    </span>
                </a>

            </li>

            <ul class="logout">
                <li>
                    <a href="<?php echo FRONT_ROOT ?>Home/Logout">
                        <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text">
                            Logout
                        </span>
                    </a>
                </li>
            </ul>
    </nav>    

    <!-- Header-->
    <header class="masthead d-flex align-items-center">
        <div class="container px-4 px-lg-5 text-center">
        <!-- <div class="view-container"> -->
            <h1 class="mb-1">Bienvenido</h1>
            <h2> Fuiste reconocido como Admin </h2>
            <h3 class="mb-5"><em>En esta interfaz prodrás realizar las siguientes acciones</em></h3>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>Company/RedirectShowForm">Ver Empresas</a>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Lista de Empresas</a>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>Company/RedirectAddForm">Agregar Empresa</a>
            <a class="btn btn-primary btn-xl" href="#">Lista de Propuestas</a>
            <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>Student/ShowListView">Lista de Alumnos</a>
        </div>
    </header>

</body>
