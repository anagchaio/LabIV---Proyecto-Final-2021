<?php
if (isset($_SESSION['admin'])) {
     require_once('nav.php');
 } else {
     require_once('nav-company.php');
 }
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
                                   if (isset($DBerror)) {
                                        echo "Error: No se puede acceder a la base de datos. Intente mas tarde.";
                                   }
                                   ?>
                              </h4>
                              <div>
                                   <div class="">
                                        <div class="form-group">
                                             <!-- <label for="">Empresa</label> -->
                                             <!-- <label for="empresa001" class="col-sm-2 control-label">Empresa</label> -->

                                             <?php if (isset($_SESSION['admin'])) { ?>                                        
                                              
                                             <select name="companyId"  class="form-control form-control-ml" required>
                                                  <option style="color:grey" required hidden selected value="<?php echo null; ?>">Empresa</option>

                                                  <?php
                                                  if (isset($companies)) {
                                                       foreach ($companies as $company) {
                                                            echo "<option required value=" . $company->getIdCompany() . ">" . $company->getName() . "</option>";
                                                       }
                                                  }                                                  
                                                  ?>
                                             </select>
                                             <input hidden name="companyName" class="form-control form-control-ml" value="null">

                                             <?php } else if (isset($_SESSION['company'])){ ?>
                                                  <input hidden name="companyId" class="form-control form-control-ml" value=" <?php echo $_SESSION['company']->getCompanyId(); ?>">
                                                  <input readonly name="companyName" class="form-control form-control-ml" value=" <?php echo $_SESSION['company']->getName(); ?>">
                                             <?php } ?>
                                        </div>
                                        <div class="form-group">
                                             <!-- <label for="">Puesto</label> -->
                                             <select required name="jobPositionId" class="form-control form-control-ml" >
                                                  <option hidden selected style="color:gray" value="<?php echo null; ?>">Puesto</option>

                                                  <?php
                                                  if (isset($jobPositions)) {
                                                       foreach ($jobPositions as $jobPosition) {
                                                            echo "<option required value=" . $jobPosition->getJobPositionId() . ">" . $jobPosition->getDescription() . "</option>";
                                                       }
                                                  }
                                                  ?>
                                             </select>
                                        </div>
                                        <div class="form-group">
                                             <!-- <label for="">Descripci??n</label> -->
                                             <textarea type="text" name="jobOffer_description" maxlength="200" class="form-control form-control-ml" required value="" placeholder="Descripci??n"></textarea>
                                        </div>
                                        <div class="form-group">

                                             <label class="text-center">Fecha l??mite</label>

                                             <input type="date" name="limitDate" class="form-control form-control-ml" required value="" placeholder="Tiempo de finalizaci??n">
                                        </div>
                                        <div class="form-group">
                                             <label>Flyer:</label>
                                             <input required type="file" name="flyer" class="form-control-file">
                                        </div>

                                   </div>
                                   <button type="submit" name="button" class="btn btn-primary btn-lg btn-block" style="margin-top: 5vh;">Agregar</button>
                                                                      
                                   <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>Home/RedirectHome/">Volver</a>

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