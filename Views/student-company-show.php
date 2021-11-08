
<?php
if (isset($_SESSION['admin'])) {
     require_once('nav.php');
} else {
     require_once('nav-student.php');
}
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="conteiner-card">


               <div class="card-student" style="width: 30rem;">
                    <!-- <img src="../Views/img/bg.jpg" class="card-img-top" alt="..."> -->
                    <div class="card-body" style="text-align: left;">

                        
                         <div class="text-center" style="margin-bottom: 5vh;">
                              <img src="<?php echo FRONT_ROOT . UPLOADS_PATH . $company->getLogo(); ?>" alt="Company-Logo" width="100" height="100">
                         </div>
                         <?php
                         if (isset($company)) {
                              echo  "<h4>" . $company->getName() . "</h4> </br>";
                              echo  "<a> <b>Año de fundacion: </b>" . $company->getYearFoundantion() . "</a></br>";
                              echo  "<a> <b>Ciudad: </b>" . $company->getCity() . "</a></br>";
                              echo  "<a> <b>Descripcion: </b>" . $company->getDescription() . "</a></br>";
                              echo  "<a> <b>Email: </b>" . $company->getEmail() . "</a></br>";
                              echo  "<a> <b>Telefono: </b>" . $company->getPhoneNumber() . "</a></br>";
                         }
                         ?>

                         <!-- <h5 class="card-title">Card title</h5>
                         <p class="card-text">Some quick example text </p> -->

                         <?php
                         if (isset($_SESSION['admin'])) {
                         ?>
                              <a href="<?php echo FRONT_ROOT ?>Student/ShowListView" class="btn btn-primary btn-lg btn-block" style="margin-top: 5vh;">Volver a la lista</a>
                         <?php
                         } else {
                         ?>
                              <a href="<?php echo FRONT_ROOT ?>Home/RedirectHome" class="btn btn-primary btn-lg btn-block" style="margin-top: 5vh;">Atrás</a>
                         <?php
                         }
                         ?>

                    </div>

               </div>

          </div>
     </section>
</main>