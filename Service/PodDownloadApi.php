<?php

namespace Padam87\GlsBundle\Service;

use Http\Client\Exception;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Message\MessageFactory;
use Http\Message\UriFactory;

class PodDownloadApi
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

    public function downloadPod($trackingCodeFrom, $trackingCodeTo = null): ?string
    {
        if ($trackingCodeTo === null) {
            $trackingCodeTo = $trackingCodeFrom;
        }

        $url = str_replace(
            [
                '{username}',
                '{senderid}',
                '{code_from}',
                '{code_to}',
            ],
            [
                $this->config['config']['userid'],
                $this->config['config']['senderid'],
                $trackingCodeFrom,
                $trackingCodeTo,
            ],
            $this->config['pod_download_url']
        );

        try {
            $request = $this->messageFactory->createRequest('GET', $url);
            $response = $this->client->sendRequest($request);
        } catch (Exception $e) {
            return null;
        }

        $body = (string) $response->getBody();

        $fileLocation = str_replace(
            [
                '<script>self.document.location="',
                '";</script>'
            ],
            '',
            (string) $response->getBody()
        );

        $urlParts = parse_url($url);

        $fileUrl = sprintf("%s://%s/%s", $urlParts['scheme'], $urlParts['host'], $fileLocation);

        try {
            $request = $this->messageFactory->createRequest('GET', $fileUrl);
            $response = $this->client->sendRequest($request);
        } catch (Exception $e) {
            return null;
        }

        if ($response->getStatusCode() != 200) {
            return null;
        }

        return (string) $response->getBody();
    }
}
