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

                   

                </thead>
                <tbody>
                    <?php
                    if (isset($jobOffers)) {
                        foreach ($jobOffers as $jobOffer) {
                            echo  "<tr>";
                            if(isset($careers)){
                                foreach($careers as $career){
                                     if($career->getCareerId() == $student->getCareerId()){
                                          echo  "<td>" . $career->getDescription()  . "</td>";
                                          $careerName = $career->getDescription();
                                     }
                                }
                           } 
                            echo  "<td>" . $jobOffer->getName() . "</td>";
                            echo  "<td>" . $jobOffer->getCity() . "</td>";
                            echo  "<td>" . $jobOffer->getDescription() . "</td>";
                            if(isset($careers)){
                                foreach($careers as $career){
                                     if($career->getCareerId() == $jobOffer->getCareerId()){
                                          echo  "<td>" . $career->getDescription()  . "</td>";
                                          $careerName = $career->getDescription();
                                     }
                                }
                           } 

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