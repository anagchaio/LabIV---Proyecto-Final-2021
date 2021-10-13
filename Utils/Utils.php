<?php 
namespace Utils;

class Utils {
    public static function checkSession(){
        if(!(isset($_SESSION['admin']) || isset($_SESSION['student']))){
            $userNotLogged = true;
            require_once(VIEWS_PATH ."index.php");
        }
    }
    public static function checkAdminSession(){
        if(!(isset($_SESSION['admin']))){
            $userNotAdmin = true;
            require_once(VIEWS_PATH ."index.php");
        } else {
            $adminLogged = true;
        }
    }

    public static function strStartsWith(String $haystack, String $needle){
        return $needle != '' && strncmp($haystack, $needle, strlen($needle)) == 0;
    }

}
