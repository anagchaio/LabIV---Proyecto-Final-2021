<?php
require_once('nav-shared.php');
?>

<div class="conteiner-card">
     <div class="card text-center " style="width: 40rem;">
          <div class="card-header">
               Empresa
          </div>
          <div class="card-body">


               <section id="listado" class="mb-5">
                    <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="POST" enctype="multipart/form-data" class="form-horizontal">
                         <div class="container">

                              <div>
                                   <div class="">
                                        <div class="form-group">
                                             <!-- <label for="">Empresa</label> -->
                                             <!-- <label for="empresa001" class="col-sm-2 control-label">Empresa</label> -->


                                             <select name="companyId" required class="form-control form-control-ml">
                                                  <option style="color:grey" hidden selected>Empresa</option>

                                                  <?php
                                                  if (isset($companies)) {
                                                       foreach ($companies as $company) {
                                                            echo "<option value=" . $company->getIdCompany() . ">" . $company->getName() . "</option>";
                                                       }
                                                  }
                                                  ?>
                                             </select>

                                        </div>
                                        <div class="form-group">
                                             <!-- <label for="">Puesto</label> -->
                                             <select name="jobPositionId" class="form-control form-control-ml">
                                                  <option hidden selected style="color:gray">Puesto</option>

                                                  <?php
                                                  if (isset($jobPositions)) {
                                                       foreach ($jobPositions as $jobPosition) {
                                                            echo "<option value=" . $jobPosition->getJobPositionId() . ">" . $jobPosition->getDescription() . "</option>";
                                                       }
                                                  }
                                                  ?>
                                             </select>
                                        </div>
                                        <div class="form-group">
                                             <!-- <label for="">Descripción</label> -->
                                             <textarea type="text" name="jobOffer_description" maxlength="200" class="form-control form-control-ml" required value="" placeholder="Descripción"></textarea>
                                        </div>
                                        <div class="form-group">
                                             <label class="text-center">Limit date</label>
                                             <input type="date" name="limitDate" class="form-control form-control-ml" required value="" placeholder="Tiempo de finalización">
                                        </div>
                                   </div>
                                   <button type="submit" name="button" class="btn btn-primary btn-lg btn-block" style="margin-top: 5vh;">Agregar</button>
                                   <!-- <a class="btn btn-primary btn-lg btn-block" href="<?php if (isset($jobOffer)) {
                                                                                          echo FRONT_ROOT . "JobOffer/deleteByBD/" . $jobOffer->getJobOfferId();
                                                                                     }; ?>">Eliminar</a> -->

                              </div>
                         </div>

                    </form>
               </section>


          </div>
          <div class="card-footer text-muted">

          </div>
     </div>
</div>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="conteiner-card">


               <div class="card-student" style="width: 30rem;">
                    <!-- <img src="../Views/img/bg.jpg" class="card-img-top" alt="..."> -->
                    <div class="card-body" style="text-align: left;">

                         <?php
                         if (isset($jobOffer)) {
                              echo  "<h3>" . $jobOffer->getJobOfferId() . " " . $jobOffer->getJobPosition_description() . "</h3> <br>";
                            //   echo  "<a> <b>DNI: </b>" . $student->getDni() . "</a> <br>";
                            //   echo  "<a> <b>Genero: </b>" . $student->getGender() . "</a> <br>";
                            //   echo  "<a> <b>Fecha Nacimiento: </b>" . $student->getBirthDate() . "</a> <br>";
                            //   echo  "<a> <b>Legajo: </b>" . $student->getFileNumber() . "</a> <br>";
                            //   echo  "<a> <b>Carrera: </b>" . $career->getDescription() . "</a> <br>";
                            //   echo  "<a> <b>Email: </b>" . $student->getEmail() . "</a> <br>";
                            //   echo  "<a> <b>Telefono: </b>" . $student->getPhoneNumber() . "</a> <br>";

                            // echo "<a><br> </br> </a><br>"

                            //   private $jobOfferId;
                            //   private $jobOffer_description;
                            //   private $limitDate;
                            //   private $state;
                            //   private $companyId;
                            //   private $jobPositionId;
                            //   private $userId;
                            //   private $company_name;
                            //   private $jobPosition_description;
                            //   private $career_description;
                            //   private $studentId;
                         }
                         ?>
                         <!-- <h5 class="card-title">Card title</h5>
                         <p class="card-text">Some quick example text </p> -->

                         <?php
                         if (isset($_SESSION['admin'])) {
                         ?>
                              <a href="<?php echo FRONT_ROOT ?>Student/ShowListView" class="btn btn-primary btn-lg btn-block" style="margin-top: 5vh;">Volver a la lista</a>
                         <?php
                         } else {
                         ?>
                              <a href="<?php echo FRONT_ROOT ?>Home/RedirectHome" class="btn btn-primary btn-lg btn-block" style="margin-top: 5vh;">Atrás</a>
                         <?php
                         }
                         ?>

                    </div>

               </div>

          </div>
     </section>
</main>