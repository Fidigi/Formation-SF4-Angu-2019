<meta charset="utf8">
<?php



include 'CurrentWeatherDisplay.class.php';
include 'DangerousWeatherAlert.class.php';
include 'TomorrowWeatherDisplay.class.php';

include 'WeatherStation.class.php';


// Création de la station météo (le sujet).
$weatherStation = new WeatherStation();
$currentWeatherDisplay = new CurrentWeatherDisplay();
$dangerousWeatherAlert = new DangerousWeatherAlert();
$tomorrowWeatherDisplay1 = new TomorrowWeatherDisplay();
$tomorrowWeatherDisplay2 = new TomorrowWeatherDisplay();
$weatherStation->attach($currentWeatherDisplay);
$weatherStation->attach($dangerousWeatherAlert);
$weatherStation->attach($tomorrowWeatherDisplay1);
$weatherStation->attach($tomorrowWeatherDisplay2);
$weatherStation->detach($tomorrowWeatherDisplay1);
// Exécution de la station météo.
//$weatherStation->run();
$weatherStation->notify();