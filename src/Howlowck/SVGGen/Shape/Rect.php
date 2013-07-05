<?php namespace Howlowck\SVGGen\Shape;
use Howlowck\SVGGen\Shape\Shape;
/**
* Rect Shape Class
*/
class Rect extends Shape
{
    protected $tagName = "rect";
    public function location($x, $y)
    {
        $this->setX($x);
        $this->setY($y);
    }
    public function dimension($width, $height)
    {
        $this->setWidth($width);
        $this->setHeight($height);
    }
}