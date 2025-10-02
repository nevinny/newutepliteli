<?php

namespace App\Extension;

use App\Service\ContactService;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class TwigGlobalExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(private ContactService $settings)
    {
    }

    public function getGlobals(): array
    {
        return ['globalContacts' => $this->settings->get()];
    }

}
