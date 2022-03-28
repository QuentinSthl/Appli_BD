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

//define('SCRIPT_ROOT', str_replace(dirname(getcwd()) . DIRECTORY_SEPARATOR, (((!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/')), getcwd()));
define('SCRIPT_ROOT', "localhost");
class Seance2DisplayViews {
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
        $content = '<a href="Seance2/Q1">Question 1</a>';
        return $content;
    }

    function htmlQuestion1(): string {
        $content = '<a href="/Seance2">Accueil</a><br>';
        $content .= '<a href="/Seance2/Q2">Question 2</a>';
        $content .= '<h1> Q1: afficher (name , deck) les personnages du jeu 12342</h1>';
        $game = game::select('*')->where('id','=',12342)->get();
        $content .= "<br><ul>";
        foreach ($game[0]->characters as $character){
            $name = $character['name'];
            $deck = $character['deck'];
            $content .= "<li>nom :$name - deck : $deck </li>";
        }
        $content .='</ul>';

        return $content;
    }

    function htmlQuestion2(): string {
        $content = '<a href="/Seance2">Accueil</a><br>';
        $content .= '<a href="/Seance2/Q3">Question 3</a>';
        $content .= '<h1> Q2: les personnages des jeux dont le nom (du jeu) débute par \'Mario\'</h1>';
        $games = game::select('*')->where('name','like','Mario%')->get();
        $content .= "<br><ul>";
        foreach ($games as $game) {
            $name = $game['name'];
            $characters = $game->characters;
            $content .= "<li>Jeu : $name</li>";
            $content .= '<ul>';
            foreach ($characters as $character){
                $cname = $character['name'];
                $content .= "<li>Personnage :$cname</li>";
            }
            $content .='</ul>';

        };
        $content .='</ul>';

        return $content;
    }

    function htmlQuestion3(): string {
        $content = '<a href="/Seance2">Accueil</a><br>';
        $content .= '<a href="/Seance2/Q4">Question 4</a>';
        $content .= '<h1> Q3: les jeux développés par une compagnie dont le nom contient \'Sony\'</h1>';
        $companies = company::select('*')->where('name','like','%Sony%')->get();
        $content .= "<br><ul>";
        foreach ($companies as $company){
            $name = $company['name'];
            $games = $company->games;
            $content .= "<li>Companie : $name</li>";
            $content .= '<ul>';
            foreach ($games as $game){
                $gname = $game['name'];
                $content .= "<li>Jeu :$gname</li>";
            }
            $content .='</ul>';
        }
        $content .= '</ul>';
        return $content;
    }

    function htmlQuestion4(): string
    {
        $content = '<a href="/Seance2">Accueil</a><br>';
        $content .= '<a href="/Seance2/Q5">Question 5</a>';
        $content .= '<h1> Q4: le rating initial (indiquer le rating board) des jeux dont le nom contient Mario</h1>';
        $games = game::select('*')->where('name', 'like', '%Mario%')->get();
        $content .= "<br><ul>";
        foreach ($games as $game) {
            $name = $game['name'];
            $ratings = $game->rating;
            $content .= "<li>Jeu : $name</li>";
            $content .= '<ul>';
            foreach ($ratings as $rating) {
                $ratingboard = $rating->ratingboard;
                echo '<pre>';
                var_dump($ratingboard[0][0]);
                $content .= "<li>Rating :$rating[name]           </li>";
                //$ratinginit = gamerating::select('*')->where('id', '=', $rating['id'])->get();
            }
            $content .= '</ul>';
            $content .= '</ul>';
        }
        return $content;
    }
        function htmlQuestion5(): string {
        $content = '<a href="/Seance2/">Accueil</a><br>';
        $content .= '<a href="/Seance2/Q6">Question 6</a>';
        $content .= '<h1> Q5: les jeux dont le nom débute par Mario et ayant plus de 3 personnages</h1>';
        $games = Game::select('*')->where('name','like','Mario%')->get();
        $content .= "<br><ul>";
        foreach ($games as $game) {
            $name = $game['name'];
            $characters = $game->characters;
            $nbcharacters = $characters->count();
            if($nbcharacters > 3) {
                $content .= "<li>Jeu : $name         nombre de personnages: $nbcharacters</li>";
                foreach ($characters as $character) {
                    $content .= '<ul>';
                    $cname = $character['name'];
                    $content .="<li>Personnage :$cname</li>";
                    $content .='</ul>';
                }
            }
        };

        $content .='</ul>';
        return $content;
    }
    function htmlQuestion6(): string
    {
        $content = '<a href="/Seance2">Accueil</a><br>';
        $content .= '<a href="/Seance2/Q7">Question 7</a>';
        $content .= '<h1> Q6: les jeux dont le nom débute par Mario et dont le rating initial contient "3+"</h1>';
        $rating = gamerating::select('*')->where('name','like','%3+%')->get();
        $content .= "<br><ul>";
        foreach ($rating as $item) {
            $games = $item->games;
            $content .= "<li>Rating : $item[name]</li>";
            foreach ($games as $game){
                $content .= "<ul>";
                if(str_contains($game['name'],'Mario')){
                    $content .= "<li>Jeu : $game[name]</li>";
                }
                $content .= '</ul>';
            }
        }
        $content .= '</ul>';
        return $content;
    }
    function htmlQuestion7(): string
    {
        $content = '<a href="/Seance2">Accueil</a><br>';
        $content .= '<a href="/Seance2/Q8">Question 8</a>';
        $content .= '<h1> Q7: les jeux dont le nom débute par Mario, publiés par une compagnie dont le nom contient "Inc." et dont le rating initial contient "3+"</h1>';
        $content .= "<br><ul>";
        foreach ($games = Game::select('*')->where('name','like','Mario%')->whereHas('publisher', function($query){
            $query->where('name','like','%Inc%');
        })->whereHas('rating', function($query){
            $query->where('name','like','%3+%');
        })->get() as $game) {
            $content .= "<ul>";
            $content .= "<li>Jeu : $game[name]</li>";
            $content .= '</ul>';
        }
        return $content;
    }

    function htmlQuestion8():string {
        $content = '<a href="/Seance2">Accueil</a><br>';
        $content .= '<a href="/Seance2/Q9">Question 9</a>';
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
