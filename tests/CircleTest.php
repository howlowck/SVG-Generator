<?php
use Howlowck\SVGGen\Shape\Circle;
use Mockery as M;
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
    public function tearDown() {
        m::close();
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
        $this->circle->setCx($cx);
        $this->circle->setCy($cy);
        $this->circle->setR($r);
        $attributeArray = $this->circle->attributeArray;
        $this->assertEquals($cx, $attributeArray["cx"]);
        $this->assertEquals($cy, $attributeArray["cy"]);
        $this->assertEquals($r, $attributeArray["r"]);
    }
    public function testInitializeWithProperties() {
        $cx = 4;
        $cy = 5;
        $circle2 = new Circle(array('cx'=> $cx, 'cy' => $cy));
        $attributeArray = $circle2->attributeArray;
        $this->assertEquals($cx, $attributeArray["cx"]);
        $this->assertEquals($cy, $attributeArray["cy"]);
    }
    public function testEndTagName() {
        $this->assertEquals(' />', $this->circle->getEndTag());
    }
    public function testDirectlySetAttributeArray() {
        $this->circle->setAttributes(['fill'=>'red']);
        $this->assertArrayHasKey('fill', $this->circle->attributeArray);
        $this->circle->setStroke('blue');
        $this->assertArrayHasKey('fill', $this->circle->attributeArray);
        $this->assertArrayHasKey('stroke', $this->circle->attributeArray);
    }
    public function testSetAttributesThroughMethod() {
        $this->circle->setFill('red');
        $this->assertArrayHasKey('fill', $this->circle->attributeArray);
        $this->circle->setStroke('blue');
        $this->assertArrayHasKey('fill', $this->circle->attributeArray);
        $this->assertArrayHasKey('stroke', $this->circle->attributeArray);
    }
    public function testElementStringWithoutContent() {
        $this->assertEquals('<circle />', $this->circle->getElementString());
        $this->circle->setCX(3)->setCY(3)->setR(5);
        $this->assertEquals('<circle cx="3" cy="3" r="5" />', $this->circle->getElementString());
        $this->circle->setFill('red');
        $this->assertEquals('<circle cx="3" cy="3" r="5" fill="red" />', $this->circle->getElementString());
        $this->circle->setStrokeWidth('20');
        $this->assertEquals('<circle cx="3" cy="3" r="5" fill="red" stroke-width="20" />', $this->circle->getElementString());
    }
    public function testElementStringWithContent() {
        $title = m::mock('Howlowck\SVGGen\Descriptive\Title');
        $title->shouldReceive('getElementString')->times(1)->andReturn('<title>awesome!</title>');
        $this->circle->add($title);
        $this->assertEquals('<circle><title>awesome!</title></circle>', $this->circle->getElementString());
    }
    public function testTranformArrayOnRotateOrTranslate() {
        $this->circle->rotate(30);
        $this->assertArrayHasKey('rotate', $this->circle->transformArray);
        $this->circle->translate(40, 20);
        $this->assertArrayHasKey('translate', $this->circle->transformArray);
    }
    public function testTranformStringOnRotateAndTranslate() {
        $this->circle->rotate(30)->translate(20, 40);
        $this->assertEquals("rotate(30) translate(20 40)", $this->circle->getAttrString());
    }
    public function testElementStringWithTransform() {
        $this->circle->rotate('30');
        $this->assertEquals('<circle transform="rotate(30)" />', $this->circle->getElementString());
    }
}