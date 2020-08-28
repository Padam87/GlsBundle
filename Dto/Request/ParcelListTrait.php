<?php

namespace Padam87\GlsBundle\Dto\Request;

use Padam87\GlsBundle\Model\Collection;
use Padam87\GlsBundle\Model\Parcel;

trait ParcelListTrait
{
    /**
     * @var Collection
     */
    protected $parcelList;

    public function __construct($parcelList = [])
    {
        if (is_array($parcelList)) {
            $this->parcelList = new Collection($parcelList);
        } elseif ($parcelList instanceof Parcel) {
            $this->parcelList = new Collection([$parcelList]);
        } else {
            throw new \LogicException('$parcelList must be typeof array Parcel.');
        }
    }

    public function getParcelList(): ?Collection
    {
        return $this->parcelList;
    }

    public function setParcelList(?Collection $parcelList): self
    {
        $this->parcelList = $parcelList;

        return $this;
    }
}