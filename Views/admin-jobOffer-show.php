<?php

require_once('nav.php');

?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <form action="<?php echo FRONT_ROOT ?>JobOffer/Update" method="POST" enctype="multipart/form-data">
            <div class="container">
                <h3 class="mb-3">Oferta</h3>

                <div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Empresa</label>
                            <select name="companyId" class="form-control form-control-ml">
                                <?php

                                if (isset($companies)) {
                                    foreach ($companies as $company) {

                                        if ($company->getIdCompany()  == $jobOffer->getCompanyId()) {
                                            echo "<option selected=" . "selected" . " value=" . $company->getIdCompany() . ">" . $company->getName() . "</option>";
                                        } else {
                                            echo "<option  value=" . $company->getIdCompany() . ">" . $company->getName() . "</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Puesto</label>
                            <select name="jobPositionId" class="form-control form-control-ml">
                                <?php
                                if (isset($jobPositions)) {
                                    foreach ($jobPositions as $jobPosition) {
                                        if ($jobPosition->getJobPositionId()  == $jobOffer->getJobPositionId()) {
                                            echo "<option selected=" . "selected" . " value=" . $jobPosition->getJobPositionId() . ">" . $jobPosition->getDescription() . "</option>";
                                        }
                                        echo "<option value=" . $jobPosition->getJobPositionId() . ">" . $jobPosition->getDescription() . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Descripción</label>
                            <textarea type="text" name="jobOffer_description" maxlength="200" class="form-control form-control-ml" value=""><?php echo $jobOffer->getJobOffer_description(); ?></textarea>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Fecha limite</label>
                            <input type="date" name="limitDate" class="form-control form-control-ml" value="<?php echo $jobOffer->getLimitDate(); ?>">
                        </div>
                        <div class="col-lg-4">
                            <label for="">Estado</label>
                            <select name="state" class="form-control form-control-ml">
                                <?php if($jobOffer->getState() == "Opened"){
                                    echo "<option selected=". "selected". " value="."Opened". ">Abierta</option>";
                                    echo "<option value="."Closed". ">Cerrada</option>";
                                } else {
                                    echo "<option value="."Opened". ">Abierta</option>";
                                    echo "<option selected=". "selected". " value="."Closed". ">Cerrada</option>";
                                }                              
                                ?>
                            </select>
                        </div>

                        <div class="col-lg-4">
                            <label for="">Alumno</label>
                            <input readonly type="text" name="student" class="form-control form-control-ml" value="
                            <?php
                            if ($student != null) {
                                echo $student->getFirstName() . " " . $student->getLastName();
                            } else {
                                echo "Sin alumno";
                            };?>">
                        </div>

                        <button type="submit" name="update-button" class="btn btn-dark ml-auto d-block">Guardar</button>
                    </div>

                </div>

            </div>

        </form>
    </section>
</main>

<?php include('footer.php') ?>