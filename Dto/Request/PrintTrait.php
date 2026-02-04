<?php

namespace Padam87\GlsBundle\Dto\Request;

trait PrintTrait
{
    protected int $printPosition = 1;

    protected int $showPrintDialog = 0;

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
