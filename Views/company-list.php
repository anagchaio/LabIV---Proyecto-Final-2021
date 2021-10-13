<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Lista de Empresas</h2>
            <div class="container">
            <form action="<?php echo FRONT_ROOT ?>Company/FilterList" method="POST" enctype="multipart/form-data">
                    <input type="text" name="searchedWord" class="form-control form-control-ml" required value="">
                    <span>&nbsp;</span>
                    <button type="submit" name="search" class="btn btn-dark ml-auto d-block">Buscar</button>
            </form>
            </div>
            <span>&nbsp;</span>
            <div class="container">
            <form action="<?php echo FRONT_ROOT ?>Company/ShowListView" method="GET" enctype="multipart/form-data">
                <button type="submit" name="clean-Search" class="btn btn-dark ml-auto d-block">Limpiar</button>
            </form>
            </div>

            <table class="table bg-light-alpha">
                <thead>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Descripcion</th>

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
                            echo "<td><a href=" . FRONT_ROOT . "Company/ShowCompany/" . $companyId . ">Ver</a></td>";
                        }
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </section>
</main>