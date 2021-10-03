<?php
    namespace Controllers;

    class HomeController
    {
        public function Index()
        {
            require_once("index.php");
        }

        public function Logout()
        {
            session_destroy();
            
            $this->Index();
        }
    }
?>