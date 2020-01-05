<?php

namespace Padam87\GlsBundle\Model;

use Padam87\GlsBundle\Soap\SoapObjectTrait;

class ErrorInfo
{
    use SoapObjectTrait;

    /**
     * @var int
     */
    protected $errorCode;

    /**
     * @var string
     */
    protected $errorDescription;

    /**
     * @var Collection
     */
    protected $clientReferenceList;

    /**
     * @var Collection
     */
    protected $parcelIdList;

    public function getErrorCode(): ?int
    {
        return $this->errorCode;
    }

    public function setErrorCode(?int $errorCode): self
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    public function getErrorDescription(): ?string
    {
        return $this->errorDescription;
    }

    public function setErrorDescription(?string $errorDescription): self
    {
        $this->errorDescription = $errorDescription;

        return $this;
    }

    public function getClientReferenceList(): ?Collection
    {
        return $this->clientReferenceList;
    }

    public function setClientReferenceList(?Collection $clientReferenceList): self
    {
        $this->clientReferenceList = $clientReferenceList;

        return $this;
    }

    public function getParcelIdList(): ?Collection
    {
        return $this->parcelIdList;
    }

    public function setParcelIdList(?Collection $parcelIdList): self
    {
        $this->parcelIdList = $parcelIdList;

        return $this;
    }
}
