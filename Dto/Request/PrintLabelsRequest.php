<?php

namespace Padam87\GlsBundle\Dto\Request;

class PrintLabelsRequest extends AbstractRequest
{
    use ParcelListTrait;
    use PrintTrait;
}
