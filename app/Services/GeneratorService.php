<?php

namespace App\Services;

use App\Models\DivingLog;
use Intervention\Image\Facades\Image;

class GeneratorService
{
    private $photoCanvas;
    private $logCanvas;
    private $memoCanvas;
    private $color = '#fff';
    private $backgroundColor = [0, 0, 0, 0.3];
    private $borderWidth = 3;
    private $family = 'fonts/Noto_Sans_JP/NotoSansJP-Regular.otf';

    public function generate(DivingLog $divingLog, string $template): string
    {
        if (strpos($template, 'black') !== false) {
            $this->color = '#000';
            $this->backgroundColor = [255, 255, 255, 0.6];
        }

        $this->photoCanvas = $this->generatePhotoCanvas($divingLog->photo);
        $this->logCanvas = $this->generateLogCanvas($divingLog);
        $this->memoCanvas = $this->generateMemoCanvas($divingLog);

        if (strpos($template, 'left')) {
            $this->photoCanvas->insert($this->logCanvas, 'top-left', 30, 30);
        } else {
            $this->photoCanvas->insert($this->logCanvas, 'top-right', 30, 30);
        }

        $this->photoCanvas->insert($this->memoCanvas, 'bottom', 0, 0);


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

        // ログのテキストの生成とCanvasへの挿入
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
            $logCanvas->text('top', 10, 90, $this->getLabelFont());
            $logCanvas->text($log->tempTop, 70, 130, $this->getInputFont());
            $logCanvas->text('℃', 100, 130, $this->getUnitFont());
        }

        if (is_numeric($log->tempBottom)) {
            $logCanvas->text('bottom', 10, 170, $this->getLabelFont());
            $logCanvas->text($log->tempBottom, 70, 210, $this->getInputFont());
            $logCanvas->text('℃', 100, 210, $this->getUnitFont());
        }

        if (is_numeric($log->depthAvg)) {
            $logCanvas->text('avg.', 140, 90, $this->getLabelFont());
            $logCanvas->text($log->depthAvg, 220, 130, $this->getInputFont());
            $logCanvas->text('m', 250, 130, $this->getUnitFont());
        }

        if (is_numeric($log->depthMax)) {
            $logCanvas->text('max', 140, 170, $this->getLabelFont());
            $logCanvas->text($log->depthMax, 220, 210, $this->getInputFont());
            $logCanvas->text('m', 250, 210, $this->getUnitFont());
        }

        if (is_numeric($log->pressureEntry)) {
            $logCanvas->text('entry', 270, 90, $this->getLabelFont());
            $logCanvas->text($log->pressureEntry, 340, 130, $this->getInputFont());
            $logCanvas->text('bar', 380, 130, $this->getUnitFont());
        }

        if (is_numeric($log->pressureExit)) {
            $logCanvas->text('exit', 270, 170, $this->getLabelFont());
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

    private function generateMemoCanvas(DivingLog $log): \Intervention\Image\Image
    {
        // Canvasの設定
        $canvas = [
            'width' => 1200,
            'height' => 90,
            'background' => $this->backgroundColor
        ];

        // Canvasの生成
        $memoCanvas = Image::canvas(
            $canvas['width'],
            $canvas['height'],
            $canvas['background']
        );

        // ログのテキストの生成とCanvasへの挿入
        $leftMemo = '';
        if (isset($log->numberDiving)) {
            $leftMemo .= '#' . $log->numberDiving;
            $leftMemo .= ' ';
        }
        if (isset($log->place)) {
            $leftMemo .= $log->place;
        }

        $rightMemo = '';
        if (isset($log->dateDiving)) {
            $rightMemo .= $this->formatDate($log->dateDiving);
            $rightMemo .= ' ';
        }

        if (isset($log->weather)) {
            $rightMemo .= $log->weather;
            $rightMemo .= ' ';
        }

        if (isset($log->temperature)) {
            $rightMemo .= $log->temperature;
            $rightMemo .= '℃';
        }

        if (isset($leftMemo)) {
            $memoCanvas->text($leftMemo, 30, 56, function($font) {
                $font->file($this->family);
                $font->color($this->color);
                $font->size(36);
                $font->align('left');
            });
        }

        if (isset($rightMemo)) {
            $memoCanvas->text($rightMemo, 1170, 56, function($font) {
                $font->file($this->family);
                $font->color($this->color);
                $font->size(36);
                $font->align('right');
            });
        }

        return $memoCanvas;
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

    private function getLabelFont()
    {
        $return = function($font) {
            $font->file($this->family);
            $font->color($this->color);
            $font->size(24);
            $font->align('left');
        };
        return $return;
    }

    private function formatDate($date) {
        if (!isset($date)) {
            return null;
        }
        $week = array('日', '月', '火', '水', '木', '金', '土');
        $arrayDate = explode('-', $date);
        $resultDate = date('Y/m/d', mktime(
            0, 0, 0, $arrayDate[1], $arrayDate[2], $arrayDate[0]
        ));
        $resultWeek = date('w', mktime(
            0, 0, 0, $arrayDate[1], $arrayDate[2], $arrayDate[0]
        ));
        return $resultDate . '(' . $week[$resultWeek] .')';
    }
}
