<?php

namespace Padam87\GlsBundle\Dto\Response;

use Padam87\GlsBundle\Model\Collection;

class PrintLabelsResponse extends AbstractResponse
{
    /**
     * @var string
     */
    protected $labels;

    /**
     * @var Collection
     */
    protected $printLabelsErrorList;

    /**
     * @var Collection
     */
    protected $printLabelsInfoList;

    public function getLabels(): ?string
    {
        return $this->labels;
    }

    public function setLabels(?string $labels): self
    {
        $this->labels = $labels;

        return $this;
    }

    public function getPrintLabelsErrorList(): ?Collection
    {
        return $this->printLabelsErrorList;
    }

    public function setPrintLabelsErrorList(?Collection $printLabelsErrorList): self
    {
        $this->printLabelsErrorList = $printLabelsErrorList;

        return $this;
    }

    public function getPrintLabelsInfoList(): ?Collection
    {
        return $this->printLabelsInfoList;
    }

    public function setPrintLabelsInfoList(?Collection $printLabelsInfoList): self
    {
        $this->printLabelsInfoList = $printLabelsInfoList;

        return $this;
    }
}
