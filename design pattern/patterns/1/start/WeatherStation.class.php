<?php

class WeatherStation implements SplSubject
{
    /*private $currentWeatherDisplay;
    private $dangerousWeatherAlert;
    private $tomorrowWeatherDisplay;
    */
    private $observers;

    public function __construct()
    {
        // Création de chaque dispositif lié à la station météo.
        /*$this->currentWeatherDisplay  = new CurrentWeatherDisplay();
        $this->dangerousWeatherAlert  = new DangerousWeatherAlert();
        $this->tomorrowWeatherDisplay = new TomorrowWeatherDisplay();*/
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer) {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer) {
        $this->observers->detach($observer);
    }

    public function notify() {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function getRain()
    {
        // (...) Code renvoyant le niveau de précipitation.
        return 11.2;
    }

    public function getTemperature()
    {
        // (...) Code renvoyant la température.
        return 8.5;
    }

    public function getWind()
    {
        // (...) Code renvoyant la vitesse du vent.
        return 42;
    }
/*
    public function run()
    {
        // Récupération des données des capteurs de la station météo.
        $rain        = $this->getRain();
        $temperature = $this->getTemperature();
        $wind        = $this->getWind();

        // Informe chaque dispositif lié à la station météo des nouvelles données.
        $this->currentWeatherDisplay->refresh($rain, $temperature, $wind);
        $this->dangerousWeatherAlert->refresh($rain, $temperature, $wind);
        $this->tomorrowWeatherDisplay->refresh($rain, $temperature, $wind);
    }
*/
}