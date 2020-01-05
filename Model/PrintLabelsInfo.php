<?php

namespace Padam87\GlsBundle\Model;

class PrintLabelsInfo extends ParcelInfo
{
    /**
     * @var int
     */
    protected $parcelNumber;

    public function getParcelNumber(): ?int
    {
        return $this->parcelNumber;
    }

    public function setParcelNumber(?int $ParcelNumber): self
    {
        $this->parcelNumber = $ParcelNumber;

        return $this;
    }
}
