<?php

namespace Shepard\Tests\Manager;

use Shepard\Entity\SimpleJob;
use Shepard\Manager\SimpleManager;

class SimpleManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testSave()
    {
        $manager = new SimpleManager();
        $job = $this->mockJob();
        $deadline = new \DateTime("tomorrow");
        $job->expects($this->once())
            ->method('getAuthor')
            ->will($this->returnValue("John Doe"));
        $job->expects($this->once())
            ->method('getDescription')
            ->will($this->returnValue("Foo Bar."));
        $job->expects($this->once())
            ->method('getDeadline')
            ->will($this->returnValue($deadline));

        $manager->save($job);

        $this->assertFileExists("/tmp/Shepard/Job.txt");
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function mockJob()
    {
        return $this->getMockBuilder(SimpleJob::class)->getMock();
    }
}
