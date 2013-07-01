<?php namespace Howlowck\SVGGen\Shape;
use Howlowck\SVGGen\Element;
/**
* Base Shape Class
*/
abstract class Shape extends Element
{
    public function getType() {
        return 'shape';
    }
    public function getPropertyArray() {
        return $this->propertyArray;
    }
    public function setFill($color) {
        $this->addAttribute('fill', $color);
        return $this;
    }
    public function setStrokeWidth($value) {
        $this->addAttribute('stroke-width', $value);
        return $this;
    }
    public function setStrokeColor($value) {
        $this->addAttribute('stroke', $value);
        return $this;
    }
}