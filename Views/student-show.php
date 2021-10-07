<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Mostrando Alumno</h2>

               <?php
                    if(isset($student))
                    {
                         echo  "<h4> Nombre: " . $student->getFirstName() . "</h4>";
                         echo  "<h4> Apellido: " . $student->getLastName() . "</h4>";
                         echo  "<h4> DNI: " . $student->getDni() . "</h4>";
                         echo  "<h4> Genero: " . $student->getGender() . "</h4>";
                         echo  "<h4> Fecha Nacimiento: " . $student->getBirthDate() . "</h4>";
                         echo  "<h4> Legajo: " . $student->getFileNumber() . "</h4>";
                         echo  "<h4> Carrera: " . $student->getCareerId() . "</h4>";
                         echo  "<h4> Email: " . $student->getEmail() . "</h4>";
                         echo  "<h4> Telefono: " . $student->getPhoneNumber() . "</h4>";
                    }
               ?>               
          </div>
     </section>
</main>