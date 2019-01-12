<?php
namespace App;

use App\Line;
use App\Label;
use App\Value;
use App\Unit;
use App\Content;
use App\Place;
use App\DivingLog;
use Intervention\Image\Facades\Image;

class ImageGeneratorService
{
    private $sizeX;
    private $sizeY;
    private $photo;

    public function __construct(
        Line $line,
        Label $label,
        Value $value,
        Unit $unit,
        Content $content,
        Place $place
    )
    {
        $this->sizeX = 1200;
        $this->sizeY = 1200;
        $this->line = $line->getFont();
        $this->label = $label->getFont();
        $this->value = $value->getFont();
        $this->unit = $unit->getFont();
        $this->content = $content->getFont();
        $this->place = $place->getFont();
    }

    public function generate(DivingLog $divingLog): \Intervention\Image\Image
    {
        $this->photo = \Image::make($divingLog->photo)->heighten($this->sizeX);
        $this->photo->crop($this->sizeX, $this->sizeY);

        /**
         * When Data exists, display data, label and unit.
         */

        if (isset($divingLog->timeEntry)) {
            $this->line->text($divingLog->timeEntry, 100, 40, $this->value);
        }

        if (isset($divingLog->timeExit)) {
            $this->line->text($divingLog->timeExit, 360, 40, $this->value);
        }

        if (isset($divingLog->timeEntry) && isset($divingLog->timeExit)) {
            if ($divingLog->timeDive !== 0) {
                $this->line->text($divingLog->timeDive, 190, 40, $this->value);
                $this->line->text('min', 240, 40, $this->unit);
            }
        }

        if (isset($divingLog->tempTop)) {
            $this->line->text('top', 10, 90, $this->label);
            $this->line->text($divingLog->tempTop, 70, 130, $this->value);
            $this->line->text('℃', 100, 130, $this->unit);
        }

        if (isset($divingLog->tempBottom)) {
            $this->line->text('bottom', 10, 170, $this->label);
            $this->line->text($divingLog->tempBottom, 70, 210, $this->value);
            $this->line->text('℃', 100, 210, $this->unit);
        }

        if (isset($divingLog->depthAvg)) {
            $this->line->text('avg.', 140, 90, $this->label);
            $this->line->text($divingLog->depthAvg, 220, 130, $this->value);
            $this->line->text('m', 250, 130, $this->unit);
        }

        if (isset($divingLog->depthMax)) {
            $this->line->text('max', 140, 170, $this->label);
            $this->line->text($divingLog->depthMax, 220, 210, $this->value);
            $this->line->text('m', 250, 210, $this->unit);
        }

        if (isset($divingLog->pressureEntry)) {
            $this->line->text('entry', 270, 90, $this->label);
            $this->line->text($divingLog->pressureEntry, 340, 130, $this->value);
            $this->line->text('bar', 380, 130, $this->unit);
        }

        if (isset($divingLog->pressureExit)) {
            $this->line->text('exit', 270, 170, $this->label);
            $this->line->text($divingLog->pressureExit, 340, 210, $this->value);
            $this->line->text('bar', 380, 210, $this->unit);
        }

        // TODO: refacotring
        $text = '';
        if (isset($divingLog->dateDiving)) {
            $text .= $divingLog->dateDiving;
            $text .= ' ';
        }

        if (isset($divingLog->weather)) {
            $text .= $divingLog->weather;
            $text .= ' ';
        }

        if (isset($divingLog->temperature)) {
            $text .= $divingLog->temperature;
            $text .= ' ';
        }

        if (isset($text)) {
            $this->photo->text($text, 30, 1170, $this->content);
        }


        if (isset($divingLog->place)) {
            $this->photo->text($divingLog->place, 1170, 1170, $this->place);
        }

        // Attach Line to the Photo.
        $this->photo->insert($this->line, 'top-left', 30, 30);
        return $this->photo;
    }
}
