<?php

namespace Padam87\GlsBundle\Service;

class ParcelGeneratorManager
{
    private iterable $generators;

    public function __construct(iterable $generators)
    {
        $this->generators = $generators;
    }

    public function generate($data): \Generator
    {
        yield from $this->selectGenerator($data)($data);
    }

    private function selectGenerator($data): ParcelGeneratorInterface
    {
        foreach ($this->generators as $generator) {
            if ($generator->supports($data)) {
                return $generator;
            }
        }

        throw new \LogicException('No generator supports given data type.');
    }
}
