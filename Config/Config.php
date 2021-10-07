<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
define("FRONT_ROOT", "http://localhost/TPFINAL/LabIV---Proyecto-Final-2021/");//David
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT . VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT . VIEWS_PATH . "js/");

define("DB_HOST", "localhost");
define("DB_NAME", "file_upload_example");
define("DB_USER", "root");
define("DB_PASS", "");

define("API_KEY", '4f3bceed-50ba-4461-a910-518598664c08');
define("API_URL", 'https://utn-students-api.herokuapp.com/api/');

define("ADMIN_ACCESS", "admin@admin.com");

?>