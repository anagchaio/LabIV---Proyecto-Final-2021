<?php

require_once('nav.php');
?>



<div class="conteiner-card">
     <div class="card text-center " style="width: 40rem;">
          <div class="card-header">
               Empresa
          </div>
          <div class="card-body">


               <section id="listado" class="mb-5">
                    <form action="<?php echo FRONT_ROOT ?>Company/AddCompany" method="POST" enctype="multipart/form-data" class="form-horizontal">
                         <div class="container">
                              <h3 class="title" style="padding-bottom: 10px;">Nueva Empresa</h3>
                              <h4 style="color: rgb(145, 39, 177)">
                                   <?php
                                   if (isset($usedCompanyEmail)) {
                                        echo "Ya existe una empresa con ese email";
                                   }
                                   if (isset($yearNotValid)) {
                                        echo "El año debe ser menor o igual al actual";
                                   }
                                   if (isset($notImageError)) {
                                        echo "Hubo un error o el archivo seleccionado no es una imagen";
                                   }
                                   ?>
                              </h4>

                              <div>
                                   <div class="">
                                        <div class="form-group">
                                             <!-- <label for="">Nombre</label> -->
                                             <input type="text" name="companyName" class="form-control form-control-ml" required value="" placeholder="Nombre">
                                        </div>

                                        <div class="form-group">
                                             <!-- <label for="">Año de Fundacion</label> -->
                                             <input type="number" min="1900" step="1" name="yearFoundantion" class="form-control form-control-ml" required value="" placeholder="Año de fundación">
                                        </div>

                                        <div class="form-group">
                                             <!-- <label for="">Ciudad</label> -->
                                             <input type="text" name="city" class="form-control form-control-ml" required value="" placeholder="Ciudad">
                                        </div>

                                        <div class="form-group">
                                             <!-- <label for="">Email</label> -->
                                             <input type="email" name="email" class="form-control form-control-ml" required value="" placeholder="Email">
                                        </div>

                                        <div class="form-group">
                                             <!-- <label for="">Telefono</label> -->
                                             <input type="tel" name="phoneNumber" class="form-control form-control-ml" required value="" placeholder="Teléfono">
                                        </div>
                                        <div class="form-group">
                                             <!-- <label for="">Descripcion</label> -->
                                             <textarea type="text" name="description" maxlength="200" class="form-control form-control-ml" required value="" placeholder="Descripción"></textarea>
                                        </div>

                                        <div class="container">
                                             <div class="form-group" style="text-align: center;">
                                                  <label for="">Logo:</label>
                                                  <input type="file" name="logo" required class="form-control-file">

                                             </div>
                                        </div>
                                   </div>
                                   <button type="submit" name="button" class="btn btn-primary btn-lg btn-block">Agregar</button>
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