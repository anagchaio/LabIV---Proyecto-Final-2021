<?php
require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <form action="<?php echo FRONT_ROOT ?>Company/AddCompany" method="POST">
               <div class="container">
                    <h3 class="mb-3">Agregar Empresa</h3>
                    <h4 style="color: rgb(145, 39, 177)">
                         <?php
                         if (isset($usedCompanyName)) {
                              echo "Ya existe una empresa con ese nombre";
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
                                   <input type="number" min="1900" max="2021" step="1" name="yearFoundantion" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Ciudad</label>
                                   <input type="text" name="city" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Descripcion</label>
                                   <textarea type="text" name="description" class="form-control form-control-ml" required value=""></textarea>
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Logo</label>
                                   <input type="text" name="logo" class="form-control form-control-ml"  value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Email</label>
                                   <input type="email" name="email" class="form-control form-control-ml" required value="">
                              </div>

                              <div class="col-lg-4">
                                   <label for="">Telefono</label>
                                   <input type="number"  name="phoneNumber" class="form-control form-control-ml" required value="">
                              </div>

                             
                         </div>
                         <div class="row">
                              <div class="col-lg-4">
                                   <span>&nbsp;</span>
                                   <button type="submit" name="add-company-button" class="btn btn-primary ml-auto d-block">Agregar</button>
                              </div>

                         </div>
                    </div>
               </div>
          </form>
     </section>
</main>

<?php include('footer.php') ?>