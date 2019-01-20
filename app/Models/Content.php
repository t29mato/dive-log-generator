<?php

namespace App\Models;

use Intervention\Image\Facades\Image;

class Content extends Font
{
    public function __construct()
    {
        parent::__construct();
        $this->size = 36;
        $this->align = 'left';
    }
}
