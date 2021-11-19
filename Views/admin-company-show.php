<?php
if (isset($_SESSION['admin'])) {
     require_once('nav.php');
 } else if (isset($_SESSION['company'])) {
     require_once('nav-company.php');
 }
?>
<main class="py-5">
     <div class="conteiner-card">
          <div class="card text-center " style="width: 40rem;">
               <div class="card-header">
                    Empresa
               </div>
               <div class="card-body">

                    <section id="listado" class="mb-5">
                         <form action="<?php echo FRONT_ROOT . "Company/ModifyCompany/" ?>" method="POST" enctype="multipart/form-data">
                              <div class="container">
                                   <!-- <h3 class="mb-3">Ver Empresa</h3> -->
                                   <h4 style="color: rgb(145, 39, 177)">
                                        <?php
                                        if (isset($successMessage)) {
                                             echo "Los datos fueron modificados correctamente";
                                        }
                                        if (isset($usedCompanyEmail)) {
                                             echo "Ya existe una empresa con ese email";
                                        }
                                        if (isset($yearNotValid)) {
                                             echo "El año debe ser menor o igual al actual";
                                        }
                                        if (isset($notImageError)) {
                                             echo "Hubo un error o el archivo seleccionado no es una imagen";
                                        }
                                        if (isset($companyInUse)) {
                                             echo "La empresa posee ofertas y no puede ser eliminada";
                                        }
                                        ?>
                                   </h4>

                                   <span>&nbsp;</span>
                                   <div>
                                        <input type="number" name="companyId" class="form-control form-control-ml" hidden value="<?php if (isset($company)) {
                                                                                                                                       echo $company->getIdCompany();
                                                                                                                                  }; ?>">
                                        <div>
                                             <div class="form-group">
                                                  <!-- <label for="">Nombre</label> -->
                                                  <input type="text" name="companyName" class="form-control form-control-ml" value="<?php if (isset($company)) {
                                                                                                                                            echo $company->getName();
                                                                                                                                       };  ?>">
                                             </div>

                                             <div class="form-group">
                                                  <!-- <label for="">Año de Fundacion</label> -->
                                                  <input type="number" min="1900" step="1" name="yearFoundantion" class="form-control form-control-ml" value="<?php if (isset($company)) {
                                                                                                                                                                     echo $company->getYearFoundantion();
                                                                                                                                                                }; ?>">
                                             </div>

                                             <div class="form-group">
                                                  <!-- <label for="">Ciudad</label> -->
                                                  <input type="text" name="city" class="form-control form-control-ml" value="<?php if (isset($company)) {
                                                                                                                                  echo $company->getCity();
                                                                                                                             }; ?>">
                                             </div>


                                             <div class="form-group">
                                                  <!-- <label for="">Email</label> -->
                                                  <input type="email" name="email" class="form-control form-control-ml" value="<?php if (isset($company)) {
                                                                                                                                       echo $company->getEmail();
                                                                                                                                  }; ?>">
                                             </div>

                                             <div class="form-group">
                                                  <!-- <label for="">Telefono</label> -->
                                                  <input type="number" name="phoneNumber" class="form-control form-control-ml" value="<?php if (isset($company)) {
                                                                                                                                            echo $company->getPhoneNumber();
                                                                                                                                       }; ?>">
                                             </div>

                                             <div class="form-group">
                                                  <!-- <label for="">Descripcion</label> -->
                                                  <textarea type="text" name="description" class="form-control form-control-ml" value=""><?php if (isset($company)) {
                                                                                                                                                 echo $company->getDescription();
                                                                                                                                            }; ?></textarea>
                                             </div>

                                             <div class="form-group">
                                                  <!-- <label for="">Logo:</label> -->
                                                  <img src="<?php if (isset($company)) {
                                                                 echo FRONT_ROOT . UPLOADS_PATH . $company->getLogo();
                                                            }; ?>" alt="Company-Logo" width="100" height="100">
                                                  <input type="file" name="logo" class="form-control-file">

                                             </div>

                                        </div>
                                        <div>
                                             <div class="conteiner" style="margin-top:5vh">

                                                  <button type="submit" name="modify-company-button" class="btn btn-primary btn-lg btn-block">Guardar</button>

                                                  <?php if(isset($_SESSION['admin'])) { ?>
                                                  <a class="btn btn-primary btn-lg btn-block" href="<?php if (isset($company)) {
                                                                                                         echo FRONT_ROOT . "Company/DeleteCompany/" . $company->getIdCompany();
                                                                                                    }; ?>">Eliminar Empresa</a>
                                                  
                                                  <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>Company/ShowListView/">Volver a la Lista</a>
                                                  <?php } else if (isset($_SESSION['company'])){ ?>
                                                      
                                                       <a class="btn btn-primary btn-lg btn-block" href="<?php echo FRONT_ROOT ?>Home/RedirectHome/">Home</a>                                                  
                                                  <?php } ?>

                                             </div>

                                        </div>
                                   </div>
                              </div>
                         </form>
                    </section>



               </div>
               <div class="card-footer text-muted">

               </div>
          </div>
     </div>
</main>

<?php include('footer.php') ?>