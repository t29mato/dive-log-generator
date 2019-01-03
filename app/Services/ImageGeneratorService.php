<?php
namespace App;

use App\Line;
use App\Label;
use App\Value;
use App\Unit;
use App\Date;
use App\Place;
use Intervention\Image\Facades\Image;

class ImageGeneratorService
{
    private $sizeX;
    private $sizeY;
    private $photoUrl;
    private $photo;

    public function __construct(
        Line $line,
        Label $label,
        Value $value,
        Unit $unit,
        Date $date,
        Place $place
    )
    {
        $this->sizeX = 1200;
        $this->sizeY = 1200;
        $this->photoUrl = 'photos/IMG_0714.jpg';
        $this->line = $line->getFont();
        $this->label = $label->getFont();
        $this->value = $value->getFont();
        $this->unit = $unit->getFont();
        $this->date = $date->getFont();
        $this->place = $place->getFont();
    }

    public function generate() {
        $this->photo = \Image::make($this->photoUrl)->heighten($this->sizeX);
        $this->photo->crop($this->sizeX, $this->sizeY);

        $this->line->text('top', 10, 90, $this->label);
        $this->line->text('bottom', 10, 170, $this->label);
        $this->line->text('avg.', 140, 90, $this->label);
        $this->line->text('max', 140, 170, $this->label);
        $this->line->text('entry', 270, 90, $this->label);
        $this->line->text('exit', 270, 170, $this->label);

        $this->line->text('10:00', 100, 40, $this->value);
        $this->line->text('99', 190, 40, $this->value);
        $this->line->text('10:45', 360, 40, $this->value);
        $this->line->text('3', 70, 130, $this->value);
        $this->line->text('-20', 70, 210, $this->value);
        $this->line->text('7.8', 220, 130, $this->value);
        $this->line->text('18.0', 220, 210, $this->value);
        $this->line->text('190', 340, 130, $this->value);
        $this->line->text('80', 340, 210, $this->value);

        $this->line->text('min', 240, 40, $this->unit);
        $this->line->text('℃', 100, 130, $this->unit);
        $this->line->text('℃', 100, 210, $this->unit);
        $this->line->text('m', 250, 130, $this->unit);
        $this->line->text('m', 250, 210, $this->unit);
        $this->line->text('bar', 380, 130, $this->unit);
        $this->line->text('bar', 380, 210, $this->unit);

        $this->photo->insert($this->line, 'top-left', 30, 30);
        $this->photo->text('2019.1.1 tue 晴れ 28℃', 30, 1170, $this->date);
        $this->photo->text('慶良間諸島 渡嘉敷島', 1170, 1170, $this->place);
        return $this->photo;
    }
}
