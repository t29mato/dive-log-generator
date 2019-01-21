<?php

namespace App\Services;

use App\Models\Label;
use App\Models\Value;
use App\Models\Unit;
use App\Models\Content;
use App\Models\Place;
use App\Models\DivingLog;
use Intervention\Image\Facades\Image;

class GeneratorService
{
    private $photoCanvas;
    private $logCanvas;
    private $descriptionCanvas;
    private $color = '#fff';
    private $backgroundColor = [0, 0, 0, 0.5];
    private $borderWidth = 3;

    public function __construct(
        Label $label,
        Value $value,
        Unit $unit,
        Content $content,
        Place $place
    )
    {
        $this->sizeX = 1200;
        $this->sizeY = 1200;
        $this->label = $label;
        $this->value = $value;
        $this->unit = $unit;
        $this->content = $content;
        $this->place = $place;
    }

    public function generate(DivingLog $divingLog): string
    {
        $this->photoCanvas = $this->generatePhotoCanvas($divingLog->photo);
        $this->logCanvas = $this->generateLogCanvas();
        $this->descriptionCanvas = $this->generateDescriptionCanvas();

        if (isset($divingLog->timeEntry)) {
            $this->logCanvas->text($divingLog->timeEntry, 100, 40, $this->value->getFont());
        }

        if (isset($divingLog->timeExit)) {
            $this->logCanvas->text($divingLog->timeExit, 360, 40, $this->value->getFont());
        }

        if (is_numeric($divingLog->timeDive)) {
            \Log::debug($divingLog->timeDive);
            $this->logCanvas->text($divingLog->timeDive, 190, 40, $this->value->getFont());
            $this->logCanvas->text('min', 240, 40, $this->unit->getFont());
        }

        if (is_numeric($divingLog->tempTop)) {
            $this->logCanvas->text('top', 10, 90, $this->label->getFont());
            $this->logCanvas->text($divingLog->tempTop, 70, 130, $this->value->getFont());
            $this->logCanvas->text('℃', 100, 130, $this->unit->getFont());
        }

        if (is_numeric($divingLog->tempBottom)) {
            $this->logCanvas->text('bottom', 10, 170, $this->label->getFont());
            $this->logCanvas->text($divingLog->tempBottom, 70, 210, $this->value->getFont());
            $this->logCanvas->text('℃', 100, 210, $this->unit->getFont());
        }

        if (is_numeric($divingLog->depthAvg)) {
            $this->logCanvas->text('avg.', 140, 90, $this->label->getFont());
            $this->logCanvas->text($divingLog->depthAvg, 220, 130, $this->value->getFont());
            $this->logCanvas->text('m', 250, 130, $this->unit->getFont());
        }

        if (is_numeric($divingLog->depthMax)) {
            $this->logCanvas->text('max', 140, 170, $this->label->getFont());
            $this->logCanvas->text($divingLog->depthMax, 220, 210, $this->value->getFont());
            $this->logCanvas->text('m', 250, 210, $this->unit->getFont());
        }

        if (is_numeric($divingLog->pressureEntry)) {
            $this->logCanvas->text('entry', 270, 90, $this->label->getFont());
            $this->logCanvas->text($divingLog->pressureEntry, 340, 130, $this->value->getFont());
            $this->logCanvas->text('bar', 380, 130, $this->unit->getFont());
        }

        if (is_numeric($divingLog->pressureExit)) {
            $this->logCanvas->text('exit', 270, 170, $this->label->getFont());
            $this->logCanvas->text($divingLog->pressureExit, 340, 210, $this->value->getFont());
            $this->logCanvas->text('bar', 380, 210, $this->unit->getFont());
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
            $this->photoCanvas->insert($this->descriptionCanvas, 'bottom', 0, 0);
        }

        if (isset($text)) {
            $this->photoCanvas->text($text, 30, 1170, $this->content->getFont());
        }

        if (isset($divingLog->place)) {
            $this->photoCanvas->text($divingLog->place, 1170, 1170, $this->place->getFont());
        }

        // Attach Line to the Photo.
        $this->photoCanvas->insert($this->logCanvas, 'top-left', 30, 30);

        $path = 'storage/photos/temp/';
        $filename = $path . uniqid() . '.png';
        if (!file_exists($path)) {
            mkdir($path, 755, true);
        }
        $this->photoCanvas->save($filename);
        $imageUrl = url($filename);

        return $imageUrl;
    }

    private function generateLogCanvas(): \Intervention\Image\Image
    {
        // Canvasの設定
        $canvas = [
            'width' => 390,
            'height' => 250,
            'background' => $this->backgroundColor
        ];
        $positions = [
            ['posX' => 0, 'posY' => 50],
            ['posX' => 130, 'posY' => 50],
            ['posX' => 130, 'posY' => 240],
            ['posX' => 260, 'posY' => 240],
            ['posX' => 260, 'posY' => 50],
            ['posX' => 390, 'posY' => 50],
        ];
        $canvas = Image::canvas(
            $canvas['width'],
            $canvas['height'],
            $canvas['background']
        );

        // Canvasの生成
        for ($i = 0; $i < count($positions) - 1; $i++) {
            $canvas->line(
                $positions[$i]['posX'],
                $positions[$i]['posY'],
                $positions[$i+1]['posX'],
                $positions[$i+1]['posY'],
                function ($draw) {
                    $draw->color($this->color);
                    $draw->width($this->borderWidth);
                }
            );
        }
        return $canvas;
    }

    private function generatePhotoCanvas(string $photo): \Intervention\Image\Image
    {
        return \Image::make($photo)
            ->heighten($this->sizeX)
            ->encode('png', 80)
            ->crop($this->sizeX, $this->sizeY);
    }

    private function generateDescriptionCanvas(): \Intervention\Image\Image
    {
        $canvas = [
            'width' => 1200,
            'height' => 90,
            'background' => $this->backgroundColor
        ];
        $position = [
            'posX' => 0,
            'posY' => 50
        ];
        return Image::canvas(
            $canvas['width'],
            $canvas['height'],
            $canvas['background']
        );
    }
}
