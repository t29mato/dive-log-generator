<?php
namespace App;

use App\Line;
use App\Label;
use App\Value;
use App\Unit;
use Intervention\Image\Facades\Image;

class ImageGeneratorService
{
    private $sizeX;
    private $sizeY;

    public function __construct()
    {

    }

    public function generate() {
        $photo = \Image::make('photos/IMG_0714.jpg')->heighten(1200);
        $photo->crop(1200, 1200);
        $line = new Line();
        $line = $line->create();

        $label = new Label();
        $line->text('top',      10, 90, $label->create());
        $line->text('bottom',   10, 170, $label->create());
        $line->text('avg.',     140, 90, $label->create());
        $line->text('max',      140, 170, $label->create());
        $line->text('entry',    270, 90, $label->create());
        $line->text('exit',     270, 170, $label->create());

        $value = new Value();
        $line->text('10:00', 100, 40, $value->create());
        $line->text('99', 190, 40, $value->create());
        $line->text('10:45', 360, 40, $value->create());
        $line->text('3', 70, 130, $value->create());
        $line->text('-20', 70, 210, $value->create());
        $line->text('7.8', 220, 130, $value->create());
        $line->text('18.0', 220, 210, $value->create());
        $line->text('190', 340, 130, $value->create());
        $line->text('80', 340, 210, $value->create());

        $unit = new Unit();
        $line->text('min', 240, 40, $unit->create());
        $line->text('℃', 100, 130, $unit->create());
        $line->text('℃', 100, 210, $unit->create());
        $line->text('m', 250, 130, $unit->create());
        $line->text('m', 250, 210, $unit->create());
        $line->text('bar', 380, 130, $unit->create());
        $line->text('bar', 380, 210, $unit->create());
        $line->text('bar', 380, 210, $unit->create());

        $photo->insert($line, 'top-left', 20, 20);
        $photo->text('2019.1.1 tue 晴れ 28℃ 慶良間諸島', 1170, 1170, $value->create());
        return $photo;
    }
}
