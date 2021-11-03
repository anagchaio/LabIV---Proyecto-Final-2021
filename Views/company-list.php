<?php
require_once('nav-shared.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Lista de Empresas</h2>

            <form action="<?php echo FRONT_ROOT ?>Company/FilterList" method="POST" enctype="multipart/form-data">
                <input type="text" name="searchedWord" class="form-control form-control-ml" required value="">
                <div class="container">
                    <div class="row">
                        <button type="submit" class="btn btn-primary ml-auto d-block">Buscar</button>
                        <a class="btn btn-primary" href="<?php echo FRONT_ROOT ?>Company/ShowListView/">Limpiar</a>
                    </div>
                </div>
            </form>


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
                            echo "<td><a href=" . FRONT_ROOT . "Company/ShowCompany/" . $companyId . ">+ INFO</a></td>";
                        }
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </section>
</main>