<?php
use Howlowck\SVGGen\Structure\SVG;
use Mockery as m;
class SVGTest extends PHPUnit_Framework_Testcase {
    protected $svg;
    public function setUp()
    {
        $this->svg = new SVG;
    }
    public function tearDown()
    {
        m::close();
    }
    public function testSVGInstanceOfElement()
    {
        $this->assertInstanceOf('Howlowck\SVGGen\Element', $this->svg);
    }
    public function testEmptySVGElementString()
    {
        $this->assertEquals('<svg />', $this->svg->getElementString());
    }
    public function testSVGElementWithAttributes()
    {
        $this->svg->setWidth(300)->setHeight(400);
        $this->assertEquals('<svg width="300" height="400" />', $this->svg->getElementString());
    }
    public function testSVGElementWithSetAnythingMethodWithMagic(){
        $this->svg->setSomething('340');
        $this->assertEquals('<svg something="340" />', $this->svg->getElementString());
    }
    public function testSVGElementStringWithCircleInside()
    {
        $circleOutput = '<circle cx="3" cy="5" r="20" />';
        $circle = m::mock('Howlowck\SVGGen\Shape\Circle');
        $circle->shouldReceive('getElementString')->times(2)->andReturn($circleOutput);
        $this->svg->add($circle);
        $this->assertEquals("<svg>$circleOutput</svg>", $this->svg->getElementString());
        $this->svg->setWidth(500)->setHeight(600);
        $this->assertEquals("<svg width=\"500\" height=\"600\" >$circleOutput</svg>", $this->svg->getElementString());
    }
}