<?php

namespace App\Service;

use App\Entity\Section;

final class SectionPathGenerator
{
    public function generateFullPath(Section $section): string
    {
        $parts = [];
        $current = $section;

        while ($current !== null) {
            array_unshift($parts, $current->getSlug());
            $current = $current->getParent();
        }

        return '/' . implode('/', $parts);
    }
}
