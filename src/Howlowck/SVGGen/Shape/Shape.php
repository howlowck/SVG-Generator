<?php namespace Howlowck\SVGGen\Shape;
use Howlowck\SVGGen\Element;
use Howlowck\SVGGen\Traits\Transformable;
/**
* Base Shape Class
*/
abstract class Shape extends Element
{
    use Transformable;
    public function getType()
    {
        return 'shape';
    }
    public function getPropertyArray()
    {
        return $this->propertyArray;
    } 
}