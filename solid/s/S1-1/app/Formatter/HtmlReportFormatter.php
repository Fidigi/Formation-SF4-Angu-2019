<?php
namespace App\Formatter;

use App\Interface\IReportFormatter;

class HtmlReportFormatter implements IReportFormatter
{

	public static function format(IReport $report)
    {
    	$ireport = $report->getContents();
        return "<h2>".$ireport['title']."</h2><em>".$ireport['date']."</em>";
    }

}