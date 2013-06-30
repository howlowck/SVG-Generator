<?php namespace Howlowck\SVGGen\Shape;

class Circle extends Shape {
    protected $tagName = 'circle';
    protected $cx;
    protected $cy;
    protected $r;
    public function setCX($x) 
    {
        $this->cx = $x;
        $this->updatePropertyArray();
        return $this;
    }
    public function setCY($y) 
    {
        $this->cy = $y;
        $this->updatePropertyArray();
        return $this;
    }
    public function setR($r)
    {
        $this->r = $r;
        $this->updatePropertyArray();
        return $this;
    }
    public function updatePropertyArray() {
        $this->propertyArray = array(
            "cx" => $this->cx,
            "cy" => $this->cy,
            "r" => $this->r,
        );
        return $this->propertyArray;
    }
}