<?php
require_once('nav.php');

?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Alumnos</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Apellido</th>
                         <th>DNI</th>
                         <th>Genero</th>
                         <th>Fecha Nacimiento</th>
                         <th>Legajo</th>
                         <th>Carrera</th>
                         <th>Email</th>
                         <th>Telefono</th>
                    </thead>
                    <tbody>
                         <?php
                         if (isset($students)) {
                              foreach ($students as $student) {
                                   echo  "<tr>";
                                   echo  "<td>" . $student->getFirstName() . "</td>";
                                   echo  "<td>" . $student->getLastName() . "</td>";
                                   echo  "<td>" . $student->getDni() . "</td>";
                                   echo  "<td>" . $student->getGender() . "</td>";
                                   echo  "<td>" . $student->getBirthDate() . "</td>";
                                   echo  "<td>" . $student->getFileNumber() . "</td>";
                                   echo  "<td>" . $student->getCareerId() . "</td>";
                                   echo  "<td>" . $student->getEmail() . "</td>";
                                   echo  "<td>" . $student->getPhoneNumber() . "</td>";
                              }
                         }
                         ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>