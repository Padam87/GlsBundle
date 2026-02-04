<?php

namespace Padam87\GlsBundle\Dto\Response;

use Padam87\GlsBundle\Model\Collection;

class GetPrintedLabelsResponse extends AbstractResponse
{
    protected ?string $labels = null;

    protected ?Collection $getPrintedLabelsErrorList = null;

    public function getLabels(): ?string
    {
        return $this->labels;
    }

    public function setLabels(?string $labels): self
    {
        $this->labels = $labels;

        return $this;
    }

    public function getGetPrintedLabelsErrorList(): ?Collection
    {
        return $this->getPrintedLabelsErrorList;
    }

    public function setGetPrintedLabelsErrorList(?Collection $getPrintedLabelsErrorList): self
    {
        $this->getPrintedLabelsErrorList = $getPrintedLabelsErrorList;

        return $this;
    }
}
