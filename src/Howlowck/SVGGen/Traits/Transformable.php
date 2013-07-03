<?php namespace Howlowck\SVGGen\Traits;
//TODO: Write Tests for Transformables
trait Transformable {
    public $transformArray = array();
    public function rotate($deg)
    {
        $this->transformArray = array_merge($this->transformArray, ['rotate' => $deg]);
        $this->updateAttr();
        return $this;
    }
    public function translate($x, $y)
    {
        $this->transformArray = array_merge($this->transformArray, ['translate' => $x . ' ' . $y]);
        $this->updateAttr();
        return $this;
    }
    public function getAttrString()
    {   
        $transformString = '';
        $count = 0;
        foreach ($this->transformArray as $transformType => $value) {
            if ($count != 0) {
                $transformString .= ' ';
            }
            $transformString .= $transformType . '(' . $value . ')';
            $count++;
        }
        return $transformString;
    }
    private function updateAttr()
    {
        $this->setTransform($this->getAttrString());
    }
} 