<?php namespace Howlowck\SVGGen\Shape;

class Circle extends Shape {
    protected $tagName = 'circle';
    protected $cx;
    protected $cy;
    protected $r;
    public $propertyArray = array(
        'cx' => 0,
        'cy' => 0,
        'r' => 0
    );
    public function __construct($cx = 0, $cy = 0, $r = 0)
    {
        $this->cx = $cx;
        $this->cy = $cy;
        $this->r = $r;
    }
    public function setCX($x) 
    {
        $this->cx = $x;
        $this->propertyArray = array_merge($this->propertyArray, array('cx' => $this->cx));
        return $this;
    }
    public function setCY($y) 
    {
        $this->cy = $y;
        $this->propertyArray = array_merge($this->propertyArray, array('cy' => $this->cy));
        return $this;
    }
    public function setR($r)
    {
        $this->r = $r;
        $this->propertyArray = array_merge($this->propertyArray, array('r' => $this->r));
        return $this;
    }
}