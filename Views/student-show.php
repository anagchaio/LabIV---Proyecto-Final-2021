<?php
    require_once('nav-shared.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <?php
                    if(isset($student))
                    {
                         echo  "<h2> Nombre: " . $student->getFirstName() ." " . $student->getLastName() . "</h2>";
                         echo  "<h4> DNI: " . $student->getDni() . "</h4>";
                         echo  "<h4> Genero: " . $student->getGender() . "</h4>";
                         echo  "<h4> Fecha Nacimiento: " . $student->getBirthDate() . "</h4>";
                         echo  "<h4> Legajo: " . $student->getFileNumber() . "</h4>";
                         echo  "<h4> Carrera: " . $career->getDescription() . "</h4>";
                         echo  "<h4> Email: " . $student->getEmail() . "</h4>";
                         echo  "<h4> Telefono: " . $student->getPhoneNumber() . "</h4>";
                    }
               ?>               
          </div>
     </section>
</main>