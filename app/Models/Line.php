<?php

namespace App\Models;

use Intervention\Image\Facades\Image;
use App\Models\InterventionImage;

class Line extends InterventionImage
{
    private $canvas;
    private $positions;
    private $width;

    public function __construct()
    {
        parent::__construct();
        $this->canvas = [
            'width' => 390,
            'height' => 250,
            'background' => [0, 0, 0, 0.5]
        ];
        $this->positions = [
            ['posX' => 0, 'posY' => 50],
            ['posX' => 130, 'posY' => 50],
            ['posX' => 130, 'posY' => 240],
            ['posX' => 260, 'posY' => 240],
            ['posX' => 260, 'posY' => 50],
            ['posX' => 390, 'posY' => 50],
        ];
        $this->width = 3;
    }

    public function generateCanvas(): \Intervention\Image\Image
    {
        $canvas = Image::canvas(
            $this->canvas['width'],
            $this->canvas['height'],
            $this->canvas['background']
        );
        for ($i = 0; $i < count($this->positions) - 1; $i++) {
            $canvas->line(
                $this->positions[$i]['posX'],
                $this->positions[$i]['posY'],
                $this->positions[$i+1]['posX'],
                $this->positions[$i+1]['posY'],
                function ($draw) {
                    $draw->color($this->color);
                    $draw->width($this->width);
                }
            );
        }
        return $canvas;
    }
}
