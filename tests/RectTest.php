<?php
use Howlowck\SVGGen\Shape\Rect;
class RectTest extends PHPUnit_Framework_Testcase {
    protected $rect;
    public function setUp() {
        $this->rect = new Rect();
    }
    public function testRectCreatedInstanceOfRect() {
        $this->assertInstanceOf('Howlowck\SVGGen\Shape\Rect', $this->rect);
    }
    public function testRectsetLocation(){
        $this->rect->location(4, 5);
        $this->assertEquals('<rect x="4" y="5" />', $this->rect->getElementString());
    }
}