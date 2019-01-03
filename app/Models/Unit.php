<?php

namespace App;

use Intervention\Image\Facades\Image;

class Unit extends Text
{
    public function __construct()
    {
        parent::__construct();
        $this->size = 24;
        $this->align = 'right';
    }

    public function getFont()
    {
        return function($font) {
            $font->file($this->family);
            $font->color($this->color);
            $font->size($this->size);
            $font->align($this->align);
        };
    }
}
