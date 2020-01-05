<?php

namespace Padam87\GlsBundle\Model;

use Padam87\GlsBundle\Soap\SoapObjectTrait;

class ParcelInfo
{
    use SoapObjectTrait;

    /**
     * @var string
     */
    protected $clientReference;

    /**
     * @var int
     */
    protected $parcelId;

    public function getClientReference(): ?string
    {
        return $this->clientReference;
    }

    public function setClientReference(?string $clientReference): self
    {
        $this->clientReference = $clientReference;

        return $this;
    }

    public function getParcelId(): ?int
    {
        return $this->parcelId;
    }

    public function setParcelId(?int $parcelId): self
    {
        $this->parcelId = $parcelId;

        return $this;
    }
}
