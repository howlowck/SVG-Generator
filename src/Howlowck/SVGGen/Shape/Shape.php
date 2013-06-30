<?php namespace Howlowck\SVGGen\Shape;
/**
* Base Shape Class
*/
abstract class Shape 
{
    protected $tagName;
    public $propertyArray = [];
    public $attributeArray = [];
    function __construct()
    {
        
    }
    public function getStartTag() 
    {
        return '<' . $this->tagName . ' ';
    }
    public function getEndTag() 
    {
        return '/>';
    }
    public function getType() {
        return 'shape';
    }
    public function setAttributes($attributeArray)
    {
        $this->attributeArray = $attributeArray;
        return $this;
    }
    public function addAttributes($attributeArray)
    {
        $this->attributeArray = array_merge($this->attributeArray, $attributeArray);
        return $this;
    }
    public function addAttribute($attributeName, $attributeValue)
    {
        $this->addAttributes(array($attributeName => $attributeValue));
        return $this;
    }
    public function getElementString()
    {
        $string = $this->getStartTag();
        foreach ($this->propertyArray as $property => $value) {
            $string .= $property.'="'.$value.'" ';
        }
        foreach ($this->attributeArray as $attributeName => $attributeValue) {
            $string .= $attributeName.'="'.$attributeValue.'" ';
        }
        $string .= $this->getEndTag();
        return $string;
    }
}