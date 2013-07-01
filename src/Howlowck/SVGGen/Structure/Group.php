<?php namespace Howlowck\SVGGen\Structure;
use Howlowck\SVGGen\Element;
class Group extends Element
{
    protected $tagName = 'g';
    protected $ElementArray = array();
    function getType() {
        return 'group';
    }

}