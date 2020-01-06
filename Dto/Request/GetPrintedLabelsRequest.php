<?php

namespace Padam87\GlsBundle\Dto\Request;

use Padam87\GlsBundle\Model\Collection;
use Padam87\GlsBundle\Model\Parcel;

class GetPrintedLabelsRequest extends AbstractRequest
{
    use PrintTrait;

    /**
     * @var Collection
     */
    protected $parcelIdList;

    public function __construct(array $parcelList = [])
    {
        $this->parcelIdList = new Collection($parcelList);
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
