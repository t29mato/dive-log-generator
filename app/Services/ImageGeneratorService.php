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
    private $lineCanvas;

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
        $this->line = $line;
        $this->label = $label;
        $this->value = $value;
        $this->unit = $unit;
        $this->content = $content;
        $this->place = $place;
    }

    public function generate(DivingLog $divingLog)
    {
        $this->photo = \Image::make($divingLog->photo)->heighten($this->sizeX);
        $this->photo->crop($this->sizeX, $this->sizeY);

        if (isset($divingLog->color)) {
            $this->line->setColor($divingLog->color);
            $this->label->setColor($divingLog->color);
            $this->value->setColor($divingLog->color);
            $this->unit->setColor($divingLog->color);
            $this->content->setColor($divingLog->color);
            $this->place->setColor($divingLog->color);
        }

        $this->lineCanvas = $this->line->generateCanvas();

        if (isset($divingLog->timeEntry)) {
            $this->lineCanvas->text($divingLog->timeEntry, 100, 40, $this->value->getFont());
        }

        if (isset($divingLog->timeExit)) {
            $this->lineCanvas->text($divingLog->timeExit, 360, 40, $this->value->getFont());
        }

        if (isset($divingLog->timeEntry) && isset($divingLog->timeExit)) {
            if ($divingLog->timeDive !== 0) {
                $this->lineCanvas->text($divingLog->timeDive, 190, 40, $this->value->getFont());
                $this->lineCanvas->text('min', 240, 40, $this->unit->getFont());
            }
        }

        if (isset($divingLog->tempTop)) {
            $this->lineCanvas->text('top', 10, 90, $this->label->getFont());
            $this->lineCanvas->text($divingLog->tempTop, 70, 130, $this->value->getFont());
            $this->lineCanvas->text('℃', 100, 130, $this->unit->getFont());
        }

        if (isset($divingLog->tempBottom)) {
            $this->lineCanvas->text('bottom', 10, 170, $this->label->getFont());
            $this->lineCanvas->text($divingLog->tempBottom, 70, 210, $this->value->getFont());
            $this->lineCanvas->text('℃', 100, 210, $this->unit->getFont());
        }

        if (isset($divingLog->depthAvg)) {
            $this->lineCanvas->text('avg.', 140, 90, $this->label->getFont());
            $this->lineCanvas->text($divingLog->depthAvg, 220, 130, $this->value->getFont());
            $this->lineCanvas->text('m', 250, 130, $this->unit->getFont());
        }

        if (isset($divingLog->depthMax)) {
            $this->lineCanvas->text('max', 140, 170, $this->label->getFont());
            $this->lineCanvas->text($divingLog->depthMax, 220, 210, $this->value->getFont());
            $this->lineCanvas->text('m', 250, 210, $this->unit->getFont());
        }

        if (isset($divingLog->pressureEntry)) {
            $this->lineCanvas->text('entry', 270, 90, $this->label->getFont());
            $this->lineCanvas->text($divingLog->pressureEntry, 340, 130, $this->value->getFont());
            $this->lineCanvas->text('bar', 380, 130, $this->unit->getFont());
        }

        if (isset($divingLog->pressureExit)) {
            $this->lineCanvas->text('exit', 270, 170, $this->label->getFont());
            $this->lineCanvas->text($divingLog->pressureExit, 340, 210, $this->value->getFont());
            $this->lineCanvas->text('bar', 380, 210, $this->unit->getFont());
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
            $this->photo->text($text, 30, 1170, $this->content->getFont());
        }


        if (isset($divingLog->place)) {
            $this->photo->text($divingLog->place, 1170, 1170, $this->place->getFont());
        }

        // Attach Line to the Photo.
        $this->photo->insert($this->lineCanvas, 'top-left', 30, 30);

        $path = 'storage/photos/temp/';
        $filename = $path . uniqid() . '.jpg';
        if (!file_exists($path)) {
            mkdir($path, 755, true);
        }
        $this->photo->save($filename);
        $imageUrl = url($filename);

        return $imageUrl;
    }
}
