<?php

class TomorrowWeatherDisplay implements SplObserver
{
    public function update(SplSubject $subject)
    {
        /*
         * Code affichant les prévisions de demain basées sur le niveau actuel de précipitations,
         * la température et la vitesse du vent
         */
        echo '<h3>TomorrowWeatherDisplay</h3><em>Prévisions météo pour demain</em>'.'<br>';
        echo 'Rain - ' . $subject->getRain().'<br>';
        echo 'Temp - ' . $subject->getTemperature().'<br>';
        echo 'Wind - ' . $subject->getWind().'<br>';
    }
}