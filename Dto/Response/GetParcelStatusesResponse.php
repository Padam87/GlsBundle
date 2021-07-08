<?php

namespace Padam87\GlsBundle\Dto\Response;

use Padam87\GlsBundle\Model\Collection;

class GetParcelStatusesResponse extends AbstractResponse
{
    protected string $clientReference;

    protected string $deliveryCountryCode;

    protected string $deliveryZipCode;

    protected Collection $getParcelStatusErrors;

    protected string $parcelNumber;

    protected Collection $parcelStatusList;

    protected ?string $POD = null;

    protected ?float $weight = null;

    public function getClientReference(): string
    {
        return $this->clientReference;
    }

    public function setClientReference(string $clientReference): GetParcelStatusesResponse
    {
        $this->clientReference = $clientReference;

        return $this;
    }

    public function getDeliveryCountryCode(): string
    {
        return $this->deliveryCountryCode;
    }

    public function setDeliveryCountryCode(string $deliveryCountryCode): GetParcelStatusesResponse
    {
        $this->deliveryCountryCode = $deliveryCountryCode;

        return $this;
    }

    public function getDeliveryZipCode(): string
    {
        return $this->deliveryZipCode;
    }

    public function setDeliveryZipCode(string $deliveryZipCode): GetParcelStatusesResponse
    {
        $this->deliveryZipCode = $deliveryZipCode;

        return $this;
    }

    public function getGetParcelStatusErrors(): Collection
    {
        return $this->getParcelStatusErrors;
    }

    public function setGetParcelStatusErrors(Collection $getParcelStatusErrors): GetParcelStatusesResponse
    {
        $this->getParcelStatusErrors = $getParcelStatusErrors;

        return $this;
    }

    public function getParcelNumber(): string
    {
        return $this->parcelNumber;
    }

    public function setParcelNumber(string $parcelNumber): GetParcelStatusesResponse
    {
        $this->parcelNumber = $parcelNumber;

        return $this;
    }

    public function getParcelStatusList(): Collection
    {
        return $this->parcelStatusList;
    }

    public function setParcelStatusList(Collection $parcelStatusList): GetParcelStatusesResponse
    {
        $this->parcelStatusList = $parcelStatusList;

        return $this;
    }

    public function getPOD(): ?string
    {
        return $this->POD;
    }

    public function setPOD(?string $POD): GetParcelStatusesResponse
    {
        $this->POD = $POD;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): GetParcelStatusesResponse
    {
        $this->weight = $weight;

        return $this;
    }
}
