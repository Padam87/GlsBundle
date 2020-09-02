<?php

namespace Padam87\GlsBundle\Service;

interface ParcelGeneratorInterface
{
    public function __invoke($data): \Generator;

    public function supports($data): bool;
}
