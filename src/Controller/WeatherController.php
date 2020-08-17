<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController {

    /**
     * Page Météo des Montagnes
     * 
     * @Route("/montagne"), name="montagne"
     */
    public function montagneWeather() {

        return $this->render('paysages/montagne.html.twig');
    }
}