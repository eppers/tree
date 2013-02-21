<?php 
/*
 * Dodać do bazy tabelę GrupyWiadomości (User - > has many Grupy ; Grupy - > has many Wiadomości)
 * Tabela grupy zawiera Id gr , id user, title
 */

session_start();
//$_SESSION['user_id']=1;

require './lib/Slim/Slim.php';
require './lib/database_class.php';
require './lib/Admin_class.php';
require './lib/Slim/LogWriter.php';
require './lib/twigView_class.php';
require_once './lib/Twig/Autoloader.php';
require './lib/Paris/idiorm.php';
require './lib/Paris/paris.php';

//require 'conf.php';

// Models

require './models/Site.php';
require './models/Slider.php';
require './models/Program.php';
require './models/Pakiet.php';



Twig_Autoloader::register();
$app = new Slim(array(
    'view' => 'twigView',
    'debug' => true,
    'log.enabled' => true,
    'templates.path' => './template',
    'log.writer' => new LogWriter()
    
));

$admin = new Admin();
$admin->app=$app;

require './app/routes/session.php';
require './app/routes/user.php';
require './app/routes/admin.php';

$app->run();

?>


