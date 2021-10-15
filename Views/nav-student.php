<nav class="main-menu">


<div class="menu-title">
    <a href="#">
        <i class="fa fa-home fa-2x"></i>
        <h3 class="title">HOME</h3>
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