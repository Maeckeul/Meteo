<?php

namespace App\Controller;

use App\Model\WeatherModel;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController {

    private $session;
    private $weatherModel;

    public function __construct(SessionInterface $session, WeatherModel $weatherModel) {
        $this->session = $session;
        $this->weatherModel = $weatherModel;
    }

    /**
     * Page d'acceuil
     * 
     * @Route("/", name="homepage")
     */
    public function index() {

        $weatherData = $this->weatherModel->getWeatherData();

        return $this->render("weather/homepage.html.twig", [
            'weatherData' => $weatherData,
        ]);
    }

    /**
     * Selection de la ville
     * 
     * @Route("/city/{id}/select", name="city_select", requirements={"id" = "\d+"})
     */
    public function selectCity($id) {

        $weatherData = $this->weatherModel->getWeatherByCityIndex($id);

        if(!$weatherData) {
            throw $this->createNotFoundException("Cette ville n'existe pas !");
        }

        $this->session->set('selected_city', $weatherData);

        return $this->redirectToRoute('homepage');
    }

    /**
     * Page Météo des Montagnes
     * 
     * @Route("/montagne"), name="montagne"
     */
    public function montagneWeather() {

        return $this->render('weather/montagne.html.twig');
    }
}