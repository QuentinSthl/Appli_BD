<?php

namespace gamepedia\views;

use gamepedia\models\game;
use gamepedia\models\company;
use gamepedia\models\platform;
use Slim\Container;

//define('SCRIPT_ROOT', str_replace(dirname(getcwd()) . DIRECTORY_SEPARATOR, (((!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/')), getcwd()));
define('SCRIPT_ROOT', "localhost");
class Seance1DisplayViews {
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
		$content = '<a href="Seance1/Q1">Question 1</a>';
		return $content;
	}

	function htmlQuestion1(): string {
        $content = '<a href="/Seance1">Accueil</a><br>';
        $content .= '<a href="/Seance1/Q2">Question 2</a>';
		$content .= '<h1> Q1: lister les jeux dont le nom contient "Mario"</h1>';
		$games = game::select('name')->where('name','like','%Mario%')->get();
        $nb = $games->count();
        $content .= "<h4>Nombre de jeux dont le nom contient 'Mario' : $nb";
		$content .= "<br><ul>";
		foreach($games as $g){
			$name = $g['name'];
			$content .= "<li>$name</li>";
		}
		$content .= '</ul>';
		return $content;
	}

	function htmlQuestion2(): string {
        $content = '<a href="/Seance1">Accueil</a><br>';
        $content .= '<a href="/Seance1/Q3">Question 3</a>';
        $content .= '<h1> Q2: lister les compagnies installées au Japon</h1>';
        $companies = Company::select('name')->where('location_country','=','Japan')->get();
        $nb = $companies->count();
        $content .= "<h4>Nombre de compagnies installées au Japon :  $nb";
        $content .= "<br><ul>";
        foreach($companies as $c){
            $name = $c['name'];
            $content .= "<li>$name</li>";
        }
        $content .= '</ul>';
        return $content;
	}

	function htmlQuestion3(): string {
        $content = '<a href="/Seance1">Accueil</a><br>';
        $content .= '<a href="/Seance1/Q4">Question 4</a>';
        $content .= '<h1> Q3: lister les plateformes dont la base installée est >=10 000 000</h1>';
        $platform = Platform::select('name')->where('install_base','>','10000000')->get();
        $nb = $platform->count();
        $content .= "<h4>Nombre de plateforme :  $nb";
        $content .= "<br><ul>";
        foreach($platform as $p){
            $name = $p['name'];
            $content .= "<li>$name</li>";
        }
        $content .= '</ul>';
        return $content;
	}

	function htmlQuestion4(): string {
        $content = '<a href="/Seance1">Accueil</a><br>';
        $content .= '<a href="/Seance1/Q5">Question 5</a>';
        $content .= '<h1> Q4: liste 442 jeux à partir du 21173ème</h1>';
        $games = Game::select('name')->where('id','>','21173','and')->where('id','<','21616')->get();
        $nb = $games->count();
        $content .= "<h4>Nombre de jeux :  $nb";
        $content .= "<br><ul>";
        foreach($games as $g){
            $name = $g['name'];
            $content .= "<li>$name</li>";
        }
        $content .= '</ul>';
        return $content;
	}

	function htmlQuestion5(): string {
        if(isset($_GET['page']) && !empty($_GET['page'])){
            $currentPage = (int) strip_tags($_GET['page']);
        }else{
            $currentPage = 1;
        }

        $parPage = 500;
        $content = '<a href="/Seance1">Accueil</a><br>';
        $content .= '<h1> Q5: lister les jeux, afficher leur nom et deck, en paginant (taille des pages : 500)</h1>';
        $games = Game::select('name','deck')->offset($parPage*($currentPage-1))->limit($parPage)->get();
        $gamescount = Game::select('name','deck')->get();
        $nbgames = $gamescount->count();

        $content .= "<br><ul>";
        foreach ($games as $game) {
            $name = $game['name'];
            $deck = $game['deck'];
            if($deck == null){

                $content .= "<li>$name</li>";
            }
            else {
                $content .= "<li>$name -> $deck</li>";
            }
        }
        //si premiere page on affiche pas page precedente
        if($currentPage != 1){
            $page = $currentPage -1;
            $content .= '<a href="/Seance1/Q5' . '?page=' . $page . '">Page précedente</a><br>';
        }
        $nbpages = ceil($nbgames/$parPage);
        if ($currentPage < $nbpages){
            $page = $currentPage +1;
            $content .= '<a href="/Seance1/Q5' . '?page=' . $page . '">Page suivante</a><br>';
        }
        if($currentPage > $nbpages){
            $content = '<a href="/Seance1">Accueil</a><br>';
            $content .= '<h1> Q5: lister les jeux, afficher leur nom et deck, en paginant (taille des pages : 500)</h1>';
            $content .= '<h1>Ca ne sert a rien! Il n\'y a plus de page !</h1>';
            $content .= '<a href="/Seance1/Q5?page=1">Retourner au début</a><br>';
        }
        //si derniere page on affiche pas page suivante
        //sinon on affiche
		return $content;
	}
}