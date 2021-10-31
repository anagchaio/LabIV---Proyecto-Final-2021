<?php

require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="POST" enctype="multipart/form-data">
               <div class="container">
                    <h3 class="mb-3">Agregar Nueva Oferta</h3>

                    <div>
                         <div class="row">
                              <div class="col-lg-4">
                                   <label for="">Empresa</label>
                                   <select name="companyId" required  class="form-control form-control-ml">
                                        <?php
                                        if (isset($companies)) {
                                             foreach ($companies as $company) {
                                                  echo "<option value=" . $company->getIdCompany() . ">" . $company->getName() . "</option>";
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
                                                  echo "<option value=" . $jobPosition->getJobPositionId() . ">" . $jobPosition->getDescription() . "</option>";
                                             }
                                        }
                                        ?>
                                   </select>
                              </div>
                              <div class="col-lg-4">
                                   <label for="">Descripción</label>
                                   <textarea type="text" name="jobOffer_description" maxlength="200" class="form-control form-control-ml" required value=""></textarea>
                              </div>
                              <div class="col-lg-4">
                                   <label for="">Limit date</label>
                                   <input type="date" name="limitDate" class="form-control form-control-ml" required value="">
                              </div>
                         </div>
                         <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
                    </div>
               </div>
          </form>
     </section>
</main>

<?php include('footer.php') ?>