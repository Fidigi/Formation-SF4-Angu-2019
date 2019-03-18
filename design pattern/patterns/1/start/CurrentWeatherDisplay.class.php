<?php

class CurrentWeatherDisplay implements SplObserver
{
    public function update(SplSubject $subject) {
        echo '<h3>CurrentWeatherDisplay</h3><em>Météo en temps réel</em>'.'<br>';
        echo 'Rain - ' . $subject->getRain().'<br>';
        echo 'Temp - ' . $subject->getTemperature().'<br>';
        echo 'Wind - ' . $subject->getWind().'<br>';
    }
}