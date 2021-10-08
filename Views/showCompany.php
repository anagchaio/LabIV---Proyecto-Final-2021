<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
            <h2 class="mb-4">Empresa</h2>
               <?php
                    if(isset($company))
                    {
                         echo  "<h4> Nombre: " . $company->getName() . "</h4>";
                         echo  "<h4> Año de fundacion: " . $company->getYearFoundantion() . "</h4>";
                         echo  "<h4> Ciudad: " . $company->getCity() . "</h4>";
                         echo  "<h4> Descripcion: " . $company->getDescription() . "</h4>";
                         echo  "<h4> Logo: " . $company->getLogo() . "</h4>";
                         echo  "<h4> Email: " . $company->getEmail() . "</h4>";
                         echo  "<h4> Telefono: " . $company->getPhoneNumber() . "</h4>";
                         }
               ?>               
          </div>
     </section>
</main>