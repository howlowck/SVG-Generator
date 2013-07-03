<?php namespace Howlowck\SVGGen\Descriptive;
use Howlowck\SVGGen\Element;

abstract class Descriptive extends Element {
    public function getType()
    {
        return 'descriptive';
    }    
}