<?php

namespace App\EntityListener;

use App\Entity\Program;
use Doctrine\ORM\Events;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEntityListener(event: Events::prePersist, entity: Program::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Program::class)]
class ProgramEntityListener
{

    public function __construct(private readonly SluggerInterface $slugger)
    {
    }

    public function __invoke(Program $program)
    {
        $program->setSlug($this->slugger->slug($program->getTitle()));
    }
}