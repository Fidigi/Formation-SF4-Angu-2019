<?php
/*include 'app/interface/IReportFormatter.php';
include 'app/interface/IReport.php';
include 'app/formatter/HtmlReportFormatter.php';
include 'app/formatter/JsonReportFormatter.php';
include 'app/objet/Report.php';*/
require 'vendor/autoload.php';

use App\Objet\Report;

// (...) EXEMPLE DE CODE CLIENT

$report = new Report('2016-04-21', 'Titre de mon rapport');

echo HtmlReportFormatter::format($report);
echo '<hr>';
echo JsonReportFormatter::format($report);