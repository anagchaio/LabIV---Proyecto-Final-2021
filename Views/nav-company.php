<nav class="main-menu">

    <!-- 
    <div class="has-subnav">
        <a href="<?php echo FRONT_ROOT ?>Home/RedirectHome">
            <i class="fa fa-home fa-2x"></i>
            <span class="nav-text">
                    Home
                </span>
        </a>
    </div> -->

    <ul>
        <li class="has-subnav">
            <a href="<?php echo FRONT_ROOT ?>Home/RedirectHome">
                <i class="fa fa-bars fa-2x"></i>
                <span class="nav-text">
                    <h4 style="margin-top: 1vh"> Menu </h4>
                </span>
            </a>
        </li>
        <div class="menu-options">

            <li class="has-subnav">
                <a href="<?php echo FRONT_ROOT ?>JobbOffer/ShowListView">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">
                        Mis propuestas
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="<?php echo FRONT_ROOT ?>JobOffer/">
                    <i class="fa fa-laptop fa-2x"></i>
                    <span class="nav-text">
                        Agregar propuesta
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="<?php echo FRONT_ROOT ?>Company/ShowCompany">
                    <i class="fa fa-list fa-2x"></i>
                    <span class="nav-text">
                        Mis Datos
                    </span>
                </a>

            </li>
        </div>

        <div class="menu-options-logout">
            <ul class="has-subnav">
                <li>
                    <a href="<?php echo FRONT_ROOT ?>Home/Logout">
                        <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text">
                            Logout
                        </span>
                    </a>
                </li>

            </ul>
        </div>
</nav>