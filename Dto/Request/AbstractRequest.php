<?php

namespace Padam87\GlsBundle\Dto\Request;

use Padam87\GlsBundle\Model\Collection;
use Padam87\GlsBundle\Soap\SoapObjectTrait;

abstract class AbstractRequest
{
    use SoapObjectTrait;

    protected ?string $username = null;

    protected ?string $password = null;

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
