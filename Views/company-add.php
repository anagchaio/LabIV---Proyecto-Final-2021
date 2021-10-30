<?php

require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <form action="<?php echo FRONT_ROOT ?>Company/AddCompany" method="POST" enctype="multipart/form-data">
               <div class="container">
                    <h3 class="mb-3">Agregar Empresa</h3>
                    <h4 style="color: rgb(145, 39, 177)">
                         <?php
                         if (isset($usedCompanyEmail)) {
                              echo "Ya existe una empresa con ese email";
                         }
                         if (isset($yearNotValid)) {
                              echo "El año debe ser menor o igual al actual";
                         }
                         if (isset($uploadError)) {
                              echo "Hubo un error y la imagen no se subio";
                         }
                         if (isset($notImageError)) {
                              echo "El archivo seleccionado no es una imagen";
                         }
                         ?>
                    </h4>

                    <div>
                         <div class="row">
                              <div class="col-lg-4">
                                   <label for="">Nombre</label>
                                   <input type="text" name="name" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Año de Fundacion</label>
                                   <input type="number" min="1900" step="1" name="yearFoundantion" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Ciudad</label>
                                   <input type="text" name="city" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Descripcion</label>
                                   <textarea type="text" name="description" maxlength ="200" class="form-control form-control-ml" required value=""></textarea>
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Email</label>
                                   <input type="email" name="email" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Telefono</label>
                                   <input type="tel" name="phoneNumber" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="container">
                                   <div class="row">
                                        <div class="col-lg-4">
                                             <div class="form-group">
                                                  <label for="">Logo:</label>
                                                  <input type="file" name="logo" required class="form-control-file">
                                                  
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
                    </div>
               </div>
          </form>
     </section>
</main>

<?php include('footer.php') ?>