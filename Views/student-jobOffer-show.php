<?php

if (isset($_SESSION['admin'])) {
    require_once('nav.php');
} else {
    require_once('nav-student.php');
}
<<<<<<< HEAD
<<<<<<< HEAD
=======
?>
>>>>>>> master
=======
>>>>>>> a9614f2e1f0dc8872f7f1584f48156d64de56d46

?>

<div class="conteiner-card">
    <div class="card text-center " style="width: 40rem;">
        <div class="card-header">
            Oferta laboral
        </div>
        <div class="card-body">

            <section id="listado" class="mb-5">
                <form action="<?php echo FRONT_ROOT ?>JobOffer/Subscribe" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    <div class="container">
                        <h4 style="color: rgb(145, 39, 177)">
                            <?php
                            if (isset($SubscribeSuccess)) {
                                echo "Usted esta inscripto en la Oferta";
                            }
                            if (isset($SubscribeError)) {
                                echo "Error: Ya se encuentra inscripto en esta oferta.";
                            }
                            ?>
                        </h4>
                        <input type="number" name="jobOfferId" class="form-control form-control-ml" hidden value="<?php echo $jobOffer->getJobOfferId(); ?>">
                        <div>
                            <div>
                                <div class="form-group">
                                    <label for="">Empresa</label>
                                    <input readonly name="companyName" class="form-control form-control-ml" value=" <?php echo $jobOffer->getCompany_name(); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="">Puesto</label>
                                    <input readonly name="jobPositionDescription" class="form-control form-control-ml" value=" <?php echo $jobOffer->getJobPosition_description(); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="">Descripción</label>
                                    <textarea readonly type="text" name="jobOffer_description" maxlength="200" class="form-control form-control-ml" value=""><?php echo $jobOffer->getJobOffer_description(); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Fecha limite</label>
                                    <input readonly type="date" name="limitDate" class="form-control form-control-ml" value="<?php echo $jobOffer->getLimitDate(); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <input readonly name="state" class="form-control form-control-ml" 
                                    value="<?php if ($jobOffer->getState() == "Opened") {
                                    echo "Abierta";
                                    } else {
                                        echo "Cerrada";
                                    }?>">
                                
                                
                                </div>

                                <div class="form-group">
                                    <label for="">Inscriptos</label>
                                    <input readonly type="text" name="student" class="form-control form-control-ml" 
                                    value="<?php if ($jobOffer->getStudentList() != null) {
                                        echo  count($jobOffer->getStudentList()) . " alumno/s";
                                       
                                        if ($jobOffer->isStudentInJobOffer($studentId)) {
                                            echo " -  Usted está inscripto";
                                        }
                                    } else {
                                        echo "Sin alumnos";
                                    } ?>">





                                </div>

                                <div>
                                    <div class="conteiner" style="margin-top: 5vh;">

                                        <?php if ($jobOffer->getState() == "Opened" && !($jobOffer->isStudentInJobOffer($studentId))) {
                                        ?>
                                            <button type="submit" name="subscribe-button" class="btn btn-primary btn-lg btn-block">Inscribirse</button>
                                        <?php
                                        }
                                        ?>


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



<?php include('footer.php') ?>