<?php
require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <form action="<?php echo FRONT_ROOT . "Company/ModifyCompany/" . $company->getIdCompany(); ?>" method="POST" enctype="multipart/form-data">
               <div class="container">
                    <h3 class="mb-3">Ver Empresa</h3>
                    <h4 style="color: rgb(145, 39, 177)">
                         <?php
                         if (isset($usedCompanyEmail)) {
                              echo "Ya existe una empresa con ese email";
                         }
                         if (isset($uploadError)) {
                              echo "Hubo un error y la imagen no se subio";
                         }
                         if (isset($notImageError)) {
                              echo "El archivo seleccionado no es una imagen";
                         }
                         ?>
                    </h4>

                    <span>&nbsp;</span>
                    <div>
                         <input type="number" name="companyId" class="form-control form-control-ml" hidden value="<?php echo $company->getIdCompany(); ?>">
                         <div class="row">
                              <div class="col-lg-4">
                                   <label for="">Nombre</label>
                                   <input type="text" name="name" class="form-control form-control-ml" value="<?php echo $company->getName(); ?>">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Año de Fundacion</label>
                                   <input type="number" min="1900" max="2021" step="1" name="yearFoundantion" class="form-control form-control-ml" value="<?php echo $company->getYearFoundantion(); ?>">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Ciudad</label>
                                   <input type="text" name="city" class="form-control form-control-ml" value="<?php echo $company->getCity(); ?>">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Descripcion</label>
                                   <textarea type="text" name="description" class="form-control form-control-ml" value=""><?php echo $company->getDescription(); ?></textarea>
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Email</label>
                                   <input type="email" name="email" class="form-control form-control-ml" value="<?php echo $company->getEmail(); ?>">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Telefono</label>
                                   <input type="number" name="phoneNumber" class="form-control form-control-ml" value="<?php echo $company->getPhoneNumber(); ?>">
                              </div>


                              <div class="form-group">
                                   <label for="">Logo:</label>
                                   <img src="<?php echo FRONT_ROOT . UPLOADS_PATH . $company->getLogoFileName(); ?>" alt="Company-Logo" width="100" height="100">
                                   <input type="file" name="logo" required class="form-control-file">

                              </div>

                         </div>
                         <div class="row">
                              <div class="button-conteiner">
                                   <button type="submit" name="modify-company-button" class="btn btn-primary ml-auto d-block">Guardar</button>

                                   <a class="btn btn-primary btn-xl" href="<?php echo FRONT_ROOT . "Company/DeleteCompany/" . $company->getIdCompany(); ?>">Eliminar Empresa</a>
                              </div>

                         </div>
                    </div>
               </div>
          </form>
     </section>
</main>

<?php include('footer.php') ?>