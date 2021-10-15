<?php
    require_once('nav-shared.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
            <div>
               <img src="<?php echo FRONT_ROOT . UPLOADS_PATH . $company->getLogoFileName(); ?>" alt="Company-Logo" width="100" height="100">   
            </div>
            <?php
                    if(isset($company))
                    {
                         echo  "<h4> Nombre: " . $company->getName() . "</h4>";
                         echo  "<h4> Año de fundacion: " . $company->getYearFoundantion() . "</h4>";
                         echo  "<h4> Ciudad: " . $company->getCity() . "</h4>";
                         echo  "<h4> Descripcion: " . $company->getDescription() . "</h4>";
                         echo  "<h4> Email: " . $company->getEmail() . "</h4>";
                         echo  "<h4> Telefono: " . $company->getPhoneNumber() . "</h4>";
                         }
            ?>               
          </div>
     </section>
</main>