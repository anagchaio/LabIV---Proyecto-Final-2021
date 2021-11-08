<?php

use Models\JobOffer;

if (isset($_SESSION['admin'])) {
    require_once('nav.php');
} else {
    require_once('nav-student.php');
}
?>


<main class="py-5" style="margin-left:5vh">

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

                                    
                                    if(isset($student) && $career->getCareerId() == $student->getCareerId()){
                                        echo "<option selected value=" . $career->getCareerId() . ">" . $career->getDescription() . "</option>";
                                    } else {
                                        echo "<option value=" . $career->getCareerId() . ">" . $career->getDescription() . "</option>";
                                    }
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
            <?php
            
            if (isset($jobOffers) && $jobOffers != null) {
                
                echo "<thead>";
                echo " <th>Empresa</th>";
                echo " <th>Description</th>";
                echo " <th>Position</th>";
                echo " <th>Carrera</th>";
                echo " <th>Fecha limite</th>";
                echo " <th>Estado</th>";
                echo " <th>Ver</th>";
                echo " </thead>";
                echo " <tbody>";

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
            } else {
                echo "<h4>";
                echo "No hay ofertas para mostrar de esta carrera";
                echo "</h4>";
            
            }
            ?>
            </tbody>

            </table>
        </div>
    </section>
</main>