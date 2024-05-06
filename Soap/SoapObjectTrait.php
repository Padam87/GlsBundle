<?php

namespace Padam87\GlsBundle\Soap;

use Padam87\GlsBundle\Model\Collection;

trait SoapObjectTrait
{
    public function __get(string $name)
    {
        $method = 'get' . $name;

        if (method_exists($this, $method)) {
            $value = $this->$method();

            if ($value instanceof Collection) {
                return array_values($value->toArray());
            }

            if ($value instanceof \DateTime) {
                return $value->format('c');
            }

            return $value;
        }

        return null;
    }

    public function __set(string $name, $value)
    {
        $method = 'set' . $name;

        if (method_exists($this, $method)) {
            $this->$method($value);
        } else {
            $this->$name = $value;
        }
    }
}
