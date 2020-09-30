<?php

namespace Padam87\GlsBundle\Dto\Request;

class GetParcelStatusesRequest extends AbstractRequest
{
    private int $parcelNumber;

    private bool $returnPOD = true;

    public function getParcelNumber(): int
    {
        return $this->parcelNumber;
    }

    public function setParcelNumber(int $parcelNumber): GetParcelStatusesRequest
    {
        $this->parcelNumber = $parcelNumber;

        return $this;
    }

    public function getReturnPOD(): bool
    {
        return $this->returnPOD;
    }

    public function setReturnPOD(bool $returnPOD): GetParcelStatusesRequest
    {
        $this->returnPOD = $returnPOD;

        return $this;
    }
}
