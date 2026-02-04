<?php

namespace Padam87\GlsBundle\Dto\Request;

class GetParcelStatusesRequest extends AbstractRequest
{
    private string $languageIsoCode = 'hu';

    private int|string $parcelNumber;

    private bool $returnPOD = true;

    public function getLanguageIsoCode(): string
    {
        return $this->languageIsoCode;
    }

    public function setLanguageIsoCode(string $languageIsoCode): self
    {
        $this->languageIsoCode = $languageIsoCode;

        return $this;
    }

    public function getParcelNumber(): int|string
    {
        return $this->parcelNumber;
    }

    public function setParcelNumber(int|string $parcelNumber): GetParcelStatusesRequest
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
