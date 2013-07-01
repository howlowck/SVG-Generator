<?php
use Howlowck\SVGGen\Structure\Group;
class GroupTest extends PHPUnit_Framework_Testcase {
    protected $group;
    public function setUp()
    {
        $this->group = new Group;
    }
    public function testGroupIsTypeGroup()
    {
        $this->assertEquals('group', $this->group->getType());
    }
    public function testGroupToElementString()
    {
        $this->assertEquals('<g />',$this->group->getElementString());
    }
}