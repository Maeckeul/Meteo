<?php

namespace App\Controller;

use App\Model\WeatherModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    /**
     * Page d'acceuil
     * 
     * @Route("/", name="homepage")
     */
    public function index() {

        $citys = WeatherModel::getWeatherData();
        dump($citys);

        return $this->render("default/index.html.twig", [
            'citys' => $citys,
        ]);
    }
}