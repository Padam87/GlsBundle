<?php

namespace Padam87\GlsBundle\Model;

class Collection extends CopyOfArrayCollection
{
    public function __get($name)
    {
        return $this->toArray();
    }

    public function __set($name, $value)
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
