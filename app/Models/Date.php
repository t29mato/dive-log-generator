<?php

namespace App;

use Intervention\Image\Facades\Image;

class Date extends Text
{
    public function __construct()
    {
        parent::__construct();
        $this->size = 48;
        $this->align = 'left';
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
