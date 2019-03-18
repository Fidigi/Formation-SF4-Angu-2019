<?php
interface IWorker
{
    public function work();
}

class Programmer implements IWorker
{
    public function work()
    {
        return '<h2>Je code !</h2>';
    }
}


class Tester 
{
    public function test()
    {
        return '<h2>Je teste !</h2>';
    }
}

class TesterAdaptator implements IWorker
{
    private $tester;

    public function __construct(Tester $tester){
        $this->tester = $tester;
    }

    public function work(){
        return $this->tester->test();
    }
}

class ProjectManagement 
{
    public function process(IWorker $member)
    {
        return $member->work();
    }
}


// (...)

$programmer1 = new Programmer();
$programmer2 = new Programmer();

$tester1 = new TesterAdaptator(new Tester());

$project = new ProjectManagement();
echo $project->process($programmer1);
echo $project->process($programmer2);
echo $project->process($tester1);