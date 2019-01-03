<?php

namespace App;

use Intervention\Image\Facades\Image;

class Label extends Text
{
    public function __construct()
    {
        parent::__construct();
        $this->size = 24;
    }

    public function getFont()
    {
        return function($font) {
            $font->file($this->family);
            $font->color($this->color);
            $font->size($this->size);
        };
    }
}
