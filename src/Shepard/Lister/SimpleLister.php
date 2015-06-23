<?php

namespace Shepard\Lister;

use Shepard\Entity\SimpleJob;
use Shepard\Entity\SimpleUser;
use Shepard\Manager\SimpleManager;

class SimpleLister
{
    /**
     * @var SimpleLister
     */
    private $manager;

    public function __construct(SimpleManager $manager)
    {
        $this->manager = $manager;
    }

    public function printJobs(SimpleUser $user)
    {
        $result = sprintf('<b>List for %s<ul>', $user->getName());
        foreach ($this->manager->loadJob() as $job) {
            /** @var SimpleJob $job */
            $deadline = $job->getDeadline();
            $deadline->setTimezone($user->getTimezone());

            $result .= sprintf("<li>%s  <ul><li>By: %s</li> <li>Due: %s</li></ul></li>",
                $job->getDescription(),
                $job->getAuthor(),
                $deadline->format('Y.m.d \a\t H:i')
            );
        }
        $result .= '</ul>';

        return $result;
    }
}