<?php

require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="POST" enctype="multipart/form-data">
               <div class="container">
                    <h3 class="mb-3">Add Job Offer</h3>

                    <div>
                         <div class="row">
                              <div class="col-lg-4">
                                   <label for="">ID</label>
                                   <input type="number" name="jobOfferId" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Descripción</label>
                                   <input type="text" name="jobOffer_description" maxlength ="200" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Limit date</label>
                                   <input type="date" name="limitDate" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">State</label>
                                   <textarea type="text" name="state"  class="form-control form-control-ml" required value=""></textarea>
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Company ID</label>
                                   <input type="number" name="companyId" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">ID Job Position</label>
                                   <input type="number" name="jobPositionId" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">User ID</label>
                                   <input type="number" name="userId" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Company Name</label>
                                   <input type="text" name="company_name" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Job position description</label>
                                   <input type="text" name="jobPosition_description" maxlength ="200" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Career description</label>
                                   <input type="text" name="career_description" maxlength ="200" class="form-control form-control-ml" required value="">
                              </div>
                              
                              <div class="col-lg-4">
                                   <label for="">Student ID</label>
                                   <input type="number" name="studentId" class="form-control form-control-ml" required value="">
                              </div>
                             
                         </div>
                         <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
                    </div>
               </div>
          </form>
     </section>
</main>

<?php include('footer.php') ?>