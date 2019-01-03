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

    public function __construct(
        Line $line,
        Label $label,
        Value $value,
        Unit $unit
    )
    {
        $this->sizeX = 1200;
        $this->line = $line->getFont();
    }

    public function generate() {
        $photo = \Image::make('photos/IMG_0714.jpg')->heighten(1200);
        $photo->crop($this->sizeX, 1200);

        $label = new Label();
        $this->line->text('top',      10, 90, $label->getFont());
        $this->line->text('bottom',   10, 170, $label->getFont());
        $this->line->text('avg.',     140, 90, $label->getFont());
        $this->line->text('max',      140, 170, $label->getFont());
        $this->line->text('entry',    270, 90, $label->getFont());
        $this->line->text('exit',     270, 170, $label->getFont());

        $value = new Value();
        $this->line->text('10:00', 100, 40, $value->getFont());
        $this->line->text('99', 190, 40, $value->getFont());
        $this->line->text('10:45', 360, 40, $value->getFont());
        $this->line->text('3', 70, 130, $value->getFont());
        $this->line->text('-20', 70, 210, $value->getFont());
        $this->line->text('7.8', 220, 130, $value->getFont());
        $this->line->text('18.0', 220, 210, $value->getFont());
        $this->line->text('190', 340, 130, $value->getFont());
        $this->line->text('80', 340, 210, $value->getFont());

        $unit = new Unit();
        $this->line->text('min', 240, 40, $unit->getFont());
        $this->line->text('℃', 100, 130, $unit->getFont());
        $this->line->text('℃', 100, 210, $unit->getFont());
        $this->line->text('m', 250, 130, $unit->getFont());
        $this->line->text('m', 250, 210, $unit->getFont());
        $this->line->text('bar', 380, 130, $unit->getFont());
        $this->line->text('bar', 380, 210, $unit->getFont());
        $this->line->text('bar', 380, 210, $unit->getFont());

        $photo->insert($this->line, 'top-left', 20, 20);
        $photo->text('2019.1.1 tue 晴れ 28℃ 慶良間諸島', 1170, 1170, $value->getFont());
        return $photo;
    }
}
