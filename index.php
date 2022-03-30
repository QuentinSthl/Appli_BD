<?php
declare(strict_types=1);

session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
require_once 'vendor/autoload.php';

use Slim\App;
use Slim\Container;
use gamepedia\controllers\Seance1Controller;
use gamepedia\controllers\Seance2Controller;
use gamepedia\controllers\Seance3Controller;
use gamepedia\controllers\Seance4Controller;
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

DB::connection()->enableQueryLog();

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

//routes seance 3
$app->get('/Seance3', Seance3Controller::class . ':Accueil')->setName('Seance3Accueil');
$app->get('/Seance3/Q1', Seance3Controller::class . ':Question1')->setName('Seance3Q1');
$app->get('/Seance3/Q2', Seance3Controller::class . ':Question2')->setName('Seance3Q2');
$app->get('/Seance3/Q3', Seance3Controller::class . ':Question3')->setName('Seance3Q3');
$app->get('/Seance3/Q4', Seance3Controller::class . ':Question4')->setName('Seance3Q4');
$app->get('/Seance3/Q5', Seance3Controller::class . ':Question5')->setName('Seance3Q5');
$app->get('/Seance3/Q6', Seance3Controller::class . ':Question6')->setName('Seance3Q6');
$app->get('/Seance3/Q7', Seance3Controller::class . ':Question7')->setName('Seance3Q7');
$app->get('/Seance3/Q8', Seance3Controller::class . ':Question8')->setName('Seance3Q8');
$app->get('/Seance3/Q9', Seance3Controller::class . ':Question9')->setName('Seance3Q9');

//routes Seance 4
$app->get('/Seance4', Seance4Controller::class . ':Accueil')->setName('Seance4Accueil');
$app->get('/Seance4/Q1', Seance4Controller::class . ':Question1')->setName('Seance4Q1');
$app->get('/Seance4/Q2', Seance4Controller::class . ':Question2')->setName('Seance4Q2');
$app->get('/Seance4/Q3', Seance4Controller::class . ':Question3')->setName('Seance4Q3');
$app->get('/Seance4/Q4', Seance4Controller::class . ':Question4')->setName('Seance4Q4');
$app->get('/Seance4/Q5', Seance4Controller::class . ':Question5')->setName('Seance4Q5');
$app->get('/Seance4/Q6', Seance4Controller::class . ':Question6')->setName('Seance4Q6');
$app->get('/Seance4/Q7', Seance4Controller::class . ':Question7')->setName('Seance4Q7');
$app->get('/Seance4/Q8', Seance4Controller::class . ':Question8')->setName('Seance4Q8');
$app->get('/Seance4/Q9', Seance4Controller::class . ':Question9')->setName('Seance4Q9');


try {
	$app->run();
} catch (Throwable $e) {
	echo $e->getMessage();
}


