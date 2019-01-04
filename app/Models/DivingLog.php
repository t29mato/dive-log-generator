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
    public $dateDiving;
    public $weather;
    public $temperature;
    public $place;

    public function __construct()
    {
        //
    }
    public function setDivingLog($request)
    {
        $this->timeEntry = $this->issetRequest($request->timeEntry);
        $this->timeExit = $this->issetRequest($request->timeExit);
        $this->timeDive = $this->issetRequest($request->timeDive);
        $this->tempTop = $this->issetRequest($request->tempTop);
        $this->tempBottom = $this->issetRequest($request->tempBottom);
        $this->depthAvg = $this->issetRequest($request->depthAvg);
        $this->depthMax = $this->issetRequest($request->depthMax);
        $this->pressureEntry = $this->issetRequest($request->pressureEntry);
        $this->pressureExit = $this->issetRequest($request->pressureExit);

        $this->dateDiving = $this->issetRequest(
            $this->formatDate($request->dateDiving)
        );
        $this->weather = $this->issetRequest($request->weather);
        $this->temperature = $this->issetRequest($request->temperature);
        $this->place = $this->issetRequest($request->place);
    }
    private function formatDate($date) {
        if (!isset($date)) {
            return null;
        }
        $arrayDate = explode('-', $date);
        $resultDate = date('Y/m/d (D)', mktime(
            0, 0, 0, $arrayDate[1], $arrayDate[2], $arrayDate[0]
        ));
        return $resultDate;
    }
    private function issetRequest($data) {
        if (isset($data)) {
            return $data;
        }
        return '';
    }
}
