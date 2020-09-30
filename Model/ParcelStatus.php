<?php

namespace Padam87\GlsBundle\Model;

use Padam87\GlsBundle\Soap\SoapObjectTrait;

class ParcelStatus
{
    use SoapObjectTrait;

    /**
     * @var string
     */
    private $depotCity;

    /**
     * @var string
     */
    private $depotNumber;

    /**
     * @var string
     */
    private $statusCode;

    /**
     * @var \DateTime
     */
    private $statusDate;

    /**
     * @var ?string
     */
    private $statusDescription;

    /**
     * @var ?string
     */
    private $statusInfo;

    public function getDepotCity(): string
    {
        return $this->depotCity;
    }

    public function setDepotCity(string $depotCity): ParcelStatus
    {
        $this->depotCity = $depotCity;

        return $this;
    }

    public function getDepotNumber(): string
    {
        return $this->depotNumber;
    }

    public function setDepotNumber(string $depotNumber): ParcelStatus
    {
        $this->depotNumber = $depotNumber;

        return $this;
    }

    public function getStatusCode(): string
    {
        return $this->statusCode;
    }

    public function setStatusCode(string $statusCode): ParcelStatus
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getStatusDate(): \DateTime
    {
        return $this->statusDate;
    }

    public function setStatusDate($statusDate): ParcelStatus
    {
        if (!$statusDate instanceof \DateTime) {
            $statusDate = new \DateTime($statusDate);
        }

        $this->statusDate = $statusDate;

        return $this;
    }

    public function getStatusDescription(): ?string
    {
        return $this->statusDescription;
    }

    public function setStatusDescription(?string $statusDescription): ParcelStatus
    {
        $this->statusDescription = $statusDescription;

        return $this;
    }

    public function getStatusInfo(): ?string
    {
        return $this->statusInfo;
    }

    public function setStatusInfo(?string $statusInfo): ParcelStatus
    {
        $this->statusInfo = $statusInfo;

        return $this;
    }
}
