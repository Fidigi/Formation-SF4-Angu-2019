<?php

class DangerousWeatherAlert implements SplObserver
{
    public function update(SplSubject $subject)
    {
        // Code alertant l'utilisateur si les conditions météorologiques sont dangereuses.
        echo '<h3>DangerousWeatherAlert</h3><em>Bulletin vigilance météo</em>'.'<br>';
        echo 'Rain - ' . $subject->getRain().'<br>';
        echo 'Temp - ' . $subject->getTemperature().'<br>';
        echo 'Wind - ' . $subject->getWind().'<br>';
    }
}