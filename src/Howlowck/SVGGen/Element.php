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
        $this->updatePropertyToAttribute();
        $string = '<' . $this->tagName;
        if ( ! empty($this->attributeArray)) {
            $string .= ' ';
        }
        foreach ($this->attributeArray as $attributeName => $attributeValue) {
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
            if (! empty($this->attributeArray)) {
                return '/>';
            }
            return ' />';
        }
        return '</' . $this->tagName . '>';
    }
    public function getElementString() {
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
        $this->addPropertyToAttribute();
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
    public function clearContent(){
        $this->hasContent = false;
        $this->contentArray = array();
    }
}

