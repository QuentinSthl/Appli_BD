<?php

namespace gamepedia\views;

use gamepedia\models\game;
use gamepedia\models\company;
use gamepedia\models\gamerating;
use gamepedia\models\platform;
use gamepedia\models\character;
use gamepedia\models\ratingboard;
use gamepedia\models\genre;
use gamepedia\models\User;
use gamepedia\models\Comment;
use Slim\Container;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//define('SCRIPT_ROOT', str_replace(dirname(getcwd()) . DIRECTORY_SEPARATOR, (((!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/')), getcwd()));
define('SCRIPT_ROOT', "localhost");
class Seance4DisplayViews {
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
        $content = '<a href="Seance4/Q1" onclick="alert()">Question 1</a>';
        $content .= '<script>function alert(){
                        if(window.confirm(\' Attention des tables vont etre crées dans votre base de données \')){
                            window.location.href = "Seance4/Q1";
                        }
                        }</script>';
        return $content;
    }

    function htmlQuestion1(): string {
        $content = '';
        if(DB::schema(DB::connection()->getName())->hasTable('users')){
            $content .= '<p>La table users existe déjà</p>';
        }
        else{
            DB::connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
                $table->string('email');
                $table->string('firstname');
                $table->string('lastname');
                $table->string('address');
                $table->string('phone');
                $table->string('birthdate');
                $table->timestamps();
                $table->primary('email');
            });
            $content .= '<p>La table users a été créée</p>';

        }




        if(DB::schema(DB::connection()->getName())->hasTable('comments')){
            $content .= '<p>La table comments existe déjà</p>';
        }
        else {
            DB::connection()->getSchemaBuilder()->create('comments', function (Blueprint $table) {
                $table->integer('id')->autoIncrement();
                $table->integer('game_id');
                $table->string('email');
                $table->string('title');
                $table->string('comment');
                $table->timestamps();
                $table->foreign('game_id')->references('id')->on('game');
                $table->foreign('email')->references('email')->on('users');
            });
            $content .= '<p>La table comments a été créée</p>';
        }

        $content .= '<a href="/Seance4/Q2">Inserer les utilisateurs et les commentaires</a>';
        return $content;

    }

    function htmlQuestion2(): string {
        $content = '<a href="/Seance4">Accueil</a><br>';
        $content .= '<a href="/Seance4/Q3">Question 3</a>';

        if(!empty(User::select('*')->where('email','=','quentin@stuhlfauth.com')->get())){
            $content .= '<p>L\'utilisateur n°1 existe déjà</p>';
        }
        else{

            $user1 = new User();
            $user1->email = 'quentin@stuhlfauth.com';
            $user1->firstname = 'Quentin';
            $user1->lastname = 'Stuhlfauth';
            $user1->address = '1 rue de la paix';
            $user1->phone = '0612345678';
            $user1->birthdate = '01/01/2000';
            $user1->save();

            $content .= '<p>L\'utilisateur a été créé</p>';
        }


        if(!empty(User::select('*')->where('email','=','tristan@belmont.com')->get())){
            $content .= '<p>L\'utilisateur n°1 existe déjà</p>';
        }
        else {

            $user2 = new User();
            $user2->email = 'tristan@belmont.com';
            $user2->firstname = 'Tristan';
            $user2->lastname = 'Belmont';
            $user2->address = '2 rue de la paix';
            $user2->phone = '0612345678';
            $user2->birthdate = '01/01/2000';
            $user2->save();

            $content .= '<p>L\'utilisateur a été créé</p>';

        }

        $comment1 = new Comment();
        $comment1->game_id = 12342;
        $comment1->email = 'quentin@stuhlfauth.com';
        $comment1->title = 'Commentaire 1';
        $comment1->comment = 'Ceci est un commentaire';
        $comment1->save();

        $comment2 = new Comment();
        $comment2->game_id = 12342;
        $comment2->email = 'quentin@stuhlfauth.com';
        $comment2->title = 'Commentaire 2';
        $comment2->comment = 'Ceci est un deuxieme commentaire';
        $comment2->save();

        $comment3 = new Comment();
        $comment3->game_id = 12342;
        $comment3->email = 'quentin@stuhlfauth.com';
        $comment3->title = 'Commentaire 3';
        $comment3->comment = 'Ceci est un troisieme commentaire';
        $comment3->save();

        $comment4 = new Comment();
        $comment4->game_id = 12342;
        $comment4->email = 'tristan@belmont.com';
        $comment4->title = 'Commentaire 4';
        $comment4->comment = 'Ceci est un quatrieme commentaire';
        $comment4->save();

        $comment5 = new Comment();
        $comment5->game_id = 12342;
        $comment5->email = 'tristan@belmont.com';
        $comment5->title = 'Commentaire 5';
        $comment5->comment = 'Ceci est un cinquieme commentaire';
        $comment5->save();

        $comment6 = new Comment();
        $comment6->game_id = 12342;
        $comment6->email = 'tristan@belmont.com';
        $comment6->title = 'Commentaire 6';
        $comment6->comment = 'Ceci est un sixieme commentaire';
        $comment6->save();


        return $content;
    }

    function htmlQuestion3(): string {
        $content = '<a href="/Seance4">Accueil</a><br>';


        return $content;
    }

    function htmlQuestion4(): string
    {
        $content = '<a href="/Seance4">Accueil</a><br>';


        return $content;
    }
    function htmlQuestion5(): string {
        $content = '<a href="/Seance4">Accueil</a><br>';

        return $content;
    }
    function htmlQuestion6(): string
    {
        $content = '<a href="/Seance4">Accueil</a><br>';
        return $content;
    }
    function htmlQuestion7(): string
    {
        $content = '<a href="/Seance4">Accueil</a><br>';


        return $content;
    }

    function htmlQuestion8():string {
        $content = '<a href="/Seance4">Accueil</a><br>';

        return $content;
    }

    function htmlQuestion9(): string {
        $content = '<a href="/Seance2">Accueil</a><br>';


        return $content;
    }
}
