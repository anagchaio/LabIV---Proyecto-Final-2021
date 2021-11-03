<?php

require_once('nav.php');

?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <form action="<?php echo FRONT_ROOT ?>JobOffer/Subscribe" method="POST" enctype="multipart/form-data">
            <div class="container">
                <h3 class="mb-3">Oferta</h3>
                <h4 style="color: rgb(145, 39, 177)">
                    <?php
                    if (isset($SubscribeSuccess)) {
                        echo "Usted esta inscripto en la Oferta";
                    }
                    if (isset($SubscribeError)) {
                        echo "Error: Ya se encuentra inscripto en otra oferta.";
                    }
                    ?>
                </h4>
                <input type="number" name="jobOfferId" class="form-control form-control-ml" hidden value="<?php echo $jobOffer->getJobOfferId(); ?>">
                <div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Empresa</label>
                            <input readonly name="companyName" class="form-control form-control-ml" value=" <?php echo $jobOffer->getCompany_name(); ?>">
                        </div>

                        <div class="col-lg-4">
                            <label for="">Puesto</label>
                            <input readonly name="jobPositionDescription" class="form-control form-control-ml" value=" <?php echo $jobOffer->getJobPosition_description(); ?>">
                        </div>

                        <div class="col-lg-4">
                            <label for="">Descripción</label>
                            <textarea readonly type="text" name="jobOffer_description" maxlength="200" class="form-control form-control-ml" value=""><?php echo $jobOffer->getJobOffer_description(); ?></textarea>
                        </div>

                        <div class="col-lg-4">
                            <label for="">Fecha limite</label>
                            <input readonly type="date" name="limitDate" class="form-control form-control-ml" value="<?php echo $jobOffer->getLimitDate(); ?>">
                        </div>

                        <div class="col-lg-4">
                            <label for="">Estado</label>
                            <input readonly name="state" class="form-control form-control-ml" value="
                                <?php if ($jobOffer->getState() == "Opened") {
                                    echo "Abierta";
                                } else {
                                    echo "Cerrada";
                                }
                                ?>">
                        </div>

                        <div class="col-lg-4">
                            <label for="">Alumno</label>
                            <input readonly type="text" name="student" class="form-control form-control-ml" value="
                            <?php
                            if ($jobOffer->getStudentId() != null) {
                                echo $student->getFirstName() . " " . $student->getLastName();
                            } else {
                                echo "Sin alumno";
                            }; ?>">
                        </div>

                        <div class="row">
                            <div class="button-conteiner">
                                <button type="submit" name="subscribe-button" class="btn btn-dark ml-auto d-block">Inscribirse</button>                                
                                <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView/">Volver</a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </form>
    </section>
</main>

<?php include('footer.php') ?>