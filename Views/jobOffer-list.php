<?php
require_once('nav-shared.php');

?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Ofertas</h2>
            <div class="flex">
                <div class="form-group-input">

                    <form action="<?php echo FRONT_ROOT ?>JobOffer/FilterByCareer" method="GET">
                        <select name="careerId" class="form-control form-control-ml" style="width: 130vh;">
                            <?php
                            echo "<option value=" . 0 . ">Todas</option>";
                            if (isset($careers)) {
                                foreach ($careers as $career) {
                                    echo "<option value=" . $career->getCareerId() . ">" . $career->getDescription() . "</option>";
                                }
                            }
                            ?>
                        </select>

                </div>
                <div style="margin-left: 103vh;">
                    <button type="submit" name="filter-button" class="btn btn-primary">Filtrar</button>
                </div>

                </form>
            </div>

            <table class="table table-hover">
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