<?php
require_once('nav-shared.php');

?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Ofertas</h2>
            <div class = "row">
            <form action="<?php echo FRONT_ROOT ?>JobOffer/FilterByCareer" method="GET">
                <label for="">Carrera: </label>
                <select name="careerId" class="form-control form-control-ml">
                    <?php
                     echo "<option value=". 0 .">Todas</option>";
                    if (isset($careers)) {
                        foreach ($careers as $career) {
                            echo "<option value=" . $career->getCareerId() . ">" . $career->getDescription() . "</option>";
                        }
                    }
                    ?>
                </select>
                <button type="submit" name="filter-button" class="btn btn-dark ml-auto d-block">Filtrar</button>
            </form>
            </div>

            <table class="table bg-dark-alpha">
                <thead>
                    <th>Empresa</th>
                    <th>Description</th>
                    <th>Position</th>
                    <th>Carrera</th>
                    <th>Fecha limite</th>
                    <th>Estado</th>
                    <th>Ver</th>
                </thead>
                <tbody>
                    <?php
                    if (isset($jobOffers)) {
                        foreach ($jobOffers as $jobOffer) {
                            echo  "<tr>";
                            echo  "<td>" . $jobOffer->getCompany_name() . "</td>";
                            echo  "<td>" . $jobOffer->getJobOffer_description() . "</td>";
                            echo  "<td>" . $jobOffer->getJobPosition_description() . "</td>";
                            echo  "<td>" . $jobOffer->getCareer_description() . "</td>";
                            echo  "<td>" . $jobOffer->getLimitDate() . "</td>";
                            echo  "<td>" . $jobOffer->getState() . "</td>";

                            $jobOfferId = $jobOffer->getJobOfferId();
                            echo "<td><a href=" . FRONT_ROOT . "JobOffer/ShowOffer/" . $jobOfferId . ">+ info</a></td>";
                        }
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </section>
</main>