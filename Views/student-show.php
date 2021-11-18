<?php
if (isset($_SESSION['admin'])) {
     require_once('nav.php');
} else {
     require_once('nav-student.php');
}
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="conteiner-card">


               <div class="card-student" style="width: 30rem;">
                    <!-- <img src="../Views/img/bg.jpg" class="card-img-top" alt="..."> -->
                    <div class="card-body" style="text-align: left;">

                         <?php
                         if (isset($student)) {
                              echo  "<h3>" . $student->getFirstName() . " " . $student->getLastName() . "</h3> <br>";
                              echo  "<a> <b>DNI: </b>" . $student->getDni() . "</a> <br>";
                              echo  "<a> <b>Genero: </b>" . $student->getGender() . "</a> <br>";
                              echo  "<a> <b>Fecha Nacimiento: </b>" . $student->getBirthDate() . "</a> <br>";
                              echo  "<a> <b>Legajo: </b>" . $student->getFileNumber() . "</a> <br>";
                              echo  "<a> <b>Carrera: </b>" . $career->getDescription() . "</a> <br>";
                              echo  "<a> <b>Email: </b>" . $student->getEmail() . "</a> <br>";
                              echo  "<a> <b>Telefono: </b>" . $student->getPhoneNumber() . "</a> <br>";
                         }
                         ?>
                         <!-- <h5 class="card-title">Card title</h5>
                         <p class="card-text">Some quick example text </p> -->

                         <?php
                         if (isset($_SESSION['offerList']) && $_SESSION['offerList'] != NULL) {
                              $jobOfferId = $_SESSION['offerList'];
                              // var_dump($student->getStudentId());
                         ?>
                              <form action="<?php echo FRONT_ROOT ?>JobOffer/rejectAplication/" method="POST">

                                   <input type="text" value="<?php $jobOfferId ?>" name="jobOfferId" hidden>
                                   
                                   <input type="text" value="<?php $student->getStudentId() ?>" name="studentId" hidden>

                                   <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top: 5vh;">Rechazar</button>
                              </form>

                              <?php
                              // $jobOfferId = $_SESSION['offerList'];
                              $_SESSION['offerList'] = null;
                              ?>
                              <a href="<?php echo FRONT_ROOT . "JobOffer/ShowStudentList/" . $jobOfferId; ?>" class="btn btn-primary btn-lg btn-block" style="margin-top: 2vh;>Volver a la lista</a>
                         <?php
                         } else if (isset($_SESSION['admin'])) {
                         ?>
                              <a href="<?php echo FRONT_ROOT ?>Student/ShowListView" class="btn btn-primary btn-lg btn-block" style="margin-top: 5vh;">Volver a la lista</a>
                         <?php
                         } else if (isset($_SESSION['student'])) {
                         ?>
                              <a href="<?php echo FRONT_ROOT ?>Home/RedirectHome" class="btn btn-primary btn-lg btn-block" style="margin-top: 5vh;">Atrás</a>
                         <?php } ?>

                    </div>

               </div>

          </div>
     </section>
</main>