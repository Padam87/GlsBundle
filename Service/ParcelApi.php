<?php

namespace Padam87\GlsBundle\Service;

use Padam87\GlsBundle\Dto\Request\AbstractRequest;
use Padam87\GlsBundle\Dto\Request\GetParcelStatusesRequest;
use Padam87\GlsBundle\Dto\Request\GetPrintedLabelsRequest;
use Padam87\GlsBundle\Dto\Request\PrepareLabelsRequest;
use Padam87\GlsBundle\Dto\Request\PrintLabelsRequest;
use Padam87\GlsBundle\Dto\Response\GetParcelStatusesResponse;
use Padam87\GlsBundle\Dto\Response\GetPrintedLabelsResponse;
use Padam87\GlsBundle\Dto\Response\PrepareLabelsResponse;
use Padam87\GlsBundle\Dto\Response\PrintLabelsResponse;
use Padam87\GlsBundle\Model\Address;
use Padam87\GlsBundle\Model\Collection;
use Padam87\GlsBundle\Model\ErrorInfo;
use Padam87\GlsBundle\Model\Parcel;
use Padam87\GlsBundle\Model\ParcelInfo;
use Padam87\GlsBundle\Model\ParcelStatus;
use Padam87\GlsBundle\Model\PrintLabelsInfo;
use Padam87\GlsBundle\Model\Service;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParcelApi
{
    private $config = [];
    private $client;

    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    public function getClient()
    {
        if ($this->client === null) {
            $this->client = new \SoapClient(
                $this->config['wsdl'],
                [
                    'trace' => 1,
                    'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
                    'classmap' => [
                        // Generics can't come soon enough.
                        'ArrayOfstring' => Collection::class,
                        'ArrayOfint' => Collection::class,
                        'ArrayOfParcel' => Collection::class,
                        'ArrayOfService' => Collection::class,
                        'ArrayOfParcelInfo' => Collection::class,
                        'ArrayOfPrintDataInfo' => Collection::class,
                        'ArrayOfSuccessfullyDeleted' => Collection::class,
                        'ArrayOfErrorInfo' => Collection::class,
                        'ArrayOfPrintLabelsInfo' => Collection::class,
                        'ArrayOfParcelStatus' => Collection::class,

                        'Address' => Address::class,
                        'Parcel' => Parcel::class,
                        'Service' => Service::class,

                        'ErrorInfo' => ErrorInfo::class,
                        'ParcelInfo' => ParcelInfo::class,
                        'ParcelStatus' => ParcelStatus::class,
                        'PrintLabelsInfo' => PrintLabelsInfo::class,

                        'PrintLabelsRequest' => PrintLabelsRequest::class,
                        'PrintLabelsResponse' => PrintLabelsResponse::class,

                        'PrepareLabelsRequest' => PrepareLabelsRequest::class,
                        'PrepareLabelsResponse' => PrepareLabelsResponse::class,

                        'GetPrintedLabelsRequest' => GetPrintedLabelsRequest::class,
                        'GetPrintedLabelsResponse' => GetPrintedLabelsResponse::class,

                        'GetParcelStatusesRequest' => GetParcelStatusesRequest::class,
                        'GetParcelStatusResponse' => GetParcelStatusesResponse::class,
                    ]
                ]
            );
        }

        return $this->client;
    }

    protected function prepareRequest(AbstractRequest $request)
    {
        $request
            ->setUsername($this->config['config']['username'])
            ->setPassword(hash('sha512', $this->config['config']['password'], true))
        ;
    }

    public function prepareLabels(PrepareLabelsRequest $request): PrepareLabelsResponse
    {
        $this->prepareRequest($request);

        $request->getParcelList()->forAll(function ($key, Parcel $parcel) {
            $parcel->setClientNumber($this->config['config']['senderid']);
        });

        $response = $this->getClient()->PrepareLabels(['prepareLabelsRequest' => $request]);

        return $response->PrepareLabelsResult;
    }

    public function getPrintedLabels(GetPrintedLabelsRequest $request): GetPrintedLabelsResponse
    {
        $this->prepareRequest($request);

        $response = $this->getClient()->GetPrintedLabels(['getPrintedLabelsRequest' => $request]);

        return $response->GetPrintedLabelsResult;
    }

    public function printLabels(PrintLabelsRequest $request): PrintLabelsResponse
    {
        $this->prepareRequest($request);

        $request->getParcelList()->forAll(function ($key, Parcel $parcel) {
            $parcel->setClientNumber($this->config['config']['senderid']);

            return true;
        });

        $response = $this->getClient()->PrintLabels(['printLabelsRequest' => $request]);

        return $response->PrintLabelsResult;
    }

    public function getParcelStatuses(GetParcelStatusesRequest $request): GetParcelStatusesResponse
    {
        $this->prepareRequest($request);

        $response = $this->getClient()->GetParcelStatuses(['getParcelStatusesRequest' => $request]);

        return $response->GetParcelStatusesResult;
    }
}
