<?php

interface IReport
{

    public function getContents();

    public function getStatistics();

    public function setTitle($title);

}

interface IReportFormatter
{

    public static function format(IReport $report);

}

class HtmlReportFormatter implements IReportFormatter
{

	public static function format(IReport $report)
    {
    	$ireport = $report->getContents();
        return "<h2>".$ireport['title']."</h2><em>".$ireport['date']."</em>";
    }

}

class JsonReportFormatter implements IReportFormatter
{

	public static function format(IReport $report)
    {
        return json_encode($report->getContents());
    }

}

class Report implements IReport
{
    private $date;

    private $title;


    public function __construct($date, $title)
    {
        $this->date  = $date;
        $this->title = $title;
    }

    public function getContents()
    {
        return
        [
            'date'  => $this->date,
            'title' => $this->title
        ];
    }

    public function getStatistics()
    {
        // Génère des statistiques sur le contenu du rapport.
        return
        [
            'pages' => 5,
            'words' => 1236
        ];
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
}




// (...) EXEMPLE DE CODE CLIENT

$report = new Report('2016-04-21', 'Titre de mon rapport');

echo HtmlReportFormatter::format($report);
echo '<hr>';
echo JsonReportFormatter::format($report);