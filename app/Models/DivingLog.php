<?php

namespace App\Models;

use Illuminate\Support\Facades\Input;

class DivingLog
{
    public $numberDiving;
    public $timeEntry;
    public $timeExit;
    public $timeDive;
    public $tempTop;
    public $tempBottom;
    public $depthAvg;
    public $depthMax;
    public $pressureEntry;
    public $pressureExit;
    public $dateDiving;
    public $weather;
    public $temperature;
    public $place;
    public $photo;

    public function setDivingLog($request)
    {
        $this->numberDiving = $this->issetRequest($request->numberDiving);
        $this->timeEntry = $this->issetRequest($request->timeEntry);
        $this->timeExit = $this->issetRequest($request->timeExit);
        $this->timeDive = $this->issetRequest($request->timeDive);
        $this->tempTop = $this->issetRequest($request->tempTop);
        $this->tempBottom = $this->issetRequest($request->tempBottom);
        $this->depthAvg = $this->issetRequest($request->depthAvg);
        $this->depthMax = $this->issetRequest($request->depthMax);
        $this->pressureEntry = $this->issetRequest($request->pressureEntry);
        $this->pressureExit = $this->issetRequest($request->pressureExit);
        $this->dateDiving = $this->issetRequest($request->dateDiving);
        $this->weather = $this->issetRequest($request->weather);
        $this->temperature = $this->issetRequest($request->temperature);
        $this->place = $this->issetRequest($request->place);
        $this->photo = $this->issetRequest($request->photo);
    }
    private function issetRequest($data) {
        if (isset($data)) {
            return $data;
        }
        return '';
    }
}
