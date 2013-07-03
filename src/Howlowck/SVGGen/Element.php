<?php namespace Howlowck\SVGGen;

class Element {
    protected $tagName;
    protected $hasContent = false;
    public $propertyArray = array();
    public $attributeArray = array();
    protected $contentArray = array();
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;
    }
    public function getStartTag() 
    {
        $this->addPropertyToAttribute();
        
        $string = '<' . $this->tagName;
        if ( ! empty($this->attributeArray))
        {
            $string .= ' ';
        }
        foreach ($this->attributeArray as $attributeName => $attributeValue)
        {
            $string .= $attributeName.'="'.$attributeValue.'" ';
        }
        if ( ! $this->hasContent ) {
            return  $string;
        }
        return $string . '>';
    }
    public function getEndTag() 
    {
        if ( ! $this->hasContent ) {
            if ( ! empty($this->attributeArray)) {
                return '/>';
            }
            return ' />';
        }
        return '</' . $this->tagName . '>';
    }
    public function getElementString()
    {
        $string = $this->getStartTag();
        foreach ($this->contentArray as $content) {
            if (is_string($content)) {
                $string .= $content;
                continue;
            } elseif ($content instanceof Element) {
                $string .= $content->getElementString();
            }
        }
        $string .= $this->getEndTag();
        return $string;
    }
    public function setAttributes($attributeArray)
    {
        $this->attributeArray = $attributeArray;
        // $this->addPropertyToAttribute();
        return $this;
    }
    public function addAttributes($attributeArray)
    {
        $this->attributeArray = array_merge($this->attributeArray, $attributeArray);
        return $this;
    }
    // public function addAttribute($attributeName, $attributeValue)
    // {
    //     $this->addAttributes(array($attributeName => $attributeValue));
    //     return $this;
    // } 
    protected function addPropertyToAttribute()
    {
        $this->attributeArray = $this->propertyArray + $this->attributeArray;
    }
    protected function updatePropertyToAttribute()
    {
        $this->attributeArray = array_merge($this->attributeArray, $this->propertyArray);
    }
    public function add($content)
    {
        $this->hasContent = true;
        array_push($this->contentArray, $content);
        return $this;
    }
    public function clearContent()
    {
        $this->hasContent = false;
        $this->contentArray = array();
    }
    private function slugify($input) {
      preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
      $ret = $matches[0];
      foreach ($ret as &$match) {
        $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
      }
      return implode('-', $ret);
    }
    public function __call($method, $arg)
    {
        if (substr($method, 0, 3) == 'set' and strlen($method) > 3) {
            $attrName = $this->slugify(substr($method, 3));
            $this->addAttributes(array($attrName => $arg[0]));
            return $this;
        }
    }
}

