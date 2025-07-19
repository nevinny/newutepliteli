<?php

namespace App\EventListener;

use App\Entity\Section;
use App\Service\SectionPathGenerator;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

final class SectionPathListener
{
    public function __construct(
        private SectionPathGenerator $pathGenerator
    ) {}

    public function prePersist(Section $section, PrePersistEventArgs $event): void
    {
        $this->updateFullPath($section);
    }

    public function preUpdate(Section $section, PreUpdateEventArgs $event): void
    {
        $this->updateFullPath($section);
    }

    private function updateFullPath(Section $section): void
    {
        $section->setFullPath($this->pathGenerator->generateFullPath($section));
    }
}
