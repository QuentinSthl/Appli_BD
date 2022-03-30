<?php

namespace gamepedia\views;

use gamepedia\models\game;
use gamepedia\models\company;
use gamepedia\models\gamerating;
use gamepedia\models\platform;
use gamepedia\models\character;
use gamepedia\models\ratingboard;
use gamepedia\models\genre;
use Slim\Container;
use Illuminate\Database\Capsule\Manager as DB;

//define('SCRIPT_ROOT', str_replace(dirname(getcwd()) . DIRECTORY_SEPARATOR, (((!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/')), getcwd()));
define('SCRIPT_ROOT', "localhost");
class Seance3DisplayViews {
    public array $tab;
    public Container $container;

    function __construct(array $tab, Container $container) {
        $this->tab = $tab;
        $this->container = $container;
    }

    function render($selecteur): string {
        $content = "";
        switch ($selecteur) {

            case 0 :
            {
                $content = $this->htmlAccueil();
                break;
            }
            case 1 :
            {
                $content = $this->htmlQuestion1();
                break;
            }
            case 2 :
            {
                $content = $this->htmlQuestion2();
                break;
            }
            case 3 :
            {
                $content = $this->htmlQuestion3();
                break;
            }
            case 4 :
            {
                $content = $this->htmlQuestion4();
                break;
            }
            case 5 :
            {
                $content = $this->htmlQuestion5();
                break;
            }
            case 6 :
            {
                $content = $this->htmlQuestion6();
                break;
            }
            case 7 :
            {
                $content = $this->htmlQuestion7();
                break;
            }
            case 8 :
            {
                $content = $this->htmlQuestion8();
                break;
            }
            case 9 :
            {
                $content = $this->htmlQuestion9();
                break;
            }
        }
        return <<<END
			<!DOCTYPE html>
			<html lang='fr'>
				<head>
				    <meta charset='UTF-8'>
				    <title>TD BDD</title>
				</head>
			
				<body>
					<div class='content'>$content</div>
				</body>
			</html>
		END;
    }

    function htmlAccueil(): string {
        $content = '<a href="Seance3/Q1">Question 1</a>';
        return $content;
    }

    function htmlQuestion1(): string {
        $content = '<a href="/Seance3">Accueil</a><br>';
        $content .= '<a href="/Seance3/Q2">Question 2</a>';
        $content .= '<h1> Q1: Lister l\'ensemble des jeux</h1>';
        $debut = microtime(true);
        $games = game::all();
        $fin = microtime(true);
        $content .= '<p>Temps d\'execution : ' . ($fin - $debut) . ' secondes</p>';
        $content .= "<br><ul>";
        foreach ($games as $game){

            $content .= "<li>nom :$game->name</li>";
        }
        $content .='</ul>';

        return $content;
    }

    function htmlQuestion2(): string {
        $content = '<a href="/Seance3">Accueil</a><br>';
        $content .= '<a href="/Seance3/Q3">Question 3</a>';
        $content .= '<h1> Q2: les jeux dont le nom (du jeu) débute par \'Mario\'</h1>';
        $debut = microtime(true);
        $games = game::select('*')->where('name','like','Mario%')->get();
        $fin = microtime(true);
        $nbgames = count($games);
        $content .= '<p>Temps d\'execution : ' . ($fin - $debut) . ' secondes</p>';
        $content .= '<p>Nombre de jeux : ' . $nbgames . '</p>';
        $content .= "<br><ul>";
        foreach ($games as $game) {
            $content .= "<li>Jeu : $game->name</li>";
        }
        $content .='</ul>';

        return $content;
    }

    function htmlQuestion3(): string {
        $content = '<a href="/Seance3">Accueil</a><br>';
        $content .= '<a href="/Seance3/Q4">Question 4</a>';
        $content .= '<h1> Q3: les personnages des jeux dont le nom (du jeu) débute par \'Mario\'</h1>';
        $debut = microtime(true);
        $games = game::select('*')->where('name','like','Mario%')->get();
        $fin = microtime(true);
        //new p for time
        $content .= '<p>Temps d\'execution : ' . ($fin - $debut) . ' secondes</p>';
        $nbgames = count($games);
        //new p for nb games
        $content .= '<p>Nombre de jeux : ' . $nbgames . '</p>';
        $nbpersos = 0;
        $content .= "<br><ul>";
        foreach ($games as $game) {
            $name = $game['name'];
            $characters = $game->characters;
            $content .= "<li>Jeu : $name</li>";
            $content .= '<ul>';
            foreach ($characters as $character){
                $cname = $character['name'];
                $content .= "<li>Personnage :$cname</li>";
                $nbpersos++;
            }
            $content .='</ul>';

        };
        $content .='</ul>';
        //new p for nb persos
        $content .= '<p>Nombre de personnages : ' . $nbpersos . '</p>';

        return $content;
    }

    function htmlQuestion4(): string
    {
        $content = '<a href="/Seance3">Accueil</a><br>';
        $content .= '<a href="/Seance3/Q5">Question 5</a>';
        $content .= '<h1> Q4: les jeux dont le nom débute par Mario et dont le rating initial contient "3+"</h1>';
        $debut = microtime(true);
        //get games with name starting with Mario and with rating 3+ using where and whereHas
        $games = game::where('name','like','Mario%')->whereHas('gamerating',function($query){
            $query->where('name','like','%3+%');
        })->get();

        $fin = microtime(true);
        //new p for time
        $content .= '<p>Temps d\'execution : ' . ($fin - $debut) . ' secondes</p>';
        $nbgames = count($games);
        //new p for nb games
        $content .= '<p>Nombre de jeux : ' . $nbgames . '</p>';
        $content .= "<br><ul>";
        foreach ($games as $game) {
            $content .= "<li>Jeu : $game->name</li>";
        }
        $content .='</ul>';

        return $content;
    }
    function htmlQuestion5(): string {
        $content = '<a href="/Seance3/">Accueil</a><br>';
        $content .= '<a href="/Seance3/Q6">Question 6</a>';
        $content .= '<h1> Q5: Etudier la requête : "lister les jeux dont le nom débute par \'<valeur>\'  <br> 1. mesurer son temps d\'exécution avec 3 valeurs différentes,<br>
 2. créer un index sur la colonne \'name\' de la table \'game\',<br>
3. mesurer à nouveau le temps d\'exécution avec 3 nouvelles valeurs</h1>';
        $debut1 = microtime(true);
        $games = Game::select('*')->where('name','like','Mario%')->get();
        $fin1 = microtime(true);
        $nbgames1 = count($games);


        $debut2 = microtime(true);
        $games = Game::select('*')->where('name','like','Call%')->get();
        $fin2 = microtime(true);
        $nbgames2 = count($games);

        $debut3 = microtime(true);
        $games = Game::select('*')->where('name','like','League%')->get();
        $fin3 = microtime(true);
        $nbgames3 = count($games);


        $content .= '<p>Premiere valeur = Mario</p>';
        $content .= '<p>Temps d\'execution : ' . ($fin1 - $debut1) . ' secondes</p>';
        $content .= '<p>Nombre de jeux : ' . $nbgames1 . '</p>';
        $content .= '<p>Deuxieme valeur = Call</p>';
        $content .= '<p>Temps d\'execution : ' . ($fin2 - $debut2) . ' secondes</p>';
        $content .= '<p>Nombre de jeux : ' . $nbgames2 . '</p>';
        $content .= '<p>Troisieme valeur = League</p>';
        $content .= '<p>Temps d\'execution : ' . ($fin3 - $debut3) . ' secondes</p>';
        $content .= '<p>Nombre de jeux : ' . $nbgames3 . '</p>';


        return $content;
    }
    function htmlQuestion6(): string
    {
        $content = '<a href="/Seance3">Accueil</a><br>';
        $content .= '<a href="/Seance3/Q7">Question 7</a>';
        $content .= '<h1> Q6: Etudiez sur le même principe la requête "Liste des compagnies d\'un pays(location_country)" :
évaluez le gain de performance amené par un index. Que pensez-vous du résultat ?
"</h1>';
        $content .= '<h2>Valeurs testées :</h2>';
        $content .= '<p>Pays : France</p>';
        $content .= '<p>Pays : United States</p>';
        $content .= '<p>Pays : Japan</p>';

        $content .= '<p>Anciennes valeurs : <ul><li>0.01226019859314 secondes</li> <li>0.0097661018371582 secondes</li> <li>0.011689186096191 secondes</li></ul></p>';

        $content .= '<p>Apres index :</p>';

        $debut = microtime(true);
        $companies = Company::where('location_country','France')->get();
        $fin = microtime(true);
        $nbcompanies = count($companies);
        $content .= '<p>Temps d\'execution : ' . ($fin - $debut) . ' secondes</p>';
        $content .= '<p>Nombre de compagnies : ' . $nbcompanies . '</p>';

        $debut2 = microtime(true);
        $companies = Company::where('location_country','United States')->get();
        $fin2 = microtime(true);
        $nbcompanies2 = count($companies);
        $content .= '<p>Temps d\'execution : ' . ($fin2 - $debut2) . ' secondes</p>';
        $content .= '<p>Nombre de compagnies : ' . $nbcompanies2 . '</p>';

        $debut3 = microtime(true);
        $companies = Company::where('location_country','Japan')->get();
        $fin3 = microtime(true);
        $nbcompanies3 = count($companies);
        $content .= '<p>Temps d\'execution : ' . ($fin3 - $debut3) . ' secondes</p>';
        $content .= '<p>Nombre de compagnies : ' . $nbcompanies3 . '</p>';


        return $content;
    }
    function htmlQuestion7(): string
    {
        $content = '<a href="/Seance3">Accueil</a><br>';
        $content .= '<a href="/Seance3/Q8">Question 8</a>';
        $content .= '<h1> Q7: les jeux dont le nom débute par Mario, publiés par une compagnie dont le nom contient "Inc." et dont le rating initial contient "3+"</h1>';
        $content .= "<br><ul>";


        //get games with name containing Mario
        $games = Game::select('*')->where('name','like','Mario%')->get();
        //show querylog
        $content .= '<li>' . DB::getQueryLog()[0]['query'] . '</li>';



        //get name of characters from game with id 12342
        $characters = Character::select('*')->whereHas('games',function($query){
            $query->where('game_id','=',12342);
        })->get();
        //show querylog
        $content .= '<li>' . DB::getQueryLog()[1]['query'] . '</li>';


        //get the first character of a game that has a name containing Mario
        $character = Character::select('*')->whereHas('games',function($query){
            $query->where('name','like','%Mario%');
        })->first();
        //show querylog
        $content .= '<li>' . DB::getQueryLog()[2]['query'] . '</li>';

        //get all characters of a game that has a name containing Mario
        $characters = Character::select('*')->whereHas('games',function($query){
            $query->where('name','like','%Mario%');
        })->get();
        //show querylog
        $content .= '<li>' . DB::getQueryLog()[3]['query'] . '</li>';

        //get games developed by a company with a name that contains Sony
        $games = Game::select('*')->whereHas('company',function ($query){
            $query->where('name','like','%Sony%');
        })->get();
        //show querylog
        $content .= '<li>' . DB::getQueryLog()[4]['query'] . '</li>';


        $content .= "</ul>";
        $content .= '<h1>Avec Chargement lié</h1>';
        $content .= "<br><ul>";
        //get characters of a game that has a name containing Mario whith bound loading
        $characters = Character::where('name','like','%Mario%')->with('games')->get();
        //show querylog
        $content .= '<li>' . DB::getQueryLog()[5]['query'] . '</li>';

        //get games developed by a company with a name that contains Sony whith bound loading
        $games = Game::where('name','like','$Sony%')->with('company')->get();
        //show querylog
        $content .= '<li>' . DB::getQueryLog()[6]['query'] . '</li>';


        return $content;
    }

    function htmlQuestion8():string {
        $content = '<a href="/Seance3">Accueil</a><br>';
        $content .= '<a href="/Seance3/Q9">Question 9</a>';
        $content .= '<h1> Q8: les jeux dont le nom débute Mario, publiés par une compagnie dont le nom contient "Inc", dont le rating initial contient "3+" et ayant reçu un avis de la part du rating board nommé "CERO"</h1>';
        $content .= "<br><ul>";
        foreach ($games = Game::select('*')->where('name','like','Mario%')->whereHas('publisher', function($query){
            $query->where('name','like','%Inc.%');
        })->whereHas('rating', function($query){
            $query->where('name','like','%3+%');
        })->whereHas('rating.ratingboard', function($query){
            $query->where('name','like','%CERO%');
        })->get() as $game) {

            $content .= "<ul>";
            $content .= "<li>Jeu : $game[name]</li>";
            $content .= '</ul>';
        }
        return $content;
    }

    function htmlQuestion9(): string {
        $content = '<a href="/Seance2">Accueil</a><br>';
        $content .= '<h1> Q9:ajouter un nouveau genre de jeu, et l\'associer aux jeux 12, 56, 12, 345</h1>';
        //creation d'un nouveau genre de jeu et l'associer aux jeux 12, 56, 12, 345
        $genre = new genre();
        $genre->name = 'Shooter game';
        $genre->save();
        $games = Game::find([12,56,12,345]);
        $genre->games()->saveMany($games);

        return $content;
    }
}
