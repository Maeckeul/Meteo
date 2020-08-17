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
    public function homepage() {

        $weatherData = $this->weatherModel->getWeatherData();

        return $this->render("weather/homepage.html.twig", [
            'weatherData' => $weatherData,
        ]);
    }

    /**
     * Page des montagnes
     * 
     * @Route("/mountain", name="mountain")
     */
    public function montagneWeather() {

        return $this->render("weather/mountain.html.twig");
    }

    /**
     * Page des plages
     * 
     * @Route("/beach", name="beach")
     */
    public function beachWeather() {

        return $this->render("weather/beach.html.twig");
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
}