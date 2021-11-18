<?php

require_once('nav.php');

?>
<main class="py-5">

    <div class="conteiner-card">
        <div class="card text-center " style="width: 40rem;">
            <div class="card-header">
                Oferta de trabajo
            </div>
            <div class="card-body">


                <section id="listado" class="mb-5">
                    <form action="<?php echo FRONT_ROOT ?>JobOffer/Update" method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <div class="container">
                            <!-- <h3 class="title">Oferta</h3> -->
                            <h4 style="color: rgb(145, 39, 177)">

                                <?php
                                if (isset($updateSuccess)) {
                                    echo "Los datos se guardaron correctamente";
                                }
                                if (isset($invalidDate)) {
                                    echo "La fecha limite no puede ser menor a la actual";
                                }
                                if (isset($closedOffer)) {
                                    echo "La oferta no puede ser modificada/eliminada una vez que esta cerrada";
                                }
                                ?>
                            </h4>
                            <input type="number" name="jobOfferId" class="form-control form-control-ml" hidden value="<?php echo $jobOffer->getJobOfferId(); ?>">
                            <div>
                                <div>
                                    <div class="form-group">
                                        <label for="">Empresa</label>
                                        <?php
                                        if ($jobOffer->getState() == "Opened" && $_SESSION['admin']) {
                                        ?>
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
                                        <?php
                                        } else {
                                        ?>
                                            <input readonly name="companyName" class="form-control form-control-ml" value=" <?php echo $jobOffer->getCompany_name(); ?>">
                                        <?php
                                        }
                                        ?>


                                    </div>
                                    <div class="form-group">
                                        <label for="">Puesto</label>

                                        <?php
                                        if ($jobOffer->getState() == "Opened") {
                                        ?>

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

                                        <?php
                                        } else {
                                        ?>
                                            <input readonly name="jobPositionDescription" class="form-control form-control-ml" value=" <?php echo $jobOffer->getJobPosition_description(); ?>">
                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="form-group">
                                        <label for="">Descripción</label>
                                        <?php
                                        if ($jobOffer->getState() == "Opened") {
                                        ?>
                                            <textarea type="text" name="jobOffer_description" maxlength="200" class="form-control form-control-ml" value=""><?php echo $jobOffer->getJobOffer_description(); ?></textarea>

                                        <?php
                                        } else {
                                        ?>
                                            <textarea readonly type="text" name="jobOffer_description" maxlength="200" class="form-control form-control-ml" value=""><?php echo $jobOffer->getJobOffer_description(); ?></textarea>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="form-group">
                                        <label for="">Fecha limite</label>
                                        <?php
                                        if ($jobOffer->getState() == "Opened") {
                                        ?>

                                            <input type="date" name="limitDate" class="form-control form-control-ml" value="<?php echo $jobOffer->getLimitDate(); ?>">

                                        <?php
                                        } else {
                                        ?>
                                            <input readonly type="date" name="limitDate" class="form-control form-control-ml" value="<?php echo $jobOffer->getLimitDate(); ?>">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Estado</label>
                                        <input readonly name="state" class="form-control form-control-ml" 
                                        value="<?php if ($jobOffer->getState() == "Opened") {
                                                echo "Abierta";
                                            } else {
                                                echo "Cerrada";
                                            } ?>">
                                            
                                    </div>

                                    <div class="form-group">
                                        <label for="">Inscriptos</label>

                                        <?php if ($jobOffer->getStudentList() == null) { ?>
                                            <input readonly type="text" name="student" class="form-control form-control-ml" value="Sin alumnos">
                                        <?php } else {  ?>
                                            <a class="form-control form-control-ml" href="<?php echo FRONT_ROOT . "JobOffer/ShowStudentList/" . $jobOffer->getJobOfferId(); ?>">Ver Listado</a>
                                        <?php }; ?>
                                    </div>

                                    <?php
                                    if ($jobOffer->getFlyer() != null) {
                                    ?>
                                        <div class="form-group">
                                            <label for="">Aviso:</label>
                                            <a class="form-control form-control-ml" target="_blank" 
                                            href="<?php if (isset($jobOffer)) {
                                                        echo FRONT_ROOT . UPLOADS_PATH . $jobOffer->getFlyer();
                                                    }; ?>">Ver Imagen</a>                                            
                                        </div>
                                        <div class="form-group">
                                            
                                        <?php if ($jobOffer->getState() == "Opened") {  ?>
                                            <label for="">Cambiar imagen:</label>
                                            <input type="file" name="flyer">
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <div>
                                        <div class="conteiner" style="margin-top:5vh">
                                            <?php
                                            if ($jobOffer->getState() == "Opened") {
                                            ?>
                                                <button type="submit" name="update-button" class="btn btn-primary btn-lg btn-block">Guardar</button>

                                                <a class="btn btn-primary btn-lg btn-block" href="
                                                <?php if (isset($jobOffer)) {
                                                    echo FRONT_ROOT . "JobOffer/Close/" . $jobOffer->getJobOfferId();
                                                }; ?>">Cerrar Oferta</a>

                                                <a class="btn btn-primary btn-lg btn-block" href="
                                                <?php if (isset($jobOffer)) {
                                                    echo FRONT_ROOT . "JobOffer/Delete/" . $jobOffer->getJobOfferId();
                                                }; ?>">Eliminar Oferta</a>

                                            <?php
                                            }
                                            ?>
                                             <!-- <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView/">Reporte PDF</a> -->
                                            <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView/">Volver</a>


                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </form>
                </section>


            </div>
            <div class="card-footer text-muted">

            </div>
        </div>
    </div>

</main>

<?php include('footer.php') ?>