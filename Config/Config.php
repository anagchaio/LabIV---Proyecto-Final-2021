<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
define("FRONT_ROOT", "");
define("VIEWS_PATH", "Views/");
define("UPLOADS_PATH", "uploads/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");

define("DB_HOST", "localhost");
define("DB_NAME", "file_upload_example");
define("DB_USER", "root");
define("DB_PASS", "");

define("API_KEY", '4f3bceed-50ba-4461-a910-518598664c08');
define("API_URL", 'https://utn-students-api.herokuapp.com/api/');

?>