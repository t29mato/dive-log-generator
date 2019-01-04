<?php

namespace App;

class Log
{
    protected $timeEntry;
    protected $timeExit;
    protected $tempTop;
    protected $tempBottom;
    protected $depthAvg;
    protected $depthMax;
    protected $pressureEntry;
    protected $pressureExit;

    public function __construct(
        $timeEntry,
        $timeExit,
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
        $this->tempTop = $tempTop;
        $this->tempBottom = $tempBottom;
        $this->depthAvg = $depthAvg;
        $this->depthMax = $depthMax;
        $this->pressureEntry = $pressureEntry;
        $this->pressureExit = $pressureExit;
    }
}
