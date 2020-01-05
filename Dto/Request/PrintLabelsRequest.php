<?php

namespace Padam87\GlsBundle\Dto\Request;

use Padam87\GlsBundle\Model\Collection;
use Padam87\GlsBundle\Model\Parcel;

class PrintLabelsRequest extends AbstractRequest
{
    /**
     * @var Collection
     */
    protected $parcelList;

    /**
     * @var int
     */
    protected $printPosition = 1;

    /**
     * @var int
     */
    protected $showPrintDialog = 0;

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

    public function getPrintPosition(): ?int
    {
        return $this->printPosition;
    }

    public function setPrintPosition(?int $printPosition): self
    {
        $this->printPosition = $printPosition;

        return $this;
    }

    public function getShowPrintDialog(): ?int
    {
        return $this->showPrintDialog;
    }

    public function setShowPrintDialog(?int $showPrintDialog): self
    {
        $this->showPrintDialog = $showPrintDialog;

        return $this;
    }
}
