<?php

namespace Padam87\GlsBundle\Dto\Response;

use Padam87\GlsBundle\Model\Collection;

class PrepareLabelsResponse extends AbstractResponse
{
    /**
     * @var Collection
     */
    protected $parcelInfoList;

    /**
     * @var Collection
     */
    protected $prepareLabelsError;

    public function getParcelInfoList(): ?Collection
    {
        return $this->parcelInfoList;
    }

    public function setParcelInfoList(?Collection $parcelInfoList): self
    {
        $this->parcelInfoList = $parcelInfoList;

        return $this;
    }

    public function getPrepareLabelsError(): ?Collection
    {
        return $this->prepareLabelsError;
    }

    public function setPrepareLabelsError(?Collection $prepareLabelsError): self
    {
        $this->prepareLabelsError = $prepareLabelsError;

        return $this;
    }
}
