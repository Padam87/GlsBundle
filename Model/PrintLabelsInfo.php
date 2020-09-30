<?php

namespace Padam87\GlsBundle\Model;

class PrintLabelsInfo extends ParcelInfo
{
    protected ?int $parcelNumber = null;

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
