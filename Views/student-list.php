<?php
require_once('nav.php');

?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <div class="conteiner-title-list">
               <h2 class="text-center">Listado de Alumnos</h2>
               </div>
               
               <table class="table table-hover">
                    <thead>
                         <th>Nombre</th>
                         <th>Apellido</th>
                         <th>Legajo</th>
                         <th>Carrera</th>
                         <th>Ver</th>

                    </thead>
                    <tbody>
                         <?php
                         if (isset($students)) {
                              foreach ($students as $student) {
                                   echo  "<tr>";
                                   echo  "<td>" . $student->getFirstName() . "</td>";
                                   echo  "<td>" . $student->getLastName() . "</td>";
                                   echo  "<td>" . $student->getFileNumber() . "</td>";
                                   if(isset($careers)){
                                        foreach($careers as $career){
                                             if($career->getCareerId() == $student->getCareerId()){
                                                  echo  "<td>" . $career->getDescription()  . "</td>";
                                                  $careerName = $career->getDescription();
                                             }
                                        }
                                   } 
                                   $studentId = $student->getStudentId();
                                   $careerName = $career->getDescription();
                                   
                                   echo "<td><a href=" . FRONT_ROOT . "Student/ShowStudent/". $studentId . ">+ info</a></td>";
                              }
                         }
                         ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>