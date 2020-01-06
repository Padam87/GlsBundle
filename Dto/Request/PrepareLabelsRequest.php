<?php

namespace Padam87\GlsBundle\Dto\Request;

use Padam87\GlsBundle\Model\Collection;
use Padam87\GlsBundle\Model\Parcel;

class PrepareLabelsRequest extends AbstractRequest
{
    use ParcelListTrait;
}
