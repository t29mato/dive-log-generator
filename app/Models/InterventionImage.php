<?php

namespace App\Models;

use Intervention\Image\Facades\Image;

abstract class InterventionImage
{
    private $color;

    public function __construct()
    {
        $this->color = '#000000';
    }

    public function setColor(string $color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }
}
