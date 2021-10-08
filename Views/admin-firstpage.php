<?php 
    require_once(VIEWS_PATH.'nav.php');
    require_once(VIEWS_PATH."company-add.php");

    if (isset($newCompany)) {
        echo $newCompany->getName();
   }

?>