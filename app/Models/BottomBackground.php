<?php

namespace App\Models;

use Intervention\Image\Facades\Image;
use App\Models\InterventionImage;

class BottomBackground extends InterventionImage
{
    private $canvas;
    private $positions;
    private $width;

    public function __construct()
    {
        parent::__construct();
        $this->canvas = [
            'width' => 1200,
            'height' => 90,
            'background' => [0, 0, 0, 0.5]
        ];
        $this->position = [
            'posX' => 0,
            'posY' => 50
        ];
    }

    public function generateCanvas(): \Intervention\Image\Image
    {
        $canvas = Image::canvas(
            $this->canvas['width'],
            $this->canvas['height'],
            $this->canvas['background']
        );
        return $canvas;
    }
}
