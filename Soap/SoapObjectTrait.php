<?php

namespace Padam87\GlsBundle\Soap;

use Padam87\GlsBundle\Model\Collection;

trait SoapObjectTrait
{
    public function __get($name)
    {
        $method = 'get' . $name;

        if (method_exists($this, $method)) {
            $value = $this->$method();

            if ($value instanceof Collection) {
                return $value->toArray();
            }

            if ($value instanceof \DateTime) {
                return $value->format('c');
            }

            return $value;
        }

        return null;
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;

        if (method_exists($this, $method)) {
            $this->$method($value);
        } else {
            $this->$name = $value;
        }
    }
}
