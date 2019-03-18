<?php
namespace App\Formatter;

use App\Interface\IReportFormatter;

class JsonReportFormatter implements IReportFormatter
{

	public static function format(IReport $report)
    {
        return json_encode($report->getContents());
    }

}