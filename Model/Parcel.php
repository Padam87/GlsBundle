<?php

namespace Padam87\GlsBundle\Model;

use Padam87\GlsBundle\Soap\SoapObjectTrait;
use Symfony\Component\Validator\Constraints as Assert;

class Parcel
{
    use SoapObjectTrait;

    /**
     * Unique client number provided by GLS company.
     *
     *
     * @Assert\NotBlank(groups={"BeforeSubmit"})
     */
    public ?int $clientNumber = null;

    /**
     * Client custom tag identifying parcel.
     *
     *
     * @Assert\NotBlank(groups={"Recommended"})
     */
    public ?string $clientReference = null;

    /**
     * Count of parcels sent in one shipment.
     *
     *
     * @Assert\NotBlank()
     * @Assert\Range(min="1")
     */
    public int $count = 1;

    /**
     * Cash on delivery amount.
     *
     * @var mixed decimal as float or string
     */
    public $codAmount;

    /**
     * Cash on delivery client reference number used for payment pairing.
     */
    public ?string $codReference = null;

    /**
     * Parcel info printed on label.
     *
     *
     * @Assert\NotBlank(groups={"Recommended"})
     */
    public ?string $content = null;

    /**
     * Pick up date. DEFAULT actual date.
     */
    public ?\DateTime $pickupDate = null;

    /**
     * The address of place where courier pick up the shipment.
     *
     *
     * @Assert\NotBlank()
     */
    public ?Address $pickupAddress = null;

    /**
     * The address of place where courier pick up the shipment.
     *
     *
     * @Assert\NotBlank()
     */
    public ?Address $deliveryAddress = null;

    public ?Collection $serviceList = null;

    public function __construct()
    {
        $this->pickupDate = new \DateTime();
        $this->serviceList = new Collection();
    }

    public function toArray(): array
    {
        $services = [];

        foreach ($this->getServiceList() as $service) {
            $services[] = $service->toArray();
        }

        return array_filter([
            'ClientNumber' => $this->getClientNumber(),
            'ClientReference' => $this->getClientReference(),
            'Count' => $this->getCount(),
            'CODAmount' => $this->getCodAmount(),
            'CODReference' => $this->getCodReference(),
            'Content' => $this->getContent(),
            'PickupDate' => $this->getPickupDate() === null ? null : $this->getPickupDate()->format('Y-m-d'),
            'PickupAddress' => $this->getPickupAddress()->toArray(),
            'DeliveryAddress' => $this->getDeliveryAddress()->toArray(),
            'ServiceList' => $services,
        ]);
    }

    public function unserialize($serialized)
    {
        throw new \LogicException('Not implemented - will fix if a valid use case emerges.');
    }

    public function getClientNumber(): ?int
    {
        return $this->clientNumber;
    }

    public function setClientNumber(?int $clientNumber): self
    {
        $this->clientNumber = $clientNumber;

        return $this;
    }

    public function getClientReference(): ?string
    {
        return $this->clientReference;
    }

    public function setClientReference(?string $clientReference): self
    {
        $this->clientReference = $clientReference;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getCodAmount()
    {
        return $this->codAmount;
    }

    public function setCodAmount($codAmount)
    {
        $this->codAmount = $codAmount;

        return $this;
    }

    public function getCodReference(): ?string
    {
        return $this->codReference;
    }

    public function setCodReference(?string $codReference): self
    {
        $this->codReference = $codReference;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPickupDate(): ?\DateTime
    {
        return $this->pickupDate;
    }

    public function setPickupDate(?\DateTime $pickupDate): self
    {
        $this->pickupDate = $pickupDate;

        return $this;
    }

    public function getPickupAddress(): ?Address
    {
        return $this->pickupAddress;
    }

    public function setPickupAddress(?Address $pickupAddress): self
    {
        $this->pickupAddress = $pickupAddress;

        return $this;
    }

    public function getDeliveryAddress(): ?Address
    {
        return $this->deliveryAddress;
    }

    public function  setDeliveryAddress(?Address $deliveryAddress): self
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    public function getServiceList(): ?Collection
    {
        return $this->serviceList;
    }

    public function setServiceList(?Collection $serviceList): self
    {
        $this->serviceList = $serviceList;

        return $this;
    }

    public function getService(string $code): ?Service
    {
        return $this->serviceList->get($code);
    }

    public function addService(Service $service): self
    {
        $this->serviceList->set($service->getCode(), $service);

        return $this;
    }
}
