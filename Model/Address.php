<?php

namespace Padam87\GlsBundle\Model;

use Padam87\GlsBundle\Soap\SoapObjectTrait;
use Symfony\Component\Validator\Constraints as Assert;

class Address
{
    use SoapObjectTrait;

    /**
     * Name of the person or organization.
     *
     *
     * @Assert\NotBlank()
     */
    protected ?string $name = null;

    /**
     * Name of the street.
     *
     *
     * @Assert\NotBlank()
     */
    protected ?string $street = null;

    /**
     * Number of the house.
     *
     *
     * @Assert\NotBlank(groups={"Recommended"})
     */
    protected ?string $houseNumber = null;

    /**
     * Name of the town or village.
     *
     *
     * @Assert\NotBlank()
     */
    protected ?string $city = null;

    /**
     * Area Zip code.
     *
     *
     * @Assert\NotBlank()
     */
    protected ?string $zipCode = null;

    /**
     * Two letter country code defined in ISO 3166-1.
     *
     *
     * @Assert\NotBlank(groups={"Recommended"})
     */
    protected ?string $countryIsoCode = null;

    /**
     * Name of person which can be asked or inform about shipment details by GLS.
     *
     *
     * @Assert\NotBlank(groups={"Recommended"})
     */
    protected ?string $contactName = null;

    /**
     * Phone number of person which can be asked or inform about shipment details by GLS.
     *
     *
     * @Assert\NotBlank(groups={"Recommended"})
     */
    protected ?string $contactPhone = null;

    /**
     * Email address of person which can be asked or inform about shipment details by GLS.
     *
     *
     * @Assert\NotBlank(groups={"Recommended"})
     */
    protected ?string $contactEmail = null;

    public function toArray(): array
    {
        return array_filter([
            'Name' => $this->getName(),
            'Street' => $this->getStreet(),
            'HouseNumber' => $this->getHouseNumber(),
            'City' => $this->getCity(),
            'ZipCode' => $this->getZipCode(),
            'CountryIsoCode' => $this->getCountryIsoCode(),
            'ContactName' => $this->getContactName(),
            'ContactPhone' => $this->getContactPhone(),
            'ContactEmail' => $this->getContactEmail(),
        ]);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(?string $houseNumber): self
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCountryIsoCode(): ?string
    {
        return $this->countryIsoCode;
    }

    public function setCountryIsoCode(?string $countryIsoCode): self
    {
        $this->countryIsoCode = $countryIsoCode;

        return $this;
    }

    public function getContactName(): ?string
    {
        return $this->contactName;
    }

    public function setContactName(?string $contactName): self
    {
        $this->contactName = $contactName;

        return $this;
    }

    public function getContactPhone(): ?string
    {
        return $this->contactPhone;
    }

    public function setContactPhone(?string $contactPhone): self
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(?string $contactEmail): self
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }
}
