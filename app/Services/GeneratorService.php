<?php

namespace App\Services;

use App\Models\Label;
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
    private $family = 'fonts/Noto_Sans_JP/NotoSansJP-Regular.otf';

    public function __construct(
        Label $label,
        Content $content,
        Place $place
    )
    {
        $this->label = $label;
        $this->content = $content;
        $this->place = $place;
    }

    public function generate(DivingLog $divingLog): string
    {
        $this->photoCanvas = $this->generatePhotoCanvas($divingLog->photo);
        $this->logCanvas = $this->generateLogCanvas($divingLog);
        $this->descriptionCanvas = $this->generateDescriptionCanvas();


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

    private function generateLogCanvas(DivingLog $log): \Intervention\Image\Image
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
        $logCanvas = Image::canvas(
            $canvas['width'],
            $canvas['height'],
            $canvas['background']
        );

        // Canvasの生成
        for ($i = 0; $i < count($positions) - 1; $i++) {
            $logCanvas->line(
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

        // 入力値のFontの設定

        if (isset($log->timeEntry)) {
            $logCanvas->text($log->timeEntry, 100, 40, $this->getInputFont());
        }

        if (isset($log->timeExit)) {
            $logCanvas->text($log->timeExit, 360, 40, $this->getInputFont());
        }

        if (is_numeric($log->timeDive)) {
            $logCanvas->text($log->timeDive, 190, 40, $this->getInputFont());
            $logCanvas->text('min', 240, 40, $this->getUnitFont());
        }

        if (is_numeric($log->tempTop)) {
            $logCanvas->text('top', 10, 90, $this->label->getFont());
            $logCanvas->text($log->tempTop, 70, 130, $this->getInputFont());
            $logCanvas->text('℃', 100, 130, $this->getUnitFont());
        }

        if (is_numeric($log->tempBottom)) {
            $logCanvas->text('bottom', 10, 170, $this->label->getFont());
            $logCanvas->text($log->tempBottom, 70, 210, $this->getInputFont());
            $logCanvas->text('℃', 100, 210, $this->getUnitFont());
        }

        if (is_numeric($log->depthAvg)) {
            $logCanvas->text('avg.', 140, 90, $this->label->getFont());
            $logCanvas->text($log->depthAvg, 220, 130, $this->getInputFont());
            $logCanvas->text('m', 250, 130, $this->getUnitFont());
        }

        if (is_numeric($log->depthMax)) {
            $logCanvas->text('max', 140, 170, $this->label->getFont());
            $logCanvas->text($log->depthMax, 220, 210, $this->getInputFont());
            $logCanvas->text('m', 250, 210, $this->getUnitFont());
        }

        if (is_numeric($log->pressureEntry)) {
            $logCanvas->text('entry', 270, 90, $this->label->getFont());
            $logCanvas->text($log->pressureEntry, 340, 130, $this->getInputFont());
            $logCanvas->text('bar', 380, 130, $this->getUnitFont());
        }

        if (is_numeric($log->pressureExit)) {
            $logCanvas->text('exit', 270, 170, $this->label->getFont());
            $logCanvas->text($log->pressureExit, 340, 210, $this->getInputFont());
            $logCanvas->text('bar', 380, 210, $this->getUnitFont());
        }

        return $logCanvas;
    }

    private function generatePhotoCanvas(string $photo): \Intervention\Image\Image
    {
        $sizeX = 1200;
        $sizeY = 1200;
        return \Image::make($photo)
            ->heighten($sizeX)
            ->encode('png', 80)
            ->crop($sizeX, $sizeY);
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

    private function getInputFont()
    {
        $return = function($font) {
            $font->file($this->family);
            $font->color($this->color);
            $font->size(36);
            $font->align('right');
        };
        return $return;
    }

    private function getUnitFont()
    {
        $return = function($font) {
            $font->file($this->family);
            $font->color($this->color);
            $font->size(24);
            $font->align('right');
        };
        return $return;
    }

}
