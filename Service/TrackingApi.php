<?php

namespace Padam87\GlsBundle\Service;

use Http\Client\Exception;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Message\MessageFactory;

class TrackingApi
{
    private $config = [];
    private $messageFactory;
    private $client;

    public function __construct(MessageFactory $messageFactory, HttpClient $client = null)
    {
        $this->messageFactory = $messageFactory;
        $this->client = $client ?: HttpClientDiscovery::find();
    }

    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    public function getParcelInformation($number, $multiple = false)
    {
        $url = sprintf($this->config['tracking_url'], implode(',', $number));

        try {
            $request = $this->messageFactory->createRequest('GET', $url);
            $response = $this->client->sendRequest($request);
        } catch (Exception $e) {
            return false;
        }

        $data = json_decode((string) $response->getBody(), true);

        if (array_key_exists('exceptionText', $data)) {
            return false;
        }

        if (!$multiple) {
            return $data['tuStatus'][0];
        }

        $return = [];

        foreach ($data['tuStatus'] as $parcel) {
            if (isset($parcel['referenceNo'])) {
                $return[$parcel['referenceNo']] = $parcel;
            } else {
                $return[] = $parcel;
            }
        }

        return $return;
    }
}