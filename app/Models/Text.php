<?php

namespace App;

use Intervention\Image\Facades\Image;

class Text
{
    protected $family;
    protected $color;
    protected $size;
    protected $align;

    public function __construct()
    {
        $this->family = 'fonts/Noto_Sans_JP/NotoSansJP-Regular.otf';
        $this->color = '#fff';
    }
}
