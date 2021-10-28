<?php
require_once('nav-shared.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Ofertas</h2>


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
                            echo  "<td>" . $jobOffer->getCompanyName() . "</td>";
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