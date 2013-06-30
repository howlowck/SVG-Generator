<?php
use Howlowck\SVGGen\Shape\Circle;
Class CircleTest extends PHPUnit_Framework_TestCase {
    protected $circle;
    /**
     * An array of Circle Properties to Test
     * [cx, cy, r]
     */
    public function properties() {
        return [
            [5, 4, 20],
            [-2, -4, 30]
        ];
    }
    public function setUp() {
        $this->circle = new Circle;
    }
    public function testCreateSuccessful() {
        $this->assertInstanceOf("Howlowck\SVGGen\Shape\Circle", $this->circle);
    }
    public function testGetTypeIsShape() {
        $this->assertEquals("shape", $this->circle->getType());
    }
    /**
     * @dataProvider properties
     */
    public function testSetProperties($cx, $cy, $r) {
        $this->circle->setCX($cx);
        $this->circle->setCY($cy);
        $this->circle->setR($r);
        $propertyArray = $this->circle->updatePropertyArray();
        $this->assertEquals($propertyArray["cx"], $cx);
        $this->assertEquals($propertyArray["cy"], $cy);
        $this->assertEquals($propertyArray["r"], $r);
    }
    public function testTagName() {
        $this->assertEquals('<circle ', $this->circle->getStartTag());
        $this->assertEquals('/>', $this->circle->getEndTag());
    }
    public function testAttributeArray() {
        $this->circle->setAttributes(['fill'=>'red']);
        $this->assertArrayHasKey('fill', $this->circle->attributeArray);
        $this->circle->addAttribute('stroke', 'blue');
        $this->assertArrayHasKey('fill', $this->circle->attributeArray);
        $this->assertArrayHasKey('stroke', $this->circle->attributeArray);
    }
    public function testString() {
        $this->assertEquals('<circle />', $this->circle->getElementString());
        $this->circle->setCX(3)->setCY(3)->setR(5);
        $this->assertEquals('<circle cx="3" cy="3" r="5" />', $this->circle->getElementString());
        $this->circle->setAttributes(['fill'=>'red']);
        $this->assertEquals('<circle cx="3" cy="3" r="5" fill="red" />', $this->circle->getElementString());

    }
}