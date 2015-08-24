<?php

use Concrete\Flysystem\MountManager;

class MountManagerTests extends PHPUnit_Framework_TestCase
{
    public function testInstantiable()
    {
        $manager = new MountManager;
    }

    public function testConstructorInjection()
    {
        $mock = Mockery::mock('Concrete\Flysystem\FilesystemInterface');
        $manager = new MountManager(array(
            'prefix' => $mock,
        ));
        $this->assertEquals($mock, $manager->getFilesystem('prefix'));
    }

    /**
     * @expectedException  InvalidArgumentException
     */
    public function testInvalidPrefix()
    {
        $manager = new MountManager;
        $manager->mountFilesystem(false, Mockery::mock('Concrete\Flysystem\FilesystemInterface'));
    }

    /**
     * @expectedException  LogicException
     */
    public function testUndefinedFilesystem()
    {
        $manager = new MountManager;
        $manager->getFilesystem('prefix');
    }

    public function invalidCallProvider()
    {
        return array(
            array(array(), 'LogicException'),
            array(array(false), 'InvalidArgumentException'),
            array(array('path/without/protocol'), 'InvalidArgumentException'),
        );
    }

    /**
     * @dataProvider  invalidCallProvider
     */
    public function testInvalidArguments($arguments, $exception)
    {
        $this->setExpectedException($exception);
        $manager = new MountManager;
        $manager->filterPrefix($arguments);
    }

    public function testCallForwarder()
    {
        $manager = new MountManager;
        $mock = Mockery::mock('Concrete\Flysystem\FilesystemInterface');
        $mock->shouldReceive('aMethodCall')->once()->andReturn('a result');
        $manager->mountFilesystem('prot', $mock);
        $this->assertEquals($manager->aMethodCall('prot://file.ext'), 'a result');
    }
}
