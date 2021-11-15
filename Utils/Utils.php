<?php 
namespace Utils;

class Utils {
    public static function checkSession(){
        if(!(isset($_SESSION['admin']) || isset($_SESSION['student']) || isset($_SESSION['company']))){
            $userNotLogged = true;
            require_once(VIEWS_PATH ."index.php");
        }
    }
    public static function checkAdminSession(){
        if(!(isset($_SESSION['admin']))){
            $userNotAdmin = true;
            require_once(VIEWS_PATH ."index.php");
        }
    }

    public static function checkAdminCompanySession(){
        if(!(isset($_SESSION['admin'])) || !(isset($_SESSION['company']))){
            $userNotAdmin = true;
            require_once(VIEWS_PATH ."index.php");
        }
    }

    public static function strStartsWith(String $haystack, String $needle){
        return $needle != '' && strncmp($haystack, $needle, strlen($needle)) == 0;
    }

    public static function UploadImage($image)
    {
        $uploadSuccess = false;
        $fileName = $image["name"];
        $tempFileName = $image["tmp_name"];
        $type = $image["type"];

        $filePath = UPLOADS_PATH . basename($fileName);

        if (in_array($type, IMAGES_TYPE)) {
            if (move_uploaded_file($tempFileName, $filePath)) {
                $uploadSuccess = true;
            } else {
                $uploadError = true;
            }
        } else {
            $notImageError = true;
        }
        return $uploadSuccess;
    }

}
