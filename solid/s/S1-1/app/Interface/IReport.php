<?php
namespace App\Interface;

interface IReport
{

    public function getContents();

    public function getStatistics();

    public function setTitle($title);

}