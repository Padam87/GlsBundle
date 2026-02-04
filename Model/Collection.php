<?php

namespace Padam87\GlsBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

class Collection extends ArrayCollection
{
    public function __get(string $name): mixed
    {
        return $this->toArray();
    }

    public function __set(string $name, mixed $value)
    {
        if (is_array($value)) {
            foreach ($value as $item) {
                $this->add($item);
            }
        } else {
            $this->add($value);
        }
    }
}
