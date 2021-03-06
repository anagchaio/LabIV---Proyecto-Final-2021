<?php
if (isset($_SESSION['admin'])) {
    require_once('nav.php');
} else {
    require_once('nav-student.php');
}
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Lista de Empresas</h2>
            
            <div class="flex">
                <div class="form-group-input">
                    <form action="<?php echo FRONT_ROOT ?>Company/FilterList" method="POST" enctype="multipart/form-data" >
                        <input type="text" name="searchedWord" class="form-control" required value="" placeholder="Buscador" style="width: 130vh;">
                        <!-- <div class="container"> -->
                </div>
                <!-- <div class="row"> -->
                <div style="margin-left: 103vh;">
                    <button type="submit" class="btn btn-primary ml-auto d-block">Buscar</button>
                </div>
                <div>
                    <a class="btn btn-primary" href="<?php echo FRONT_ROOT ?>Company/ShowListView/">Limpiar</a>
                </div>
                </form>
            </div>


            <table class="table bg-dark-alpha">
                <thead>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Descripcion</th>
                    <th>Ver</th>

                </thead>
                <tbody>
                    <?php
                    if (isset($companies)) {
                        foreach ($companies as $company) {
                            echo  "<tr>";
                            echo  "<td>" . $company->getName() . "</td>";
                            echo  "<td>" . $company->getCity() . "</td>";
                            echo  "<td>" . $company->getDescription() . "</td>";

                            $companyId = $company->getIdCompany();
                            echo "<td><a href=" . FRONT_ROOT . "Company/ShowCompany/" . $companyId . ">+ info</a></td>";
                        }
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </section>
</main>