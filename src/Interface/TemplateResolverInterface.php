<?php

namespace App\Interface;

interface TemplateResolverInterface
{
    public function resolve(object $entity): string;
}
