<?php

namespace App\Models;

use Intervention\Image\Facades\Image;

class Unit extends Font
{
    public function __construct()
    {
        parent::__construct();
        $this->size = 24;
        $this->align = 'right';
    }
}
