<?php

namespace Padam87\GlsBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Service
{
    public static array $codes = [
        '24H',
        'ADR',
        'AOS',
        //'COD', // COD is already used in the Parcel model
        'CS1',
        'DAW',
        'DDS',
        'DPV',
        'FDS',
        'FSS',
        'INS',
        'LDS',
        'MCC',
        'MMP',
        'PCC',
        'PRS',
        'PSD',
        'PSS',
        'SAT',
        'SBS',
        'SDS',
        'SM1',
        'SM2',
        'SRS',
        'SZL',
        'T09',
        'T10',
        'T12',
        'TGS',
        'XS',
    ];

    public function __isset($name)
    {
        return in_array($name, ['Code', $this->getCode() . 'Parameter']);
    }

    public function __get($name)
    {
        if ($name === 'Code') {
            return $this->getCode();
        }

        if ($name === $this->getCode() . 'Parameter') {
            return $this->getParameter();
        }

        return null;
    }

    /**
     * Service code (see Appendix B: List of services).
     *
     *
     * @Assert\NotBlank()
     */
    protected ?string $code = null;

    protected array $parameter = [];

    public function __construct(?string $code = null)
    {
        $this->setCode($code);
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

    public function getParameter(): array
    {
        return $this->parameter;
    }

    public function setParameter(array $parameter): self
    {
        $this->parameter = $parameter;

        return $this;
    }
}
