<?php

require_once('nav.php');
?>


<div class="conteiner-card">
     <div class="card text-center " style="width: 40rem;">
          <div class="card-header">
               Oferta laboral
          </div>
          <div class="card-body">


               <section id="listado" class="mb-5">
                    <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="POST" enctype="multipart/form-data" class="form-horizontal">
                         <div class="container">
                              <h3 class="title">Agregar Nueva Oferta</h3>
                              <h4 style="color: rgb(145, 39, 177)">
                                   <?php
                                   if (isset($invalidDate)) {
                                        echo "La fecha limite no puede ser menor a la actual";
                                   }
                                   ?>
                              </h4>
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

                                             <label class="text-center">Fecha límite</label>

                                             <input type="date" name="limitDate" class="form-control form-control-ml" required value="" placeholder="Tiempo de finalización">
                                        </div>
                                        <div class="form-group">
                                             <label>Flyer:</label>
                                             <input type="file" name="flyer" class="form-control-file">
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



<?php include('footer.php') ?>