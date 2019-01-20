<?php
namespace App\Service;

use App\Models\Line;
use App\Models\Label;
use App\Models\Value;
use App\Models\Unit;
use App\Models\Content;
use App\Models\Place;
use App\Models\DivingLog;
use App\Models\BottomBackground;
use Intervention\Image\Facades\Image;

class ImageGeneratorService
{
    private $sizeX;
    private $sizeY;
    private $photoCanvas;
    private $lineCanvas;
    private $bottomBackgroundCanvas;

    public function __construct(
        Line $line,
        Label $label,
        Value $value,
        Unit $unit,
        Content $content,
        Place $place,
        BottomBackground $bottomBackground
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
        $this->bottomBackground = $bottomBackground;
    }

    public function generate(DivingLog $divingLog): string
    {
        $this->photoCanvas = \Image::make($divingLog->photo)->heighten($this->sizeX)->encode('png', 80);
        $this->photoCanvas->crop($this->sizeX, $this->sizeY);

        $this->lineCanvas = $this->line->generateCanvas();
        $this->bottomBackgroundCanvas = $this->bottomBackground->generateCanvas();

        if (isset($divingLog->timeEntry)) {
            $this->lineCanvas->text($divingLog->timeEntry, 100, 40, $this->value->getFont());
        }

        if (isset($divingLog->timeExit)) {
            $this->lineCanvas->text($divingLog->timeExit, 360, 40, $this->value->getFont());
        }

        if (is_numeric($divingLog->timeDive)) {
            \Log::debug($divingLog->timeDive);
            $this->lineCanvas->text($divingLog->timeDive, 190, 40, $this->value->getFont());
            $this->lineCanvas->text('min', 240, 40, $this->unit->getFont());
        }

        if (is_numeric($divingLog->tempTop)) {
            $this->lineCanvas->text('top', 10, 90, $this->label->getFont());
            $this->lineCanvas->text($divingLog->tempTop, 70, 130, $this->value->getFont());
            $this->lineCanvas->text('℃', 100, 130, $this->unit->getFont());
        }

        if (is_numeric($divingLog->tempBottom)) {
            $this->lineCanvas->text('bottom', 10, 170, $this->label->getFont());
            $this->lineCanvas->text($divingLog->tempBottom, 70, 210, $this->value->getFont());
            $this->lineCanvas->text('℃', 100, 210, $this->unit->getFont());
        }

        if (is_numeric($divingLog->depthAvg)) {
            $this->lineCanvas->text('avg.', 140, 90, $this->label->getFont());
            $this->lineCanvas->text($divingLog->depthAvg, 220, 130, $this->value->getFont());
            $this->lineCanvas->text('m', 250, 130, $this->unit->getFont());
        }

        if (is_numeric($divingLog->depthMax)) {
            $this->lineCanvas->text('max', 140, 170, $this->label->getFont());
            $this->lineCanvas->text($divingLog->depthMax, 220, 210, $this->value->getFont());
            $this->lineCanvas->text('m', 250, 210, $this->unit->getFont());
        }

        if (is_numeric($divingLog->pressureEntry)) {
            $this->lineCanvas->text('entry', 270, 90, $this->label->getFont());
            $this->lineCanvas->text($divingLog->pressureEntry, 340, 130, $this->value->getFont());
            $this->lineCanvas->text('bar', 380, 130, $this->unit->getFont());
        }

        if (is_numeric($divingLog->pressureExit)) {
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

        if (isset($text) || isset($divingLog->place)) {
            $this->photoCanvas->insert($this->bottomBackgroundCanvas, 'bottom', 0, 0);
        }

        if (isset($text)) {
            $this->photoCanvas->text($text, 30, 1170, $this->content->getFont());
        }

        if (isset($divingLog->place)) {
            $this->photoCanvas->text($divingLog->place, 1170, 1170, $this->place->getFont());
        }

        // Attach Line to the Photo.
        $this->photoCanvas->insert($this->lineCanvas, 'top-left', 30, 30);

        $path = 'storage/photos/temp/';
        $filename = $path . uniqid() . '.png';
        if (!file_exists($path)) {
            mkdir($path, 755, true);
        }
        $this->photoCanvas->save($filename);
        $imageUrl = url($filename);

        return $imageUrl;
    }
}
