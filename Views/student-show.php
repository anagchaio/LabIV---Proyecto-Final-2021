<?php
require_once('nav-shared.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="conteiner-card">


               <div class="card" style="width: 18rem;">
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
                         <a href="<?php echo FRONT_ROOT ?>Student/ShowListView" class="btn btn-primary btn-lg btn-block" style="margin-top: 5vh;">Volver a la lista</a>

                    </div>

               </div>

          </div>
     </section>
</main>