<?php
declare(strict_types=1);

namespace gamepedia\controllers;

use gamepedia\views\Seance3DisplayViews;
use Illuminate\Database\Capsule\Manager as DB;
use gamepedia\models\Item;
use gamepedia\models\Liste;
use gamepedia\models\Message;
use gamepedia\models\Utilisateur;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Container;

/**
 * Controle l'affichage de la page d'accueil
 */
class Seance3Controller {

    private Container $container;

    /**
     * Constructeur du controleur
     * @param Container $container
     */
    public function __construct(Container $container) {
        $this->container = $container;
    }

    /**
     * Méthode d'affichage de la page d'accueil côté controleur
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */


    public function Accueil(Request $rq, Response $rs, array $args): Response {
        $array = [];
        $vue = new Seance3DisplayViews($array, $this->container);
        $html = $vue->render(0);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function Question1(Request $rq, Response $rs, array $args): Response {
        $array = [];
        $vue = new Seance3DisplayViews($array, $this->container);
        $html = $vue->render(1);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function Question2(Request $rq, Response $rs, array $args): Response {
        $array = [];
        $vue = new Seance3DisplayViews($array, $this->container);
        $html = $vue->render(2);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function Question3(Request $rq, Response $rs, array $args): Response {
        $array = [];
        $vue = new Seance3DisplayViews($array, $this->container);
        $html = $vue->render(3);
        $rs->getBody()->write($html);
        return $rs;
    }
    public function Question4(Request $rq, Response $rs, array $args): Response {
        $array = [];
        $vue = new Seance3DisplayViews($array, $this->container);
        $html = $vue->render(4);
        $rs->getBody()->write($html);
        return $rs;
    }
    public function Question5(Request $rq, Response $rs, array $args): Response {
        $array = [];
        $vue = new Seance3DisplayViews($array, $this->container);
        $html = $vue->render(5);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function Question6(Request $rq, Response $rs, array $args): Response {
        $array = [];
        $vue = new Seance3DisplayViews($array, $this->container);
        $html = $vue->render(6);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function Question7(Request $rq, Response $rs, array $args): Response {
        $array = [];
        $vue = new Seance3DisplayViews($array, $this->container);
        $html = $vue->render(7);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function Question8(Request $rq, Response $rs, array $args): Response {
        $array = [];
        $vue = new Seance3DisplayViews($array, $this->container);
        $html = $vue->render(8);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function Question9(Request $rq, Response $rs, array $args): Response {
        $array = [];
        $vue = new Seance3DisplayViews($array, $this->container);
        $html = $vue->render(9);
        $rs->getBody()->write($html);
        return $rs;
    }
}