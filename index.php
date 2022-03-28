<?php
declare(strict_types=1);

session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
require_once 'vendor/autoload.php';

use Slim\App;
use Slim\Container;
use gamepedia\controllers\Seance1Controller;
use gamepedia\controllers\Seance2Controller;
use Illuminate\Database\Capsule\Manager as DB;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$configuration = [
	'settings' => [
		'displayErrorDetails' => true,
		'dbconf' => './src/conf/conf.ini']];

$c = new Container($configuration);
$app = new App($c);
$db = new DB();
$db->addConnection(parse_ini_file($configuration['settings']['dbconf']));
$db->setAsGlobal();
$db->bootEloquent();

//routes Seance 1
$app->get('/Seance1', Seance1Controller::class . ':Accueil')->setName('Seance1Accueil');
$app->get('/Seance1/Q1', Seance1Controller::class . ':Question1')->setName('Seance1Q1');
$app->get('/Seance1/Q2', Seance1Controller::class . ':Question2')->setName('Seance1Q2');
$app->get('/Seance1/Q3', Seance1Controller::class . ':Question3')->setName('Seance1Q3');
$app->get('/Seance1/Q4', Seance1Controller::class . ':Question4')->setName('Seance1Q4');
$app->get('/Seance1/Q5', Seance1Controller::class . ':Question5')->setName('Seance1Q5');


//routes Seance 2
$app->get('/Seance2', Seance2Controller::class . ':Accueil')->setName('Seance2Accueil');
$app->get('/Seance2/Q1', Seance2Controller::class . ':Question1')->setName('Seance2Q1');
$app->get('/Seance2/Q2', Seance2Controller::class . ':Question2')->setName('Seance2Q2');
$app->get('/Seance2/Q3', Seance2Controller::class . ':Question3')->setName('Seance2Q3');
$app->get('/Seance2/Q4', Seance2Controller::class . ':Question4')->setName('Seance2Q4');
$app->get('/Seance2/Q5', Seance2Controller::class . ':Question5')->setName('Seance2Q5');
$app->get('/Seance2/Q6', Seance2Controller::class . ':Question6')->setName('Seance2Q6');
$app->get('/Seance2/Q7', Seance2Controller::class . ':Question7')->setName('Seance2Q7');
$app->get('/Seance2/Q8', Seance2Controller::class . ':Question8')->setName('Seance2Q8');
$app->get('/Seance2/Q9', Seance2Controller::class . ':Question9')->setName('Seance2Q9');



try {
	$app->run();
} catch (Throwable $e) {
	echo $e->getMessage();
}

?>

