<?php

namespace App;

class DivingLog
{
    public $timeEntry;
    public $timeExit;
    public $timeDive;
    public $tempTop;
    public $tempBottom;
    public $depthAvg;
    public $depthMax;
    public $pressureEntry;
    public $pressureExit;

    public function __construct()
    {
        //
    }
    public function setDivingLog(
        $timeEntry,
        $timeExit,
        $timeDive,
        $tempTop,
        $tempBottom,
        $depthAvg,
        $depthMax,
        $pressureEntry,
        $pressureExit
    )
    {
        $this->timeEntry = $timeEntry;
        $this->timeExit = $timeExit;
        $this->timeDive = $timeDive;
        $this->tempTop = $tempTop;
        $this->tempBottom = $tempBottom;
        $this->depthAvg = $depthAvg;
        $this->depthMax = $depthMax;
        $this->pressureEntry = $pressureEntry;
        $this->pressureExit = $pressureExit;
    }
}
