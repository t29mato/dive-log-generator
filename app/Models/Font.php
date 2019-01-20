<?php

namespace App\Models;

use Intervention\Image\Facades\Image;
use App\DivingLog;

abstract class Font extends InterventionImage
{
    protected $family;
    protected $size;
    protected $align;

    public function __construct()
    {
        $this->family = 'fonts/Noto_Sans_JP/NotoSansJP-Regular.otf';
    }

    public function getFont()
    {
        return function($font) {
            $font->file($this->family);
            $font->color($this->getColor());
            $font->size($this->size);
            $font->align($this->align);
        };
    }
}
