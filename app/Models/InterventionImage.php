<?php

namespace App\Models;

use Intervention\Image\Facades\Image;

abstract class InterventionImage
{
    protected $color;
    protected $backgroundColor;

    public function __construct()
    {
        $this->color = '#fff';
        $this->backgroundColor = [0, 0, 0, 0.5];
    }
}
