<?php
    require_once('nav.php');
?>
<<<<<<< HEAD
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Lista de Empresas</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Descripcion</th>

                </thead>
                <tbody>
                    <?php
                        if(isset($companies)){
                            foreach($companies as $company){
                                echo  "<tr>";
                                echo  "<td>" . $company->getName() . "</td>";
                                echo  "<td>" . $company->getCity() . "</td>";
                                echo  "<td>" . $company->getDescription() . "</td>";
    
                                $companyId = $company->getIdCompany();
                                echo "<td><a href=" . FRONT_ROOT . "Company/ShowCompany/". $companyId .">Ver</a></td>";
                            }
                        }
                    ?>
                </tbody>

            </table>
        </div>
    </section>
</main>
=======
>>>>>>> prueba
