<?php
namespace App;

use App\Line;
use App\Label;
use App\Value;
use App\Unit;
use App\Date;
use App\Place;
use App\DivingLog;
use Intervention\Image\Facades\Image;

class ImageGeneratorService
{
    private $sizeX;
    private $sizeY;
    private $photoUrl;
    private $photo;

    public function __construct(
        Line $line,
        Label $label,
        Value $value,
        Unit $unit,
        Date $date,
        Place $place
    )
    {
        $this->sizeX = 1200;
        $this->sizeY = 1200;
        $this->photoUrl = 'photos/IMG_0714.jpg';
        $this->line = $line->getFont();
        $this->label = $label->getFont();
        $this->value = $value->getFont();
        $this->unit = $unit->getFont();
        $this->date = $date->getFont();
        $this->place = $place->getFont();
    }

    public function generate(DivingLog $divingLog): \Intervention\Image\Image
    {
        $this->photo = \Image::make($this->photoUrl)->heighten($this->sizeX);
        $this->photo->crop($this->sizeX, $this->sizeY);

        \Log::debug($divingLog->timeDive);

        // When Diving Entry Time exists, display data and label so on.
        if (isset($divingLog->timeEntry)) {
            $this->line->text($divingLog->timeEntry, 100, 40, $this->value);
        }

        // When Diving Exit Time exists, display data and label so on.
        if (isset($divingLog->timeExit)) {
            $this->line->text($divingLog->timeExit, 360, 40, $this->value);
        }

        // When Diving Entry/Exit Time exist, display diff minutes and so on.
        if (isset($divingLog->timeEntry) && isset($divingLog->timeExit)) {
            $this->line->text($divingLog->timeDive, 190, 40, $this->value);
            $this->line->text('min', 240, 40, $this->unit);
        }

        // When Diving Top Temp exists, display data and label so on.
        if (isset($divingLog->tempTop)) {
            $this->line->text('top', 10, 90, $this->label);
            $this->line->text($divingLog->tempTop, 70, 130, $this->value);
            $this->line->text('℃', 100, 130, $this->unit);
        }

        // When Diving Bottom Temp exists, display data and label so on.
        if (isset($divingLog->tempBottom)) {
            $this->line->text('bottom', 10, 170, $this->label);
            $this->line->text($divingLog->tempBottom, 70, 210, $this->value);
            $this->line->text('℃', 100, 210, $this->unit);
        }

        // When Diving Average Depth exists, display data and label so on.
        if (isset($divingLog->depthAvg)) {
            $this->line->text('avg.', 140, 90, $this->label);
            $this->line->text($divingLog->depthAvg, 220, 130, $this->value);
            $this->line->text('m', 250, 130, $this->unit);
        }

        // When Diving Max Depth exists, display data and label so on.
        if (isset($divingLog->depthMax)) {
            $this->line->text('max', 140, 170, $this->label);
            $this->line->text($divingLog->depthMax, 220, 210, $this->value);
            $this->line->text('m', 250, 210, $this->unit);
        }

        // When Diving Entry Pressure exists, display data and label so on.
        if (isset($divingLog->pressureEntry)) {
            $this->line->text('entry', 270, 90, $this->label);
            $this->line->text($divingLog->pressureEntry, 340, 130, $this->value);
            $this->line->text('bar', 380, 130, $this->unit);
        }

        // When Diving Exit Pressure exist, display data and label so on.
        if (isset($divingLog->pressureExit)) {
            $this->line->text('exit', 270, 170, $this->label);
            $this->line->text($divingLog->pressureExit, 340, 210, $this->value);
            $this->line->text('bar', 380, 210, $this->unit);
        }


        $this->photo->insert($this->line, 'top-left', 30, 30);
        $this->photo->text('2019.1.1 tue 晴れ 28℃', 30, 1170, $this->date);
        $this->photo->text('慶良間諸島 渡嘉敷島', 1170, 1170, $this->place);
        return $this->photo;
    }
}
