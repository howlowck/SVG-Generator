<?php
use Howlowck\SVGGen\Descriptive\Title;
class TitleTest extends PHPUnit_Framework_Testcase {
    protected $title;
    public function setUp()
    {
        $this->title = new Title;
    }
    public function testTitleInstanceOfDescriptive()
    {
        $this->assertInstanceOf('Howlowck\SVGGen\Descriptive\Descriptive', $this->title);
    }
    public function testGetElementStringWithStringContent()
    {
       $this->title->add('This is cool!');
       $this->assertEquals('<title>This is cool!</title>', $this->title->getElementString());
    }
}