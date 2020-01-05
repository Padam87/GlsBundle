<?php

namespace Padam87\GlsBundle\Model;

use Padam87\GlsBundle\Soap\SoapObjectTrait;
use Symfony\Component\Validator\Constraints as Assert;

class Service
{
    use SoapObjectTrait;

    /**
     * Service code (see Appendix B: List of services).
     *
     * @var string
     *
     * @Assert\NotBlank()
     */
    protected $code;

    /**
     * Service value without previous special service settings
     *
     * @var string
     */
    protected $value;

    public function toArray(): array
    {
        return [
            'Code' => $this->getName(),
            'Value' => $this->getValue(),
        ];
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
